<?php 

require __DIR__ . '/vendor/autoload.php';
require_once 'dompdf/autoload.inc.php'; 
require 'vendor/autoload.php';
use Dompdf\Dompdf; 
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Spatie\Browsershot\Browsershot;
use Mike42\Escpos\ImagickEscposImage;


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
    
    echo $html;

    return $html;
}

function printData($html) {
    // $connector = new NetworkPrintConnector("192.168.0.105", 9100);
    // $printer = new Printer($connector);
    // $pages = EscposImage::loadPdf('example.pdf');
    // $img = new EscposImage($tmpfname);
    // try {
    //     foreach ($pages as $page) {
    //         $printer -> graphics($page);
    //         // $printer -> graphics($page, Printer::IMG_DOUBLE_HEIGHT | Printer::IMG_DOUBLE_WIDTH);
    //     }
    //     $printer->feed(2);
    //     $printer -> cut();
    //     echo "SUCCESS";
    // } finally {
    //     $printer -> close();
    // }
    $ip = "192.168.0.106";
    $port = 9100;
    $filename='example.pdf';
    $fhandle=fopen($filename, 'r');
    $contents = fread($fhandle, filesize($filename));
    fclose($fhandle);
    //print_r($contents);
    try{
        // $file = 'example.pdf';
        // $fp =pfsockopen($ip, $port);
        // fputs($fp ,$contents);
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
    $dompdf->stream('document.pdf');

    $file = fopen("tst.pdf", "w"); // change file name for PNG images
    fwrite($file, $dompdf->render());
    fclose($file);
}

//getting data
//$_POST['rids'] = "546061,546062,546063";
if(isset($_POST['id'])){
    $string = $_POST['id'];
    $queryString = "{'3'.EX.'$string'}";
    //echo $queryString."---";
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
        //makePDF($html);
        //printData($html);
    }
}

?>
