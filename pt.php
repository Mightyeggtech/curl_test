

<?php 
// Turn off all error reporting
//error_reporting(0);

require 'vendor/autoload.php';
//require __DIR__ . '/vendor/autoload.php';
use Spatie\Browsershot\Browsershot;
// $br = new Browsershot();
// $br->setUrl('https://infinite-dawn-72254.herokuapp.com/')->save('example.pdf');
$br = new Browsershot();
// $br->setUrl('https://infinite-dawn-72254.herokuapp.com/')
// ->save('out1.jpg')
//$link = 'https://infinite-dawn-72254.herokuapp.com/';
$link = 'http://localhost/testForQB/index.php';
try{
    $br->setUrl($link)->save('example.jpeg');
}
catch (Exception $e) {
    echo $e->getMessage();
}
echo "IMAGE GENERATED!!!";


?>

