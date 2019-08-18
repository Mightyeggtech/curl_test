<?php 

$data = array("name"=>"abc", "age"=>"20");
$string = http_build_query($data);

$json = '    {"employees":[  
    {"name":"Shyam", "email":"shyamjaiswal@gmail.com"},  
    {"name":"Bob", "email":"bob32@gmail.com"},  
    {"name":"Jai", "email":"jai87@gmail.com"}  
]}  ';

//var_dump(json_decode($json));
$string = http_build_query(json_decode($json));

$ch = curl_init("https://infinite-dawn-72254.herokuapp.com/data.php");
//$ch = curl_init("http://localhost/testForQB/data.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$content = curl_exec($ch);
curl_close($ch);
echo $content;
// //echo $ch;
//echo "Index";

?>