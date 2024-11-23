<?php
session_start();
require('../config/dbcon.php');
$pid=$_SESSION['patientId'];
$did = $_POST['did'] ;
$date = $_POST['day'] ;
$time = $_POST['time'];
$status = 'pending';


    $query = "INSERT INTO appointment(doctorId, patientId, date, time, status) VALUES ('$did', '$pid', '$date', '$time', '$status')";
 
    mysqli_query($con,$query);  

?>
