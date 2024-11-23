<?php

    session_start();
    $userId = $_SESSION['auth_user']['user_id']; //3m jib user id

    header('Content-type: application/json'); //3m haded eno rad ka json
    
    // Function to test input
    function test_input($data){ //3m et7a2a2 mn data shil el speace w
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    // Function to validate password
    function validatePass($pass) {
        $passRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
        return preg_match($passRegex, $pass);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ //iza request kn post
        $json = json_decode(file_get_contents('php://input'));

        $currentPassword = test_input($json->currentPassword); //bl2at current pass w new w confirm
        $newPassword     = test_input($json->newPassword);
        $confirmPassword = test_input($json->confirmPassword);

        $data = [];

        if(empty($currentPassword) || empty($newPassword) || empty($confirmPassword)){ //iza kelon 3byton
            $msg = "All fields are required!";
            $response = '200';
        }
        else if(!validatePass($newPassword) || !validatePass($confirmPassword)){ //iza mn2s whde ...
            $msg = "All fields must be validated!";
            $response = '300';
        }
        else{
            if ($newPassword !== $confirmPassword) { 
                $msg = "New password and confirm password do not match.";//////////////
                $response = '400';
            }
            else{
                include('../config/dbcon.php'); //hl2 hun mrhlet e3ml update lal password 3a database
                global $con;
                $query_select = 'SELECT password From user where user.userId = ?'; // 3m rj3 password mn database t3ult hyda user
                $stmt_select  = mysqli_prepare($con, $query_select);
                if ($stmt_select) {
                    mysqli_stmt_bind_param($stmt_select, "i", $userId);
                    mysqli_stmt_execute($stmt_select);
                    $result_select = mysqli_stmt_get_result($stmt_select);
                    if(mysqli_num_rows($result_select) > 0){ //iza l2it result rh hot password b db passowrd
                        $row = mysqli_fetch_assoc($result_select);
                        $PasswordDB = $row['password'];
                        if (password_verify($currentPassword, $PasswordDB)) { //bt2kd mn current hl2 nfsa zeta le jbta mn database
                            $query  = 'UPDATE user SET user.password = ? WHERE user.userId = ?'; //iza sah nfsa b3ml update
                            $stmt = mysqli_prepare($con, $query);
                            if ($stmt) { 
                                $hashedNewPassword = password_hash($confirmPassword, PASSWORD_DEFAULT); //bshafer password el jdid w brbto m3 user id 
                                mysqli_stmt_bind_param($stmt, "si", $hashedNewPassword, $userId);
                                $result = mysqli_stmt_execute($stmt);
                                if ($result) {
                                    $msg = "Password updated successfully."; //n3amal update 
                                    $response = '500';
                                } 
                            } 
                        }else{
                            $msg = "Please Enter the old password correct.";
                            $response = '600';
                        }  
                    }
                }
            }
        }
        
        $data["response"] = $response;
        $data["message"]  = $msg;
        echo json_encode($data);
    }
?>