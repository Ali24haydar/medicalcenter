<?php

require '../../config/dbcon.php';
require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Email configuration
$emailHost = 'smtp.gmail.com';
$emailPort = 587;
$emailUsername = 'healthhubcenter23@gmail.com';
$emailPassword = 'clctytzjvtgjfhei';

$data = [];

// Create a PHPMailer instance
$mail = new PHPMailer(true);

// SMTP configuration
$mail->isSMTP();
$mail->Host = $emailHost;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = $emailPort;
$mail->Username = $emailUsername;
$mail->Password = $emailPassword;

// Get urgent blood types
$stmtUrgent = $con->query("SELECT DISTINCT bloodType FROM urgentBT"); //3m jib fe2at dam mn database
$urgentBloodTypes = $stmtUrgent->fetch_all(MYSQLI_ASSOC);

$numRows = $stmtUrgent->num_rows;

if($numRows > 0){
    // Send urgent blood type notifications to matching donors
    foreach ($urgentBloodTypes as $row) {
        $bloodType = $row['bloodType'];
        $stmt = $con->prepare("SELECT email FROM donor WHERE bloodType = ?");
        $stmt->bind_param('s', $bloodType);
        $stmt->execute();
        $result = $stmt->get_result();
        $donors = $result->fetch_all(MYSQLI_ASSOC);

        if(mysqli_num_rows($result) >0){
            foreach ($donors as $donor) {
                $email = $donor['email'];
                try {  //risele le btusal bs bdi urgent bt
                    // Email content
                    $mail->setFrom($emailUsername);
                    $mail->addAddress($email);
                    $mail->Subject = 'Urgent Blood Type Notification';
                    $mail->Body = "Dear donor,\n\nThere is an urgent need for blood type $bloodType.\n\nRegards,\nHealth Hub";
    
                    // Send email
                    $mail->send();
    
                    $response = 200;
                    $msg = "Email Sent Successfully!";
                } catch (Exception $e) {
                    $response = 500;
                    $msg = $e->getMessage();
                }
            }
        }else{
            $response = 500;
            $msg = "No Matching Blood Type!";
        }

    }
}else{
    $response = 500;
    $msg = "No Urgent Blood Types!";
}

$data["response"] = $response;
$data["message"] = $msg;
echo json_encode($data);

// Close the database connection
$con->close();
?>
