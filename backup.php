<?php 

function createHTML($xmlArr) {
    $html = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:500px;">
		<tr>
            <th>Name</th>
            <th>Type</th>
		</tr>

        <tr>';
            $cnt =  count($xmlArr['record']);
            for($i = 0; $i < $cnt; $i++){
			$html .= '<tr>
                 <td><center>'.$xmlArr['record'][$i]['full_name'].'</center></td>
                 <td><center>'.$xmlArr['record'][$i]['type'].'</center></td>
                  </tr>';
            }
            $html .= '
            
		</tr>
	</table>
    ';	
    
    echo $html;

    return $html;
}

function printData($html) {
    $ip = "192.168.0.147";
    $port = '';
    try{
        $fp =pfsockopen($ip, $port);
        fputs($fp , $html);
        fclose($fp);
            
        echo 'Successfully Printed';
    }
    catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

//The JSON data.
// $myObj = new stdClass(); 
// $myObj->messageHeader = "Print The Message"; 
// $myObj->messageBody="Hello World! This is Message Body";
// $myObj->rids="546061,546062,546063";
   
// $jsonDataEncoded = $myObj; 
//Encode the array into JSON.
//$jsonDataEncoded = json_encode($myJSON);

//url to hit with JSON Data
//$url = "https://infinite-dawn-72254.herokuapp.com/data.php";

//making query S
$_POST['rids'] = "IT,Support,Billing";
$string = $_POST['rids'];
$explodedData = explode(",",$string);
// print_r($explodedData);
$queryString = '';
$countData = count($explodedData);
$counter = 0;
foreach($explodedData as $rids){
    $queryString .= "{'15'.EX.'$rids'}";
    if($counter > 0 || $counter < $countData-1)
    $queryString .='OR';
    $counter++;
}
//echo $queryString;
//die();
//making query E

$url = "https://builderprogram-meff.quickbase.com/db/bptu26yq5?a=API_DoQuery&query=(".$queryString.")&clist=11.15.5&usertoken=b4ttby_na3y_dcazzchdsqxs4pc22uifhc6v34b2";

$cURL = curl_init($url);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, '');
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($cURL, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));
$response = curl_exec($cURL);

if (curl_getinfo($cURL, CURLINFO_HTTP_CODE) == 200) {
    //response
    //echo $response;

    //convert xml string into an object
    $xml = simplexml_load_string($response);

    //convert into json
    $json  = json_encode($xml);

    //convert into associative array
    $xmlArr = json_decode($json, true);
    //print_r($xmlArr['record'][0]);

    $html = createHTML($xmlArr);
    //printData($html);

}

curl_close($cURL);

?>
