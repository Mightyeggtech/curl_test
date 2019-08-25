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

$_POST['rids'] = "546061,546062,546063";

    if(isset($_POST['rids'])){
    $string = $_POST['rids'];
    $explodedData = explode(",",$string);
    foreach($explodedData as $rids){

        $_POST['id'] = $rids;

        //$url = 'http://localhost/testForQB/dataGenerator.php';
        $url = 'https://infinite-dawn-72254.herokuapp.com/dataGenerator.php';
        $cURL = curl_init($url);
        curl_setopt($cURL, CURLOPT_POST, true);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
        $response = curl_exec($cURL);

        //echo $response;
        curl_close($cURL);
        $myfile = fopen("htmlfile.html", "w") or die("Unable to open file!");
        $txt = $response;
        fwrite($myfile, $txt);
        fclose($myfile);
        $br = new Browsershot();
        $link = 'http://localhost/testForQB/htmlfile.html';
        try{
            $br->setUrl($link)->save('image.png');
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        //printing process
        $ip = "192.168.0.106";
        $connector = new NetworkPrintConnector($ip, 9100);
        $printer = new Printer($connector);
        try {
            // $img = EscposImage::load("image.png");
            // $printer -> graphics($img);
            // $printer -> cut();
        } finally {
            $printer -> close();
            echo "Printed Successfully";
        }

    }
}

?>

