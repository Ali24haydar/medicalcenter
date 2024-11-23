<?php
    session_start();
    $userId = $_SESSION['auth_user']['user_id'];

    header('Content-type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $json = json_decode(file_get_contents('php://input'));

        $updateFname     = $json->updateFname;
        $updateLname     = $json->updateLname;
        $updateEmail     = $json->updateEmail;
        $updatePhone     = $json->updatePhone;
        $updateDate      = $json->updateDate;
        $updateGender    = $json->updateGender;
        $updateBloodType = $json->updateBloodType;

        $data = [];

        if(empty($updateFname) || empty($updateLname) || empty($updateEmail) || empty($updatePhone)) {
            $response ='200';
            $msg = "All fileds shouldd be required!";
        }
        else{
            include('../config/dbcon.php');
            global $con;
            $query  =  'UPDATE user
                    JOIN patient ON user.userId = patient.userId
                    SET
                        user.Fname = ?,          
                        user.Lname = ?,          
                        user.email = ?,
                        patient.gender = ?,  
                        patient.bloodType = ?,
                        patient.dateOfBirth = ?,         
                        patient.phoneNumber = ?
                    WHERE user.userId = ?    
            ';
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssssssii", $updateFname, $updateLname, $updateEmail, $updateGender, $updateBloodType, $updateDate, $updatePhone, $userId);
            if (mysqli_query($con, $query)) {
             
                $response = '500';
                $msg = "Updated Successfully!";
            }
            else{
                $response ='100';
                $msg ="Something Went Wrong!";
            }
        } 


        $data["response"] = $response;
        $data["message"]  = $msg;
        echo json_encode($data);
    }
?>