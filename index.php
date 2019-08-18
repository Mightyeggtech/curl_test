<?php 

$data = array("name"=>"abc", "age"=>"20");
$string = http_build_query($data);

$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

//var_dump(json_decode($json));
$string = http_build_query(json_decode($json));

$ch = curl_init("https://infinite-dawn-72254.herokuapp.com/data.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$content = curl_exec($ch);
curl_close($ch);
echo $content;
// //echo $ch;
//echo "Index";

?>