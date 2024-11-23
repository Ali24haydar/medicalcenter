<?php

error_log("File is accessed");

session_start();
$userId = $_SESSION['auth_user']['user_id'];
include('../config/dbcon.php');
header('Content-type: application/json');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $updateFname     = $_POST['First-Name'];
    $updateLname     = $_POST['Last-Name'];
    $updateEmail     = $_POST['pat-email'];

    $updatePhone     = empty($_POST['phone']) ? null : $_POST['phone'];
    $updateDate      = $_POST['date'];
    $updateGender    = $_POST['gender'];
    $updateBloodType = $_POST['mySelect'];

    $data = [];

    // Validate required fields
    if (empty($updateFname) || empty($updateLname) || empty($updateEmail)) {
        $data["response"] = '400'; // Missing required fields
        echo json_encode($data);
        exit;
    }

    // Begin Database Transaction (optional for data consistency)
    mysqli_begin_transaction($con);

    try {
        // Update the user table
        $userQuery = "UPDATE user 
                      SET Fname = ?, 
                          Lname = ?, 
                          email = ? 
                      WHERE userId = ?";
        $userStmt = mysqli_prepare($con, $userQuery);
        mysqli_stmt_bind_param($userStmt, "sssi", $updateFname, $updateLname, $updateEmail, $userId);

        if (!mysqli_stmt_execute($userStmt)) {
            throw new Exception("Error updating user: " . mysqli_error($con));
        }
        mysqli_stmt_close($userStmt);

        // Update the patient table
        $patientQuery = "UPDATE patient 
                         SET gender = ?, 
                             bloodType = ?, 
                             dateOfBirth = ?, 
                             phoneNumber = ? 
                         WHERE userId = ?";
        $patientStmt = mysqli_prepare($con, $patientQuery);
        mysqli_stmt_bind_param($patientStmt, "ssssi", $updateGender, $updateBloodType, $updateDate, $updatePhone, $userId);

        if (!mysqli_stmt_execute($patientStmt)) {
            throw new Exception("Error updating patient: " . mysqli_error($con));
        }
        mysqli_stmt_close($patientStmt);

        // Commit the transaction
        mysqli_commit($con);

        $data["response"] = '200'; // Success
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($con);
        $data["response"] = '500';
        $data["error"] = $e->getMessage();
    }

    mysqli_close($con);

    echo json_encode($data);
}

