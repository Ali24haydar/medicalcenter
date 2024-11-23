<?php
    header('Content-type: application/json'); //3m hot enu content rh ykun json
    $response = "";
    $data     = [];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ //iza request post
        $json = json_decode(file_get_contents('php://input')); //3m hdr json la e5d input
        $id = trim($json->id);//25dt el aappointmentid trim shlt ay masafet mwjude
        include('../config/dbcon.php');
        $query = 'DELETE FROM appointment WHERE appointment.appId = ?'; //3mltelo delete
        $stmt  = mysqli_prepare($con, $query);
        if($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id); //3m erbto b appid w btba3 eno delete w response 200
            $id = trim($json->id);
            if(mysqli_stmt_execute($stmt)) {
                echo json_encode("deleted");
                $response = '200';
            }
            else{
                echo json_encode("could not delete from database");
                $response = '300';
            }
        } 
        else {
            die("Error in prepared statement: " . mysqli_error($con));
        }
    }
    $data["response"] = $response;
?>