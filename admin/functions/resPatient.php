<?php

require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //bt7a2a2 awl shi eno talab mn no3 .post
    $json = json_decode(file_get_contents('php://input')); //3m eb3t post request mn front la back m3 id la user
//bb3t post request mn front la back w 3m estla2a el id 
    $userId = mysqli_real_escape_string($con, trim($json->id));
//3m e3ml update b aleb table user mhl 0 3m tkun 1 hek byn3amal block elo kl m e3ml click 3 button le heye restricted 
    $user_query = "UPDATE user SET restricted=0 WHERE userId=? ";
    $user_query_run = mysqli_prepare($con, $user_query);
    mysqli_stmt_bind_param($user_query_run, "i", $userId);
    
    if(mysqli_stmt_execute($user_query_run))
    {
        mysqli_stmt_close($user_query_run);
        mysqli_close($con);
        echo json_encode("restored");
    } else {
        mysqli_stmt_close($user_query_run);
        mysqli_close($con);
        echo json_encode("could not restore");
    }
}
?>