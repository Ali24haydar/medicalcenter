<?php
session_start();
require('../config/dbcon.php');
$pid= $_SESSION['patientId']; //bl2at patient id
$p=0;
$status="completed"; //lzm ykun patient completed el mw3ad la hata y3ml feedback
$response = [];
if (isset($_POST['feedback']) && $_POST['feedback'] != "") { //3m et2kd eno request le be3eta ka post
    $did = $_POST['did']; //bl2at dr id
    $aquery="SELECT EXISTS (SELECT 1 FROM appointment WHERE patientId = ? AND status=? AND doctorId=?) AS doctorExists";
    $stmt = mysqli_prepare($con, $aquery);//bt2kd iza 3njd kn fi mw3ad ben el dr id w patient id le 3nde yehun
    mysqli_stmt_bind_param($stmt, "isi", $pid,$status, $did);//bhot valur jaweb b aleb take app
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $takeapp);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    ///////////////////////////////
    $feedback = $_POST['feedback'];
    $cquery = "SELECT COUNT(feedbackId) AS feedbackCount FROM feedback WHERE patientId = ?";
    $stmt = mysqli_prepare($con, $cquery);
    mysqli_stmt_bind_param($stmt, "i", $pid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $feedbackCount); //3m shuf feedbackcount adeh la hal id
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    if(!$takeapp) //iza false yaane m 3nde mw3d m3 hal dr ma ktamal fa b2elo m fik
    {
        $response["response"] = 400;
        $response["message"] = "Please complete an appointment with the doctor before submitting feedback.";
    }
    else{
    if ($feedbackCount <2) { //iza feedbackcount 2a2l mn 2 yaane m 3amel aktr mn 2 by2dr yb3t
        $query = "INSERT INTO feedback (doctorId,patientId, message,published) VALUES (?, ?,?,?)";

        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'iisi', $did,$pid, $feedback,$p);

            if (mysqli_stmt_execute($stmt)) {
                $response["response"] = 200;
                $response["message"] = "Your feedback will not be visible until it's published by the admin";
            } else {
                $response["response"] = 500; 
                $response["message"] = "Error executing statement: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        } else {
            $response["response"] = 500;
            $response["message"] = "Error preparing statement: " . mysqli_error($con);
        }
  }
  else
  {
    $response["response"] = 400;
    $response["message"] = "You can't add more than 2 feedbacks.";
  }
} }else {
    $response["response"] = 400;
    $response["message"] = "Invalid input or missing data!";
}


echo json_encode($response);
?>

