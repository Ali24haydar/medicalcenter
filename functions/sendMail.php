<?php
include('validateFunctions.php');
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $fname   = test_input($_POST['fname']);      //echo $fname;
    $lname   = test_input($_POST['lname']);      //echo $lname;
    $name    = test_input($fname. " " .$lname); //echo $name;
    $email   = test_input($_POST['email']);      //echo $email;
    $subject = test_input($_POST['subject']);    //echo $subject;
    $message = test_input($_POST['message']);    //echo $message;

    $data = [];
    
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($subject) && !empty($message)
    && validateName($fname) && validateName($lname) && validateEmail($email) && validateSubjectStructure($subject)) 
    { 
     
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
        $mail->setFrom($email, $name);// Set "From" address to the user-entered email
        $mail->addReplyTo($email, $name);
        $mail->addAddress('healthhubcenter23@gmail.com'); // Add recipient
        $mail->isHTML(true); // Set sender email
        $mail->Subject = "Subject: $subject"; // Set email subject
        $mail->Body = " $message "; // Set email body
        $mail->Send(); 

        $response = 200;
        $msg = "Thank you for contacting us!";
        $data["email"] = $email;
        $data["name"] = $name;
        $data["subject"] = $subject;
        $data["message"] = $message;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        $response = 500;
        $msg = "Message could not be sent. Please try again later.";
    }

    }else{
        $response = 500;
        $msg= "Please Enter Needed Information!";
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}

?>