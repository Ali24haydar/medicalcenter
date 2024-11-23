<?php

    session_start();
    header('Content-type: application/json');
    $userId = $_SESSION['auth_user']['user_id'];

    class patient{
        public $firstName;
        public $lastName;
        public $email;
        public $phoneNumber;
        public $date;
        public $gender;
        public $bloodType;
    }
    include('../config/dbcon.php');
    $select_patient_info = 'SELECT  
                    user.Fname, user.Lname, user.email, patient.phoneNumber, patient.dateOfBirth, patient.gender, patient.bloodType
            FROM 
                     user
            JOIN
                    patient ON user.userId = patient.userId 
            WHERE
                    user.userId = ?; 
            ';
    
    $prepare = mysqli_prepare($con, $select_patient_info);
    if ($prepare) {
        mysqli_stmt_bind_param($prepare, "i", $userId); //brbt rad m3 user id w iza akbr mn 0 yaane l2it le bde yeh b3mln output
        mysqli_stmt_execute($prepare);
        $patient_record = mysqli_stmt_get_result($prepare);
        if(mysqli_num_rows($patient_record) > 0){
            $patientInfo = [];
            // output data of each row
            if ($record = $patient_record->fetch_assoc()) {
                $patient = new patient();
                $patient-> firstName   = $record['Fname'];
                $patient-> lastName    = $record['Lname'];
                $patient-> email       = $record['email'];
                $patient-> phoneNumber = $record['phoneNumber'];
                $patient-> date        = $record['dateOfBirth'];
                $patient-> gender      = $record['gender'];
                $patient-> bloodType   = $record['bloodType'];
                array_push($patientInfo,$patient);
            }
            else {
                echo json_encode(null); // Return null if no data is found
            }
        }
    } 
    else {
        die("Error in prepared statement: " . mysqli_error($con));
    }
    echo json_encode($patientInfo);
?>