

<?php

$curl = curl_init();

curl_setopt_array($curl, array(

    //CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_POST => true,

    CURLOPT_POSTFIELDS => json_encode(array("source" => "https://infinite-dawn-72254.herokuapp.com/", "landscape" => false, "use_print" => false)),

    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),

    //CURLOPT_USERPWD => 'a75724b5585545698289611b3af69ab7:'

));

$response = curl_exec($curl);

//file_put_contents('tst1.pdf', $response);

$file = fopen("tst2.pdf", "w"); // change file name for PNG images
fwrite($file, $response);
fclose($file);

$ip = "192.168.0.105";
    $port = 9100;
    try{
        $fp =pfsockopen($ip, $port);
        fputs($fp , $x);
        fclose($fp);
            
        echo 'Successfully Printed';
    }
    catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

?>

