<?php
require '../../vendor/autoload.php';
use Spatie\Browsershot\Browsershot;
use Zebra\Client;
use Zebra\Zpl\Image;
use Zebra\Zpl\Builder;
use Zebra\Zpl\GdDecoder;

define("SERVER_ADDRESS", "http://157.245.103.85/curl_test/home/ss-print/");
define("PRINTER_IP", "192.168.0.105"); //local printer ip

function printZPL($imageName){
  //printing process zebra printer
  $decoder = GdDecoder::fromPath($imageName);
  $image = new Image($decoder);

  $zpl = new Builder();
  $zpl->fo(50, 50)->gf($image)->fs();
  echo $zpl;
  // $client = new Client(PRINTER_IP);
  // $client->send($zpl);
  // echo "Printed Successfully-";
}

function createHTML($xmlArr) {
    $html = "";
    $html = '
	<table align="center" border="0" cellspacing="0" cellpadding="0" style="width:300px; font-family:sans-serif !important;">

        <tr>';
            $cnt =  count($xmlArr['record']);
            //print_r($xmlArr['record']);
            //echo "CNT = ".$cnt;
            //for($i = 0; $i < $cnt; $i++){
            for($i = 0; $i < 1; $i++){
			$html .= '<tr style="padding-top: 50px;padding-bottom: 50px;">
                 <td><center>'.$xmlArr['record']['label'].'</center></td>
                  </tr>';
            }
            $html .= '

		</tr>
	</table>
    ';

    return $html;
}

// echo "WORK";
// die();
$br = new Browsershot();
//$_POST['rids'] = "546048"; //test call without webhook
$counter = 0;
$allData = array();
if(isset($_POST['rids'])){
  $string = $_POST['rids'];
  $explodedData = explode(",",$string);
  $totalRids =  count($explodedData);
  for($i = 0; $i < $totalRids; $i++){
    $rids = $explodedData[$i];
    $counter++;
    $queryString = "{'3'.EX.'$rids'}";
    $url = "https://ss.quickbase.com/db/bprrh3cv9?a=API_DoQuery&query=(".$queryString.")&clist=6.43&usertoken=b3jy7r_mpaj_bnntwqddvusut3bdhsfwwdb2vzx2";
    $cURL = curl_init($url);
    curl_setopt($cURL, CURLOPT_POST, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, '');
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
    $response = curl_exec($cURL);
    //convert xml string into an object
    $html = "";
    if (curl_getinfo($cURL, CURLINFO_HTTP_CODE) == 200) {
        $xml = simplexml_load_string($response);
        //convert into json
        $json  = json_encode($xml);
        //convert into associative array
        $xmlArr = json_decode($json, true);
        $html = createHTML($xmlArr);

        array_push($allData,$html);
    }
    curl_close($cURL);
  }

  $allDataCount = count($allData);
  $txt = "";
  for($i = 0; $i < $allDataCount; $i++){
    //making html file
    $txt = $allData[$i];
    //html write
    $myfile = fopen("htmlfile.html", "w") or die("Unable to open file!");
    fwrite($myfile, $txt);
    fclose($myfile);
    //making images with browsshot
    $link = SERVER_ADDRESS.'/htmlfile.html';
    $imageName = 'image.png';
    try{
      $br->setUrl($link)->save($imageName);
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
    //zpl print function
    printZPL($imageName);
  }
}

else{
  echo "No Data Found";
}

?>
