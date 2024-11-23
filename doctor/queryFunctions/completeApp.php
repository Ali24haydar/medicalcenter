<?php
require('../../config/dbcon.php');
if (isset($_GET['id'])) {
$completeapp=$_GET['id'];
$query="update appointment set status='completed' where appId=".$completeapp;
mysqli_query($con,$query);
}else
{
    echo "id is not seted";
}
?>