<?php
require __DIR__ . '/vendor/autoload.php';
require_once 'dompdf/autoload.inc.php';
require 'vendor/autoload.php';
use Spatie\Browsershot\Browsershot;

//echo "BT";

$br = new Browsershot();
$link = 'http://fairdeal.test/htmlfile.html';
try{
  $br->setUrl($link)->save(time().'image.png');
}
catch (Exception $e) {
  echo $e->getMessage();
}
echo "image Done";

?>
