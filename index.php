<?php 

//Test Data
$data = array("name"=>"MET", "age"=>"10");
$string = http_build_query($data);

//The JSON data.
$myObj = new stdClass(); 
$myObj->messageHeader = "Print The Message"; 
$myObj->messageBody="^xa^cfa,50^fo100,100^fdHello World^fs^xz";
   
$jsonDataEncoded = $myObj; 
 
//Encode the array into JSON.
//$jsonDataEncoded = json_encode($myJSON);

//url to hit with JSON Data
//$url = "https://infinite-dawn-72254.herokuapp.com/data.php";
$url = "http://localhost/testForQB/demoData.php";

$cURL = curl_init($url);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
$response = curl_exec($cURL);

//response
echo $response;

curl_close($cURL);

?>