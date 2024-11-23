<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $doctorId = mysqli_real_escape_string($con, $_POST['editDoctorFormId']);
    $userId = mysqli_real_escape_string($con, $_POST['editUserId']);
    $fname = test_input($_POST['editDoctorFN']);
    $lname = test_input($_POST['editDoctorLN']);
    $email = test_input($_POST['editDoctorEmail']);
    $phone = test_input($_POST['editDoctorPhone']);
    $clinicId = mysqli_real_escape_string($con, $_POST['editDoctorClinic']);
//post request 3m jib doctorid user id w fname w lnme .... 
    $data = [];
    $response = 200; //iza response 200 yaane bkun ok response sah 

    if($fname == ""){
        $response =500; //hun iza m 3bet esm la dr
        $msg = "Please Enter Doctor First Name!";
    }
    else if(!validateName($fname)){ //hun 3ml require mn saf7a validate.php sar fini est5dem function le b2lbo 
        $response =500; 
        $msg = "Please Enter a Valid Fname!";
    }
    else if($lname == ""){
        $response =500;
        $msg = "Please Enter Doctor Last Name!";
    }else if(!validateName($lname)){
        $response =500;
        $msg = "Please Enter a Valid Lname!";
    }else if($email == ""){
        $response =500;
        $msg = "Please Enter Doctor Email!";
    }else if(!validateEmail($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $response =500;
        $msg = "Please Enter a Valid Email!";
    }else if($phone == ""){
        $response =500;
        $msg = "Please Enter Doctor Phone Number!";
    }else if(!validatePhone($phone)){
        $response =500;
        $msg = "Please Enter a Valid Phone Number!";
    }else if($clinicId == "" || $clinicId == "clinic"){
        $response =500;
        $msg = "Please Enter Doctor Speciality!";
    }
    else{

        $Email_check_query = "SELECT * FROM user WHERE email=? AND userId <> ?"; //3m e3ml check b table user iza mwjud hal email b table user aw la
        $Email_check_query_run = mysqli_prepare($con, $Email_check_query);
        mysqli_stmt_bind_param($Email_check_query_run, "si", $email, $userId);
        mysqli_stmt_execute($Email_check_query_run);
        mysqli_stmt_store_result($Email_check_query_run);
        if (mysqli_stmt_num_rows($Email_check_query_run) > 0) { //iza 3adad row le 3atane yeh akbr mn 0 yaane 3atane shi yaane email mwjud
            $response =500;
            $msg = "Email already exists!";
        }else { 
            $phoneCheckQuery = "SELECT phoneNumber FROM patient WHERE phoneNumber = ? 
            UNION  
            SELECT phoneNumber FROM doctor WHERE phoneNumber = ? AND doctorId <> ?";

            $phoneCheckQueryRun = mysqli_prepare($con, $phoneCheckQuery);
            mysqli_stmt_bind_param($phoneCheckQueryRun, "iii", $phone, $phone, $doctorId);
            mysqli_stmt_execute($phoneCheckQueryRun);
            mysqli_stmt_store_result($phoneCheckQueryRun);

            if (mysqli_stmt_num_rows($phoneCheckQueryRun) > 0) {
                $response =500;
                $msg = "Phone already exists!";
            } //3m et7a2a2 mn r2m iza mwjud 

            mysqli_stmt_close($phoneCheckQueryRun);
        }

        if($response != 500)
        {
            $user_query = "UPDATE user SET Fname=? , Lname=? , email=? WHERE userId=? "; //hun response 200 set ljdid information
            $user_query_run = mysqli_prepare($con, $user_query);
            mysqli_stmt_bind_param($user_query_run, "sssi", $fname, $lname, $email, $userId);
    
            if(mysqli_stmt_execute($user_query_run)){

                $doctor_query = "UPDATE doctor SET clinicId=? , phoneNumber=? WHERE doctorId=? "; //hun b table dr fo2 tble user
                $doctor_query_run = mysqli_prepare($con, $doctor_query);
                mysqli_stmt_bind_param($doctor_query_run, "iii", $clinicId, $phone, $doctorId);
    
                if(mysqli_stmt_execute($doctor_query_run))
                {
                    $response =200;
                    $msg ="Doctor Account Updated Successfully!";   
                    
                    $data["fname"] = $fname;
                    $data["lname"] = $lname;
                    $data["email"] = $email;
                    $data["phone"] = $phone;
                    $data["clinic"] = $clinicId;
                }else{  
                    $response =500;
                    $msg ="Something Went Wrong!";
                }

                mysqli_stmt_close($doctor_query_run);     
                
            }else{
                mysqli_close($con);
                $response =500;
                $msg ="Something Went Wrong!";
            }

            mysqli_stmt_close($user_query_run);
        }

        mysqli_stmt_close($Email_check_query_run);
        mysqli_close($con);

    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data); //hun 3m eb3t data le 3byton
}