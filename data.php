<?php 

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbName = "qb";

//echo "i am working from heroku\n";

$x = json_encode($_POST);
//echo $x;

$obj = json_decode($x);
//print $obj->{'name'};

$_POST['order'] = "HELLO";

if(isset($_POST['order'])){
    $print_output= $_POST['order'];
    echo $print_output;
    // try
    // {
    //     $fp=pfsockopen("192.168.0.147", 9100);
    //     fputs($fp, $print_output);
    //     fclose($fp);
    
    //     echo 'Successfully Printed';
    // }
    // catch (Exception $e) 
    // {
    //     echo 'Caught exception: ',  $e->getMessage(), "\n";
    // }
}


// require("fpdf/fpdf.php");

// class myPDF extends FPDF{

// }

// $pdf = new FPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial','B',16);
// $pdf->Cell(40,10,'Hello World!');
// $pdf->Output();


//if(isset($_POST['a'], $_POST['b']) ){

  //  echo "i am working from heroku\n";
   // echo  $_POST['e'];

    // echo $_POST['name']."\n";
    // echo $_POST['age']."\n";

    //echo "WORKING";
    // Create connection
    // $db = new mysqli($servername, $username, $password, $dbName);

    // $name = $db->real_escape_string($_POST["name"]);
    // $age = $db->real_escape_string($_POST["age"]);

    // $sql = "INSERT INTO data (name, age)
    // VALUES ('$name', '$age')";

    // if ($db->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $db->error;
    // }
//}

?>