<?php
require 'vendor/autoload.php';
use Zebra\Client;
use Zebra\Zpl\Image;
use Zebra\Zpl\Builder;
use Zebra\Zpl\GdDecoder;

$decoder = GdDecoder::fromPath('example.png');
$image = new Image($decoder);

$zpl = new Builder();
$zpl->fo(50, 50)->gf($image)->fs();

$client = new Client('192.168.0.105');
$client->send($zpl);

?>
