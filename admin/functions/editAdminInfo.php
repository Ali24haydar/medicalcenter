<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $name = test_input($_POST['signup-name']);
    $email = test_input($_POST['signup-email']);

    $data = [];

    if($name == ""){
        $response =500;
        $msg= "Please Enter Admin Name!";
    }else if(str_word_count($name) != 2 || !validateDesc($name)){
        $response =500;
        $msg= "Please Enter Valid Name!";
    }else if($email == ""){
        $response =500;
        $msg= "Please Enter Admin Email!";
    }
    else if(!validateEmail($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $response =500;
        $msg=  "Please Enter a Valid Email!";
    }
    else{
        $Email_check_query = "SELECT * FROM user WHERE email=? AND role <> 0";
        $Email_check_query_run = mysqli_prepare($con, $Email_check_query);
        mysqli_stmt_bind_param($Email_check_query_run, "s", $email);
        mysqli_stmt_execute($Email_check_query_run);
        mysqli_stmt_store_result($Email_check_query_run);
        if (mysqli_stmt_num_rows($Email_check_query_run) > 0) {
            $response =500;
            $msg=  "Email already exists!";
        }else{
            $fullname = explode(" ",$name);
            $fname = $fullname[0];
            $lname = $fullname[1];
    
            $user_query = "UPDATE user SET Fname=? , Lname=?, email=? WHERE role=0 ";
            $user_query_run = mysqli_prepare($con, $user_query);
            mysqli_stmt_bind_param($user_query_run, "sss", $fname, $lname, $email);
    
            if(mysqli_stmt_execute($user_query_run))
            {
                $response =200;
                $msg= "Account Updated Successfully!";

                $data["name"] = $name;
                $data["email"] = $email;
        
            }else{
                $response =500;
                $msg= "Something Went Wrong!";
            }

            mysqli_stmt_close($user_query_run);
        }

        mysqli_stmt_close($Email_check_query_run);
        mysqli_close($con);
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}