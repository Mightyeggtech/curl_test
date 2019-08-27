<?php
require __DIR__ . '/vendor/autoload.php';
require_once 'dompdf/autoload.inc.php';
require 'vendor/autoload.php';
use Zebra\Client;
use Zebra\Zpl\Image;
use Zebra\Zpl\Builder;
use Zebra\Zpl\GdDecoder;

$decoder = GdDecoder::fromPath('example.png');
$image = new Image($decoder);

$zpl = new Builder();
$zpl->fo(100, 100)->gf($image)->fs();

echo $zpl;
die();

$ip = '192.168.0.105';
$client = new Client($ip);
$client->send($zpl);
?>
