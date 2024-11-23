<?php

require_once('../../config/dbcon.php');
header('Content-type: application/json'); //bas yeje bdo y5d fw3ad fi yhot feedback 3n hal dr fa hal feedback 
//m d8ri btbyn 3nd dr la tmro2 abl 3nd admin admin huwi by3mala publish w2ta bsir fi yshufa el dr
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $feedbackId = mysqli_real_escape_string($con, trim($json->id));
    $published = mysqli_real_escape_string($con, trim($json->published));

    $update_query = "UPDATE feedback SET published=? WHERE feedbackId=?";
    $update_query_run = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($update_query_run, "ii",$published, $feedbackId);

    if(mysqli_stmt_execute($update_query_run))
    {
        mysqli_stmt_close($update_query_run);
        mysqli_close($con);
        echo json_encode("updated");
    } else {
        mysqli_stmt_close($update_query_run);
        mysqli_close($con);
        echo json_encode("could not update from database");
    }
}
?>