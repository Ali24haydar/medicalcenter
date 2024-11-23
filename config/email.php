 <?php
    //Include required phpmailer files
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    //Define name spaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
     
    $mail = new PHPMailer();
    
    try {
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = "smtp.gmail.com"; // Define SMTP host
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->SMTPSecure = 'tls'; // Set type of encryption
        $mail->Port = 587; // Set port to connect SMTP
        $mail->Username = "healthhubcenter23@gmail.com"; // Set Gmail username
        $mail->Password = "clctytzjvtgjfhei"; // Set Gmail password
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>