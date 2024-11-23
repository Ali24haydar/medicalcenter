<?php

class Admin
{
    public $name;
    public $email;
}

require_once('../../config/dbcon.php');

$query= "SELECT  CONCAT(Fname, ' ', Lname) AS name, email FROM user WHERE role =0"; //3m el2at asma2 el admin
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    for ($i = 0; $row = $result->fetch_assoc(); $i++) { //bmshi 3a kl line by line 
        $admin = new Admin(); //object 3n admin le b class fo2
        $admin->name = $row['name']; //3m 3abe esm hun w email tht
        $admin->email = $row['email'];
        array_push($data, $admin); //btj3 b3abe b data table
    }

    echo json_encode($data); //bb3to 3a front la otba3o

}else{
    echo json_encode("empty");
}

?>
