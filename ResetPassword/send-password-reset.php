<?php 
session_start();
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("../config/dbcon.php");

function redirect($url, $message){
    $_SESSION['message']= $message;
    header('Location: ' .$url);
    exit();
}

$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = mysqli_prepare($con, $sql);

mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expiry, $email);

mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($con) > 0) {

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
        $mail->Subject = "Password Reset";
        
        $mail->Body = <<<END

        Click <a href="http://localhost:3000/ResetPassword/reset-password.php?token=$token">here</a> 
        to reset your password.

       END;

        $mail->IsHTML(true);
        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }
    
    redirect('resetPassword-Form.php',"Message sent, please check your inbox.");
}else{
    redirect('resetPassword-Form.php',"Email is not registered in the database");
}



?>