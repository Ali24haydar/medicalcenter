<?php
session_start();
require('../../config/dbcon.php');
$pname=$_POST['pname'];
$did=$_SESSION['doctorId'];
$eid=$_POST['eid'];
$newappdate=$_POST['nappdate'];
$tapp=$_POST['tapp'];

$query3="select userId from user where email='$pname'";
$res3=mysqli_query($con,$query3);

while($row=mysqli_fetch_assoc($res3))
{
    $pid=$row['userId'];
}

$query2="select patientId from patient where userId='$pid'";
$res=mysqli_query($con,$query2);
while($row=mysqli_fetch_assoc($res))
{
    $pid2=$row['patientId'];
}
if(isset($_POST['pname']) && $_POST['pname']!='')
{
    $query1 = "update appointment set doctorId='$did',patientId='$pid2',date='$newappdate',time='$tapp',status='acccepted' where appId='$eid' ";
		mysqli_query($con, $query1);
    
        
		
}
?>