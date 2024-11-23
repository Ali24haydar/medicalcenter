<?php

require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $drId = mysqli_real_escape_string($con, trim($json->id));
    $date = $json->date;

    $delete_query = "DELETE FROM workingexception WHERE doctorID=? AND date=?";
    $delete_query_run = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($delete_query_run, "is", $drId,$date);
    
    if(mysqli_stmt_execute($delete_query_run))
    {
        mysqli_stmt_close($delete_query_run);
        mysqli_close($con);
        echo json_encode("deleted");
    } else {
        mysqli_stmt_close($delete_query_run);
        mysqli_close($con);
        echo json_encode("could not delete from database");
    }
}
?>