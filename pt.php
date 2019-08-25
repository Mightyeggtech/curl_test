

<?php 
// Turn off all error reporting
error_reporting(0);

require 'vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';
use Spatie\Browsershot\Browsershot;
// $br = new Browsershot();
// $br->setUrl('https://infinite-dawn-72254.herokuapp.com/')->save('example.pdf');
$br = new Browsershot();
// $br->setUrl('https://infinite-dawn-72254.herokuapp.com/')
// ->save('out1.jpg')
$link = 'https://stackoverflow.com/questions/7841720/printing-to-printers-in-php';
$br->setUrl($link)->save('example.pdf');
echo "PDF GENERATED!!!";


?>

