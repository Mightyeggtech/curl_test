

<?php
//require 'pdfcrowd.php';
require_once 'pdfcrowd/pdfcrowd.php'; 

try
{
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("rifat", "12362483794a275342b01da23abfadf4");

    // run the conversion and write the result to a file
    $client->convertUrlToFile("https://infinite-dawn-72254.herokuapp.com/", "example.pdf");
}
catch(\Pdfcrowd\Error $why)
{
    // report the error
    error_log("Pdfcrowd Error: {$why}\n");

    // handle the exception here or rethrow and handle it at a higher level
    throw $why;
}

?>

