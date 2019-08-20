<?php 


//Test Data
$data = array("name"=>"MET", "age"=>"10");
$string = http_build_query($data);

//The JSON data.
$myObj = new stdClass(); 
$myObj->messageHeader = "Print The Message"; 
$myObj->messageBody="Hello World! This is Message Body";
   
$jsonDataEncoded = $myObj; 
 
//Encode the array into JSON.
//$jsonDataEncoded = json_encode($myJSON);

//url to hit with JSON Data
//$url = "https://infinite-dawn-72254.herokuapp.com/data.php";
$url = "http://localhost/testForQB/index.php";

$cURL = curl_init($url);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
$response = curl_exec($cURL);

if (curl_getinfo($cURL, CURLINFO_HTTP_CODE) == 200) {
    //response
    echo $response;

    //writing pdf
    // $file = fopen("xyz.pdf", "w"); // change file name for PNG images
    // fwrite($file, $response);
    // fclose($file);
}

curl_close($cURL);

// Include autoloader 
// require_once 'dompdf/autoload.inc.php'; 
 
// // Reference the Dompdf namespace 
// use Dompdf\Dompdf; 
 
// // Instantiate and use the dompdf class 
// $dompdf = new Dompdf();
// // Load HTML content 
// $dompdf->loadHtml($response); 
 
// // (Optional) Setup the paper size and orientation 
// $dompdf->setPaper('A4', 'landscape'); 
 
// // Render the HTML as PDF 
// $dompdf->render(); 
 
// // Output the generated PDF to Browser 
// $dompdf->stream();


?>