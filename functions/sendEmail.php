<?php
    
    include('validateFunctions.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname   = test_input($_POST['fname']);      //echo $fname;
        $lname   = test_input($_POST['lname']);      //echo $lname;
        $name    = test_input( $fname. " " .$lname); //echo $name;
        $email   = test_input($_POST['email']);      //echo $email;
        $subject = test_input($_POST['subject']);    //echo $subject;
        $message = test_input($_POST['message']);    //echo $message;
        
       
        if(!empty($fname) && !empty($lname) && !empty($email) && !empty($subject) && !empty($message)
        && validateName($fname) && validateName($lname) && validateEmail($email) && validateSubjectStructure($subject)) {    
           
            include('../config/email.php');
            //Email Composition
            $mail->setFrom($email, $name);// Set "From" address to the user-entered email
            $mail->addReplyTo($email, $name);
            $mail->addAddress('healthhubcenter23@gmail.com'); // Add recipient
            $mail->isHTML(true); // Set sender email
            $mail->Subject = "Subject: $subject"; // Set email subject
            $mail->Body = " $message "; // Set email body
            $mail->Send(); 
            echo '200';
        }
        else{
            echo '500';
        }   
    }
?>