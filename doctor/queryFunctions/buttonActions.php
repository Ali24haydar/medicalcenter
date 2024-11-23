<?php
require '../../config/dbcon.php';
require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Email Configuration
$emailHost = 'smtp.gmail.com';
$emailPort = 587;
$emailUsername = 'healthhubcenter23@gmail.com';
$emailPassword = 'clctytzjvtgjfhei';

// Email Sending Function
function sendEmail($recipientEmail, $subject, $body)
{
    global $emailHost, $emailPort, $emailUsername, $emailPassword;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $emailHost;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = $emailPort;
        $mail->Username = $emailUsername;
        $mail->Password = $emailPassword;

        $mail->setFrom($emailUsername);
        $mail->addAddress($recipientEmail);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return ['response' => 200, 'message' => 'Email sent successfully!'];
    } catch (Exception $e) {
        return ['response' => 500, 'message' => $e->getMessage()];
    }
}

// Check which button was clicked
if (isset($_POST['del-btn']) || isset($_POST['acc-btn'])) {
    $appointmentId = $_POST['id']; // Match the JavaScript key
    $status = isset($_POST['del-btn']) ? 'rejected' : 'accepted';

    // Update appointment status in the database
    $update_query = "UPDATE appointment SET status = ? WHERE appId = ?";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param('si', $status, $appointmentId);
    $res = $stmt->execute();

    if ($res) {
        // Fetch associated email
        $sql = "SELECT email FROM appointment 
                INNER JOIN patient ON appointment.patientId = patient.patientId 
                INNER JOIN user ON patient.userId = user.userId 
                WHERE appId = ?";
        $stmtEmail = $con->prepare($sql);
        $stmtEmail->bind_param('i', $appointmentId);
        $stmtEmail->execute();
        $result = $stmtEmail->get_result();

        if ($row = $result->fetch_assoc()) {
            $email = $row['email'];

            // Email content based on the action
            $subject = $status === 'rejected' ? 'Appointment Rejection' : 'Appointment Confirmation';
            $body = $status === 'rejected' 
                ? "Dear Patient,\n\nWe regret to inform you that your appointment has been rejected.\n\nSincerely,\nHealth Hub"
                : "Dear Patient,\n\nWe are pleased to inform you that your appointment has been accepted.\n\nSincerely,\nHealth Hub";

            // Send email
            $emailResponse = sendEmail($email, $subject, $body);
            echo json_encode($emailResponse);
        } else {
            echo json_encode(['response' => 404, 'message' => 'Email not found!']);
        }
    } else {
        echo json_encode(['response' => 500, 'message' => 'Failed to update appointment status!']);
    }
} else {
    echo json_encode(['response' => 400, 'message' => 'Invalid request!']);
}

$con->close();
?>
