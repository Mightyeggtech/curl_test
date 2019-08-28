<?php

$_POST['rids'] = "546065"; //test call without webhook

echo "FROM Digital Ocean";

$url = "http://157.245.103.85/curl_test/home/ss-print/file.php";
$cURL = curl_init($url);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
$response = curl_exec($cURL);
echo $response;
curl_close($cURL);

?>
