<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $current_password = test_input($_POST['signup-Currentpassword']); 
    $password = test_input($_POST['signup-password']);
    $confirmation = test_input($_POST['signup-passwordConfirm']);

    $data = [];

    if($current_password == ""){
        $response =500;
        $msg= "Please Enter Current Password!";
    }
    else if(!validatePass($current_password)){
        $response =500;
        $msg=  "Please Enter a Valid Current Password!";
    }
    else if($password == ""){
        $response =500;
        $msg= "Please Enter New Password!";
    }
    else if(!validatePass($password)){
        $response =500;
        $msg=  "Please Enter a Valid New Password!";
    }
    else if($confirmation == ""){
        $response =500;
        $msg= "Please Confirm New Password!";
    }
    else if($password != $confirmation){
        $response =500;
        $msg= "Password Confirmation Incorrect!";
    }
    else{
        $pass_check_query = "SELECT password FROM user WHERE role = 0";
        $pass_check_query_run = mysqli_prepare($con, $pass_check_query);
        mysqli_stmt_execute($pass_check_query_run);
        $result = mysqli_stmt_get_result($pass_check_query_run);
    
        if (mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_assoc($result);
            $oldpassword = $row['password'];

            if(password_verify($current_password, $oldpassword)){ //mkaren pass adim b le 3nde yeh b db
                $hashedNewPassword = password_hash($password, PASSWORD_DEFAULT);
                $user_query = "UPDATE user SET password=? WHERE role=0 ";
                $user_query_run = mysqli_prepare($con, $user_query);
                mysqli_stmt_bind_param($user_query_run, "s",$hashedNewPassword);
        
                if(mysqli_stmt_execute($user_query_run))
                {
                    $response =200;
                    $msg= "Password Updated Successfully!";
                    $data["password"] = $password;
            
                }else{
                    $response =500;
                    $msg= "Something Went Wrong!";
                }
    
                mysqli_stmt_close($user_query_run);
            }else{
                $response =500;
                $msg=  "Incorrect Current Password!";
            }
        }else{
            $response =500;
            $msg=  "There is no admin row in the db!";
        }

        mysqli_stmt_close($pass_check_query_run);
        mysqli_close($con);
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}