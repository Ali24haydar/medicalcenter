<?php

require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $userId = mysqli_real_escape_string($con, trim($json->id));
    
    $user_query = "UPDATE user SET restricted=1 WHERE userId=? ";
    $user_query_run = mysqli_prepare($con, $user_query);
    mysqli_stmt_bind_param($user_query_run, "i", $userId);
    
    if(mysqli_stmt_execute($user_query_run))
    {
        mysqli_stmt_close($user_query_run);
        mysqli_close($con);
        echo json_encode("deleted");
    } else {
        mysqli_stmt_close($user_query_run);
        mysqli_close($con);
        echo json_encode("could not restrict from database");
    }
}
?>