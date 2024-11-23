<?php
require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //bt7a2a2 awl shi eno talab mn no3 .post 
    $json = json_decode(file_get_contents('php://input')); //3m eb3t post request mn front la back 

    $fname = test_input($_POST['doctorFN']); //3m 22ra doctorfn w w w
    $lname = test_input($_POST['doctorLN']);
    $email = test_input($_POST['doctorEmail']);
    $phone = test_input($_POST['doctorPhone']);
    $clinicId = mysqli_real_escape_string($con, $_POST['doctorClinic']);
    $password = test_input($_POST['doctorPass']);
    $confirmation = test_input($_POST['doctorPassConfirm']);
    $role = 1;

    $data = [];
    $response = 200;

    if($fname == ""){
        $response = 500;
        $msg= "Please Enter Doctor First Name!";
    }
    else if(!validateName($fname)){
        $response = 500;
        $msg= "Please Enter a Valid Fname!";
    }
    else if($lname == ""){
        $response = 500;
        $msg= "Please Enter Doctor Last Name!";
    }else if(!validateName($lname)){
        $response = 500;
        $msg= "Please Enter a Valid Lname!";
    }else if($email == ""){
        $response = 500;
        $msg= "Please Enter Doctor Email!";
    }else if(!validateEmail($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $response = 500;
        $msg= "Please Enter a Valid Email!";
    }else if($phone == ""){
        $response = 500;
        $msg= "Please Enter Doctor Phone Number!";
    }else if(!validatePhone($phone)){
        $response = 500;
        $msg= "Please Enter a Valid Phone Number!";
    }else if($clinicId == "" || $clinicId == "clinic"){
        $response = 500;
        $msg= "Please Enter Doctor Speciality!";
    }else if($password == ""){
        $response = 500;
        $msg= "Please Enter Doctor Password!";
    }else if(!validatePass($password)){
        $response = 500;
        $msg= "Please Enter a Valid Password!";
    }else if($confirmation == ""){
        $response = 500;
        $msg= "Please Confirm Password!";
    }else if($password != $confirmation){
        $response = 500;
        $msg= "Password Confirmation Incorrect!";
    }
    else { //response 200

        $Email_check_query = "SELECT * FROM user WHERE email=?";  //3m et7a2a2 mn email iza mwjud abl
        $Email_check_query_run = mysqli_prepare($con, $Email_check_query);
        mysqli_stmt_bind_param($Email_check_query_run, "s", $email);
        mysqli_stmt_execute($Email_check_query_run);
        mysqli_stmt_store_result($Email_check_query_run);
        if (mysqli_stmt_num_rows($Email_check_query_run) > 0) {
            $response = 500;
            $msg = "Email already exists!";
        }else{
            $phoneCheckQuery = "SELECT phoneNumber FROM patient WHERE phoneNumber = ? 
            UNION 
            SELECT phoneNumber FROM doctor WHERE phoneNumber = ?";
    
            $phoneCheckQueryRun = mysqli_prepare($con, $phoneCheckQuery);
            mysqli_stmt_bind_param($phoneCheckQueryRun, "ii", $phone, $phone);
            mysqli_stmt_execute($phoneCheckQueryRun);
            mysqli_stmt_store_result($phoneCheckQueryRun);
            if (mysqli_stmt_num_rows($phoneCheckQueryRun) > 0) {  
                $response = 500;
                $msg = "Phone already exists!";  
                mysqli_stmt_close($phoneCheckQueryRun);
            }
        }

        if($response != 500)
        {
            $activate_token = bin2hex(random_bytes(16)); //hatet elo value hashing
            $activate_token_hash = hash("sha256",$activate_token);
            $hashedNewPassword = password_hash($password, PASSWORD_DEFAULT);
            $user_query = "INSERT INTO user (Fname, Lname, email, password, role, account_activation_hash) VALUES (?, ?, ?, ?, ?, ?)";
            $user_query_run = mysqli_prepare($con, $user_query);
            mysqli_stmt_bind_param($user_query_run, "ssssis", $fname, $lname, $email, $hashedNewPassword, $role, $activate_token_hash);
    
            if (mysqli_stmt_execute($user_query_run)) { // 3m hotelo userid
                $getUserId_query = "SELECT userId FROM user WHERE email=?";
                $getUserId_query_run = mysqli_prepare($con, $getUserId_query);
                mysqli_stmt_bind_param($getUserId_query_run, "s", $email);
                mysqli_stmt_execute($getUserId_query_run);
                mysqli_stmt_store_result($getUserId_query_run);
    
                if (mysqli_stmt_num_rows($getUserId_query_run) > 0) {
                    mysqli_stmt_bind_result($getUserId_query_run, $userId);  //hun la jib user id w hot insert b table dr
                    mysqli_stmt_fetch($getUserId_query_run);

                    $doctor_query = "INSERT INTO doctor (userId, clinicId, phoneNumber) VALUES (?, ?, ?)";
                    $doctor_query_run = mysqli_prepare($con, $doctor_query);
                    mysqli_stmt_bind_param($doctor_query_run, "iii", $userId, $clinicId, $phone);
    
                    if (mysqli_stmt_execute($doctor_query_run)) {   //la erk3 eb3t email la doctor
                        $mail = new PHPMailer();
                        try {
                            $mail->isSMTP(); // Set mailer to use SMTP
                            $mail->Host = "smtp.gmail.com"; // Define SMTP host
                            $mail->SMTPAuth = true; // Enable SMTP authentication
                            $mail->SMTPSecure = 'tls'; // Set type of encryption
                            $mail->Port = 587; // Set port to connect SMTP
                            $mail->Username = "healthhubcenter23@gmail.com"; // Set Gmail username
                            $mail->Password = "clctytzjvtgjfhei"; // Set Gmail password

                            //Email Composition
                            $mail->setFrom("noreply@example.com");
                            $mail->addAddress($email);
                            $mail->Subject = "Account Activation";
                            $mail->Body = <<<END
                            Click <a href="http://localhost:3000/activate-account.php?token=$activate_token">here</a> 
                            to activate your account.
                            END;

                            $mail->IsHTML(true);
                            $mail->send();

                            $response = 200; //iza naja7
                            $msg = "Doctor Registered Successfully! An Email has been sent to him in order to Activate his Account.";

                            $data["fname"] = $fname;
                            $data["lname"] = $lname;
                            $data["email"] = $email;
                            $data["phone"] = $phone;
                            $data["clinic"] = $clinicId;

                        } catch (Exception $e) {
                            $response = 500;
                            $msg = "Something Went Wrong While Sending Activation Email!";
                        }

                    } else {                          
                        $response = 500;
                        $msg = "Something Went Wrong!";
                    }

                    mysqli_stmt_close($doctor_query_run);
                }
                mysqli_stmt_close($getUserId_query_run);
            }else{
                $response = 500;
                $msg = "Something Went Wrong!";
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