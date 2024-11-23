<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the necessary files
require '../../config/dbcon.php'; // Ensure this is the correct path for your dbcon.php
require '../../PHPMailer-master/src/Exception.php';  // Ensure this path is correct
require '../../PHPMailer-master/src/PHPMailer.php';  // Ensure this path is correct
require '../../PHPMailer-master/src/SMTP.php';  // Ensure this path is correct

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Email configuration
$emailHost = 'smtp.gmail.com';
$emailPort = 587;
$emailUsername = 'healthhubcenter23@gmail.com';
$emailPassword = 'clctytzjvtgjfhei';  // Use App Password if 2FA is enabled

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

// Fetch upcoming appointments for the next day
$tomorrow = date('Y-m-d', strtotime('+1 day'));  // Get tomorrow's date
$stmt = $con->prepare("SELECT u.email, a.date, a.time FROM appointment a 
                       JOIN patient p ON a.patientId = p.patientId 
                       JOIN user u ON p.userId = u.userId 
                       WHERE a.date = ? AND a.status = 'accepted'");  // Get appointments for tomorrow
$stmt->bind_param('s', $tomorrow);
$stmt->execute();
$result = $stmt->get_result();
$appointments = $result->fetch_all(MYSQLI_ASSOC);

$numRows = $result->num_rows;

// Initialize response message and status
$response = 200;  // Default success
$msg = "Emails sent successfully for all appointments.";
$errors = [];

// Check if appointments exist
if ($numRows > 0) {
    // Send confirmation emails for each appointment
    foreach ($appointments as $appointment) {
        $email = $appointment['email'];
        $date = $appointment['date'];
        $time = $appointment['time'];

        try {
            // Email content
            $mail->setFrom($emailUsername);
            $mail->addAddress($email);
            $mail->Subject = 'Appointment Confirmation';
            $mail->Body = "Dear patient,\n\nThis is a reminder for your appointment scheduled for $date at $time.\n\nRegards,\nYour Clinic";

            // Send email
            if (!$mail->send()) {
                $errors[] = "Failed to send to $email: " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            $errors[] = "Failed to send to $email: " . $e->getMessage();
        }
    }

    // If there were any errors, set response code to 500 and message
    if (count($errors) > 0) {
        $response = 500;
        $msg = "Some emails failed to send.";
        $msg .= "\n" . implode("\n", $errors);
    }
} else {
    $response = 500;
    $msg = "No appointments for tomorrow!";
}

// Return JSON response
$data = [
    "response" => $response,
    "message" => $msg,
];
echo json_encode($data);

// Close the database connection
$con->close();
?>
