<?php 

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbName = "qb";

echo json_encode($_POST);

if(isset($_POST['a'], $_POST['b']) ){

    echo "i am working from heroku\n";
    echo  $_POST['e'];

    

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
}

?>