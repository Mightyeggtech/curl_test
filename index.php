<?php
require __DIR__ . '/vendor/autoload.php';
require_once 'dompdf/autoload.inc.php';
require 'vendor/autoload.php';
use Spatie\Browsershot\Browsershot;
// use Zebra\Client;
// use Zebra\Zpl\Image;
// use Zebra\Zpl\Builder;
// use Zebra\Zpl\GdDecoder;

// function printZPL(){
//   //printing process zebra printer
//   $ip = "192.168.0.105";
//   $decoder = GdDecoder::fromPath('image.png');
//   $image = new Image($decoder);
//
//   $zpl = new Builder();
//   $zpl->fo(50, 50)->gf($image)->fs();
//
//   echo $zpl;
//   echo "\n";
//
//   //$zpl = "^xa^cfa,50^fo100,100^fdHello World^fs^xz";
//
//   // $client = new Client($ip);
//   // $client->send($zpl);
//   echo "Printed Successfully-";
// }

function createHTML($xmlArr) {
    $html = "";
    $html = '
	<table align="center" border="0" cellspacing="0" cellpadding="0" style="width:300px;">

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

$_POST['rids'] = "546069,546068,546065";

if(isset($_POST['rids'])){
  $string = $_POST['rids'];
  $explodedData = explode(",",$string);
  foreach($explodedData as $rids){
    $_POST['id'] = $rids;
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
        echo $html;
        //making html file
        $myfile = fopen("htmlfile.html", "w") or die("Unable to open file!");
        $txt = $html;
        fwrite($myfile, $txt);
        die();
        //making images with browsshot
        $br = new Browsershot();
        $link = 'http://fairdeal.test/htmlfile.html';
        try{
          $br->setUrl($link)->save(time().'image.png');
        }
        catch (Exception $e) {
          echo $e->getMessage();
        }
    }

    // $url = 'http://fairdeal.test/dataGenerator.php';
    // $cURL = curl_init($url);
    // curl_setopt($cURL, CURLOPT_POST, true);
    // curl_setopt($cURL, CURLOPT_POSTFIELDS, $_POST);
    // curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($cURL);
    // echo $response;
    // $myfile = fopen("htmlfile.html", "w") or die("Unable to open file!");
    // $txt = $response;
    // fwrite($myfile, $txt);
    // $br = new Browsershot();
    // $link = 'http://fairdeal.test/htmlfile.html';
    // try{
    //   $br->setUrl($link)->save(time().'image.png');
    // }
    // catch (Exception $e) {
    //   echo " error : -";
    //   echo $e->getMessage();
    // }
    //echo "image created--";
    //zpl print function
    //printZPL();
  }
}
// fclose($myfile);
// curl_close($cURL);

?>
