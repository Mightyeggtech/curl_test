<?php

$_POST['rids'] = "546065"; //test call without webhook

echo "FROM FILE";
echo "<br>";

$url = "https://infinite-dawn-72254.herokuapp.com/home/ss-print/file.php";
$cURL = curl_init($url);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
$response = curl_exec($cURL);
echo $response;
curl_close($cURL);

?>
