<?php 

//var_dump($_POST['rids']);
$string = $_POST['rids'];
//echo $string;
$explodedData = explode(",",$string);
print_r($explodedData);
foreach($explodedData as $rids){
   // echo $rids;
}
die();


function printData($html) {
    $ip = "192.168.0.147";
    $port = 80;
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

function createHTML($printOutput) {
    $html = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:500px;">
		<tr>
			<th>RIDs</th>
		</tr>

        <tr>';
            foreach($printOutput as $rids){
			$html .= '<tr>
				 <td><center>'.$rids.'</center></td>
                  </tr>';
            }
            $html .= '
            
		</tr>
	</table>
    ';	
    
    echo $html;

    return $html;
}

$printOutput= $explodedData;

$html = createHTML($printOutput);
printData($html);

?>
