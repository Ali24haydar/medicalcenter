<?php
require('../config/dbcon.php');
$fid=$_GET['id']; //3m jib id t3ul feddback w bl8e mn database
$query="delete from feedback where feedbackId=?";
$stmt=mysqli_prepare($con,$query);
mysqli_stmt_bind_param($stmt,"i",$fid);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

?>