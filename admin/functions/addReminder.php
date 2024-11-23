<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $reminder=test_input($json->reminderInput);

    $data = [];
    if ($reminder != "" && validateDesc($reminder)) {

        $reminder_query = "INSERT INTO reminders (reminder) VALUES (?)";
        $reminder_query_run = mysqli_prepare($con, $reminder_query);
        mysqli_stmt_bind_param($reminder_query_run, "s", $reminder);
    
        if(mysqli_stmt_execute($reminder_query_run))
        {
            $response = 200;
            $msg = "reminder Added Successfully!";
            $data["reminder"] = $reminder;
            $data["response"] = $response;

        } else{
            $msg = "Something Went Wrong!";
        }

        mysqli_stmt_close($reminder_query_run);
        mysqli_close($con);
    } else{
        $msg = "Please Enter a valid reminder!";
    }

    $data["message"] = $msg;
    echo json_encode($data);
}