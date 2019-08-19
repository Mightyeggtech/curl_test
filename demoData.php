<?php 

$jsonEncodeData = json_encode($_POST);

//$josnDecodedData = json_decode($jsonEncodeData);

$ip = "192.168.0.147";
$port = 80;

$printOutput= $jsonEncodeData;

echo $printOutput;

try{
    $fp =pfsockopen($ip, $port);
    fputs($fp , $printOutput);
    fclose($fp);

    $file = fopen("demo.pdf", "w"); 
    fwrite($file, "HELLO");
    fclose($file);
        
    echo 'Successfully Printed';
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


?>