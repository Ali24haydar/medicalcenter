<?php
require('../config/dbcon.php');
header('Content-type: application/json');
$did = $_GET['did']; //dr id jbto
$p=1; //published
$query = "SELECT feedbackId,patientId,message FROM feedback WHERE doctorId=? AND published=?"; //b3mal select la feddback le m3mela published
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ii", $did,$p); //li yaane tnyneton integer w 3m erbt el dr id m3 el published value

mysqli_stmt_execute($stmt);


mysqli_stmt_bind_result($stmt,$feedbackId,$patientId, $message);

$data = array();
while (mysqli_stmt_fetch($stmt)) { //3m hoton line by line b aray w b3mln display
    $data[] = array( 'fid'=>$feedbackId,'pid'=> $patientId, 'message' => $message);
}


mysqli_stmt_close($stmt);


echo json_encode($data);
?>

