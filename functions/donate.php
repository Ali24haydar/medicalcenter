<?php
    header('Content-type: application/json');
    include('validateFunctions.php');
    include('../config/dbcon.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //request post
        $json = json_decode(file_get_contents('php://input'));
        
        

        $emailOrPhone = test_input($json->email); //ka input 3m e5d email w blood type
        $BloodType    = test_input($json->bloodtype);
        
        $data = [];

        // Perform additional validation as needed
        if (!empty($emailOrPhone) && $BloodType != "Blood-Type") { //3m et2kd eno msh fdyeen 
            if (validateEmail($emailOrPhone)) { //3m nt2kd mn email le jbne iza validate le hato hal user 
                $columnEmail = $emailOrPhone; //iza kn validate bsyvo b culumn email variable tene w bst5dmo tht

                // Check if the email already exists in the database
                $query = "SELECT * FROM donor WHERE email = ?"; //bshuf hal email iza fyt abl
                $stmt  = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "s", $columnEmail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if (mysqli_num_rows($result) > 0) {
                    $response = '100';
                    $msg = "already exist";
                } 
                else {
                    $query = "INSERT INTO donor (email, bloodType) VALUES (?, ?)";
                    $stmt  = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "ss", $columnEmail, $BloodType);
                    $result = mysqli_stmt_execute($stmt);
                    if ($result) {
                        $response = '300';
                        $data["email"]       = $columnEmail;
                        $data["bloodType"]   = $BloodType;
                        $msg = "Your data has been submitted successfully!";
                    } 
                }
            } 
            elseif (validatePhone($emailOrPhone)) {
                $columnPhone = $emailOrPhone;

                // Check if the phone already exists in the database
                $query = "SELECT * FROM donor WHERE phoneNumber = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "s", $columnPhone);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if (mysqli_num_rows($result) > 0) {
                    $response = '100';
                    $msg = "already exist";
                } 
                else {
                    $query = "INSERT INTO donor (bloodType, phoneNumber) VALUES (?, ?)";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "si", $BloodType, $columnPhone);
                    $result = mysqli_stmt_execute($stmt);
                    if ($result) {
                        $response = '300';
                        $data["bloodType"]   = $BloodType;
                        $data["phoneNumber"] = $columnPhone;
                        $msg = "Your data has been submitted successfully!";
                    }
                }
            } 
            else {
                $response = '400';
                $msg = "Not validated!";
            }
        } 
        else {
            $response = '500';
            $msg = "Empty field!";
        }

        $data["message"]  = $msg;
        $data["response"] = $response;
        echo json_encode($data);
    }
?>