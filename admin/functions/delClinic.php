<?php

require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $clinic_id = mysqli_real_escape_string($con, trim($json->id));

    $clinic_query = "SELECT * FROM clinic WHERE clinicId=?";
    $clinic_query_run = mysqli_prepare($con, $clinic_query);
    mysqli_stmt_bind_param($clinic_query_run, "i", $clinic_id);
    mysqli_stmt_execute($clinic_query_run);
    $clinic_result = mysqli_stmt_get_result($clinic_query_run);
    $clinic_data = mysqli_fetch_array($clinic_result);
    $image = $clinic_data['photo'];
    $icon = $clinic_data['icon'];

    $delete_query = "DELETE FROM clinic WHERE clinicId=?";
    $delete_query_run = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($delete_query_run, "i", $clinic_id);
     
    if(mysqli_stmt_execute($delete_query_run))
    {
        if(file_exists("../../uploads/".$image)){
            unlink("../../uploads/".$image);
        }
        if(file_exists("../../uploads/".$icon)){
            unlink("../../uploads/".$icon);
        }
        mysqli_stmt_close($clinic_query_run);
        mysqli_stmt_close($delete_query_run);
        mysqli_close($con);
        echo json_encode("deleted");
    } else {
        mysqli_stmt_close($clinic_query_run);
        mysqli_stmt_close($delete_query_run);
        mysqli_close($con);
        echo json_encode("could not delete from database");
    }
}
?>