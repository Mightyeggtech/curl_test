<?php 

var_dump($_POST);
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
			<th>Message Header</th>
			<th>Body</th>
		</tr>

        <tr>';
			$html .= '<tr>
				 <td><center>'.$printOutput['messageHeader'].'</center></td>
				 <td><center>'.$printOutput['messageBody'].'</center></td>
                </tr>';
            $html .= '
		</tr>
	</table>
    ';	
    
    echo $html;

    return $html;
}

$printOutput= $_POST;

$html = createHTML($printOutput);
printData($html);

?>
