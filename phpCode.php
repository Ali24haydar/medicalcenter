<?php
session_start();

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("config/dbcon.php");

function validateName($name) {
    $nameRegex = '/^[a-zA-Z]+$/';
    return preg_match($nameRegex, $name);
}

// Function to validate email
function validateEmail($email) {
    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    return preg_match($emailRegex, $email);
}

// Function to validate password
function validatePass($pass) {
    $passRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    return preg_match($passRegex, $pass);
}

// Function to validate phone
function validatePhone($phone) {
    $lebanesePhoneRegex = '/^\d{8}$/';
    /* $lebanesePhoneRegex = '/^(?:\+961|0\d{1,2}) \d{3} \d{3}$/'; */
    return preg_match($lebanesePhoneRegex, $phone);
}

 
 if (isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['email2']) && isset($_POST['password']) 
  && isset($_POST['cpassword']) && isset($_POST['date']) && isset($_POST['gender']) && isset($_POST['mySelect'])){
    
    $firtname = mysqli_real_escape_string($con,$_POST['FirstName']);
    $lastname = mysqli_real_escape_string($con,$_POST['LastName']);
    $email = mysqli_real_escape_string($con,$_POST['email2']);
    $contact = $_POST['contact'];
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $bloodtype = $_POST['mySelect'];
    //Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if($firtname == ""){
       echo "1";
    }
    else if(!validateName($firtname)){
        echo "2";
    }
    else if($lastname == ""){
        echo "1";
    }else if(!validateName($lastname)){
        echo "2";
    }else if($email == ""){
        echo "1";
    }else if(!validateEmail($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
       echo "3";
    }else if($password == ""){
       echo "1";
    }else if(!validatePass($password)){
       echo "5";
    }else if($cpassword == ""){
        echo "6";
    }else if($password != $cpassword){
        echo "7";
    }else if($date == ""){
        echo "1";
    }else if(!isset($gender)){
        echo "1";
    }else {

        $Email_check_query = "SELECT * FROM user WHERE email=?";
        $Email_check_query_run = mysqli_prepare($con, $Email_check_query);
        mysqli_stmt_bind_param($Email_check_query_run, "s", $email);
        mysqli_stmt_execute($Email_check_query_run);
        mysqli_stmt_store_result($Email_check_query_run);
        if (mysqli_stmt_num_rows($Email_check_query_run) > 0) {
            mysqli_stmt_close($Email_check_query_run);
            mysqli_close($con);
            echo "8";
        }else{
            if($contact == ""){

                $activate_token = bin2hex(random_bytes(16));
                $activate_token_hash = hash("sha256",$activate_token);

                $stmt_user = mysqli_prepare($con, "INSERT INTO `user` (Fname, Lname, email, password, role, restricted, account_activation_hash) VALUES (?, ?, ?, ?, 2, 0, ?)");
                mysqli_stmt_bind_param($stmt_user, "sssss", $firtname, $lastname, $email, $hashed_password, $activate_token_hash);
                if(mysqli_stmt_execute($stmt_user)){
                $userId = mysqli_insert_id($con);
                 $stmt_patient = mysqli_prepare($con, "INSERT INTO `patient` (userId, gender, bloodType, dateOfBirth) VALUES (?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt_patient, "isss", $userId, $gender, $bloodtype, $date);
                    if (mysqli_stmt_execute($stmt_patient)) {

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

                            mysqli_stmt_close($stmt_user);
                            mysqli_stmt_close($stmt_patient);
                            mysqli_close($con);
                            echo "12";

                            } catch (Exception $e) {
                                echo "11";
                            }
                        } else {
                        mysqli_stmt_close($stmt_user);
                        mysqli_stmt_close($stmt_patient);
                        mysqli_close($con);
                        echo "11";
                    }
                } else {
                    mysqli_stmt_close($stmt_user);
                    mysqli_close($con);
                    echo "11";
                }
            } else {
                if (validatePhone($contact)){
                $phoneCheckQuery = "SELECT phoneNumber FROM patient WHERE phoneNumber = ? 
                UNION 
                SELECT phoneNumber FROM doctor WHERE phoneNumber = ?";

                $phoneCheckQueryRun = mysqli_prepare($con, $phoneCheckQuery);
                mysqli_stmt_bind_param($phoneCheckQueryRun, "ii", $contact, $contact);
                mysqli_stmt_execute($phoneCheckQueryRun);
                mysqli_stmt_store_result($phoneCheckQueryRun);
                if (mysqli_stmt_num_rows($phoneCheckQueryRun) > 0) {
                    mysqli_stmt_close($phoneCheckQueryRun);
                    mysqli_close($con);
                    echo "9";
                } else {

                    $activate_token = bin2hex(random_bytes(16));
                    $activate_token_hash = hash("sha256",$activate_token);

                    $stmt_user = mysqli_prepare($con, "INSERT INTO `user` (Fname, Lname, email, password, role, restricted, account_activation_hash) VALUES (?, ?, ?, ?, 2, 0, ?)");
                    mysqli_stmt_bind_param($stmt_user, "sssss", $firtname, $lastname, $email, $hashed_password, $activate_token_hash);
                    if(mysqli_stmt_execute($stmt_user)){
                    $userId = mysqli_insert_id($con);
                    $stmt_patient = mysqli_prepare($con, "INSERT INTO `patient` (userId, gender, bloodType, dateOfBirth ,phoneNumber) VALUES (?,?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt_patient, "isssi", $userId, $gender, $bloodtype, $date, $contact);
                    if (mysqli_stmt_execute($stmt_patient)) {
                            
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

                            mysqli_stmt_close($stmt_user);
                            mysqli_stmt_close($stmt_patient);
                            mysqli_close($con);
                            echo "12";

                            } catch (Exception $e) {
                                echo "11";
                            }
                        
                    } else {
                        mysqli_stmt_close($stmt_user);
                        mysqli_stmt_close($stmt_patient);
                        mysqli_close($con);
                        echo "11";
                    }
                } else {
                    mysqli_stmt_close($stmt_user);
                    mysqli_close($con);
                    echo "11";
                }
                }
            } else {
                mysqli_close($con);
                echo "4";
            }
          }
        }
    }
} else {
    echo "11";
}
?>