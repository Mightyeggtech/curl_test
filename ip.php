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
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

$connector = new NetworkPrintConnector("192.168.0.106", 9100);
$printer = new Printer($connector);
try {
    $img = EscposImage::load("a.png");
    $printer -> graphics($img);
    $printer -> cut();
} finally {
    $printer -> close();
}



?>