

<?php 
require 'vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';
use Spatie\Browsershot\Browsershot;
// $br = new Browsershot();
// $br->setUrl('https://infinite-dawn-72254.herokuapp.com/')->save('example.pdf');
$br = new Browsershot();
// $br->setUrl('https://infinite-dawn-72254.herokuapp.com/')
// ->save('out1.jpg')
$br->setUrl('https://infinite-dawn-72254.herokuapp.com/')->save('example.pdf');


?>

