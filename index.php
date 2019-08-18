<?php 

$data = array("name"=>"METech", "age"=>"5");
$string = http_build_query($data);

// $ch = curl_init("http://localhost/testForQB/data.php");
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $content = curl_exec($ch);
// curl_close($ch);
// echo $content;
// //echo $ch;
echo "Index";

?>