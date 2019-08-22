<?php 

require __DIR__ . '/vendor/autoload.php';
require_once 'dompdf/autoload.inc.php'; 
use Dompdf\Dompdf; 
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

function createHTML($xmlArr) {
    $html = '
	<table align="center" border="0" cellspacing="0" cellpadding="0" style="width:300px;">
	
        <tr>';
            $cnt =  count($xmlArr['record']);
            //print_r($xmlArr['record']);
            //echo "CNT = ".$cnt;
            for($i = 0; $i < $cnt; $i++){
			$html .= '<tr style="padding-top: 50px;padding-bottom: 50px;">
                 <td><center>'.$xmlArr['record'][$i]['label'].'</center></td>
                 <br>
                  </tr>';
            }
            $html .= '
            
		</tr>
	</table>
    ';	
    
    echo $html;

    return $html;
}

function printData($html) {
    // $connector = new NetworkPrintConnector("192.168.0.106", 9100);
    // $printer = new Printer($connector);
    // try {
    //     $printer -> text($html);
    //     //$printer -> graphics($html);
    //     $printer -> cut();
    // } finally {
    //     $printer -> close();
    // }
    $ip = "192.168.0.106";
    $port = 9100;
    try{
        // $fp =pfsockopen($ip, $port);
        // fputs($fp , $x);
        // fclose($fp);
            
       //echo 'Successfully Printed';
    }
    catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function makePDF($html) {
    // Instantiate and use the dompdf class 
    $dompdf = new Dompdf();

    // Load HTML content
    $dompdf->loadHtml($html); 
    
    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'landscape'); 
    
    // Render the HTML as PDF 
    $dompdf->render(); 
    
    // Output the generated PDF to Browser 
    $dompdf->stream();
}

//making query S
$_POST['rids'] = "546061,546062,546063";
$string = $_POST['rids'];
$explodedData = explode(",",$string);
// print_r($explodedData);
$queryString = '';
$countData = count($explodedData);
$counter = 0;
foreach($explodedData as $rids){
    $queryString .= "{'3'.EX.'$rids'}";
    if($counter > 0 || $counter < $countData-1)
    $queryString .='OR';
    $counter++;
}
//echo $queryString;
//die();
//making query E

$url = "https://ss.quickbase.com/db/bprrh3cv9?a=API_DoQuery&query=(".$queryString.")&clist=6.43&usertoken=b3jy7r_mpaj_bnntwqddvusut3bdhsfwwdb2vzx2";

$cURL = curl_init($url);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, '');
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
$response = curl_exec($cURL);

if (curl_getinfo($cURL, CURLINFO_HTTP_CODE) == 200) {
    //response
    //echo $response;
    //die();

    //convert xml string into an object
    $xml = simplexml_load_string($response);

    //convert into json
    $json  = json_encode($xml);

    //convert into associative array
    $xmlArr = json_decode($json, true);
    //print_r($xmlArr['record']);

    $html = createHTML($xmlArr);
    //makePDF($html);
    //printData($html);


 }

curl_close($cURL);

?>
