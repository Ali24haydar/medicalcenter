<?php
    session_start();
    $userId = $_SESSION['auth_user']['user_id'];

    header('Content-type: application/json');
    
    class user{ //class htet b2lbo variable la trtib
        public $id;
        public $doctor;
        public $date;
        public $time;
        public $status;
    }
    $patinetApp = [];
    include('../config/dbcon.php'); // 3m jib mawa3id el patient m3 esm dr w tari5 w w2t w status pending and accepted
    $query = 'SELECT
	                appointment.appID AS appointmentID, concat(user.Fname, " ", user.Lname) AS doctor, appointment.date, appointment.time, patient.patientId, doctor.doctorId, appointment.status
                FROM
                    appointment
                JOIN
                    doctor ON appointment.doctorid = doctor.doctorId
                JOIN
                    patient ON appointment.patientId = patient.patientId
                JOIN
                    user ON doctor.userId = user.userId
                WHERE
                    patient.userId = ? AND (appointment.status = "pending" 
                    OR appointment.status = "accepted")';
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $userId); //3m erbot rad m3 userid
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0){
            
            // output data of each row
            for ($i = 0; $row = $result->fetch_assoc(); $i++) { //to outout kl row
                $user = new user();
                $user-> id     = $row['appointmentID'];
                $user-> doctor = $row['doctor'];
                $user-> date   = $row['date'];
                $user-> time   = $row['time'];
                $user-> status   = $row['status'];
                array_push($patinetApp, $user);
            }
        }
    } 
    else {
        die("Error in prepared statement: " . mysqli_error($con));
    }
    echo json_encode($patinetApp);

?>