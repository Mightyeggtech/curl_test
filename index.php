<?php 

$data = array("name"=>"abc", "age"=>"20");
$string = http_build_query($data);

//The JSON data.
$myObj = new stdClass(); 
$myObj->name = "Geeks"; 
$myObj->college="NIT"; 
$myObj->gender = "Male"; 
$myObj->age = 30; 
   
$jsonDataEncoded = $myObj; 
 
//Encode the array into JSON.
//$jsonDataEncoded = json_encode($myJSON);

//var_dump(json_decode($json));
//$string = http_build_query(json_decode($json));

$ch = curl_init("https://infinite-dawn-72254.herokuapp.com/data.php");
//$ch = curl_init("http://localhost/testForQB/data.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$content = curl_exec($ch);
curl_close($ch);
echo $content;
// //echo $ch;
//echo "Index";

// header('Cache-Control: public'); 
// header('Content-type: application/pdf');
// header('Content-Disposition: attachment; filename="new.pdf"');
// header('Content-Length: '.strlen($content));
// echo $content;


?>