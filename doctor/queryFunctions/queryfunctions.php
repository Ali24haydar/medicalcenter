<?php

include("../config/dbcon.php");

function redirect($url, $message){
    $_SESSION['message']= $message;
    header('Location: ' .$url);
    exit();
}

function getAppoinmentCount($id){
    global $con;
    $query = "SELECT * FROM `appointment`, `doctor` WHERE doctor.doctorId = appointment.doctorId
     AND doctor.doctorId = ? AND (appointment.status = 'completed' OR appointment.status = 'accepted')";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($query_run);
    mysqli_stmt_close($stmt);

    return $num_rows;
}

function getRequestCount($id){
    global $con;
    $query = "SELECT * FROM `appointment`, `doctor` WHERE doctor.doctorId = appointment.doctorId 
    AND doctor.doctorId = ? AND appointment.status = 'pending'";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($query_run);
    mysqli_stmt_close($stmt);

    return $num_rows;
}

function getPastAppointments($id,$id2){
    global $con;
    $query = "SELECT * FROM `appointment`, `patient` WHERE patient.patientId = appointment.patientId
     AND patient.patientId = ? AND appointment.status = 'completed' AND appointment.doctorId = ?";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $id,$id2);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($query_run);
    mysqli_stmt_close($stmt);

    return $num_rows;
}

function getUpcomingAppointments($id,$id2){
    global $con;
    $query = "SELECT * FROM `appointment`, `patient` WHERE patient.patientId = appointment.patientId AND 
    patient.patientId = ? AND (appointment.status = 'pending' OR appointment.status = 'accepted') AND
    appointment.doctorId = ?";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $id,$id2);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($query_run);
    mysqli_stmt_close($stmt);

    return $num_rows;
}

function getPatientCount($id){
    global $con;
    $query = "SELECT COUNT(DISTINCT patient.patientId) AS patient_count FROM `patient`, `appointment`, `doctor` WHERE patient.patientId = appointment.patientId AND doctor.doctorId = appointment.doctorId AND doctor.doctorId = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);

    if ($query_run) {
        $row = mysqli_fetch_assoc($query_run);
        mysqli_stmt_close($stmt);
        return $row['patient_count'];
    } else {
        mysqli_stmt_close($stmt);
        return 0;
    }
}

function getDoctorId($id){
    global $con;
    $query = "SELECT doctor.doctorId FROM doctor 
             INNER JOIN user ON doctor.userId = user.userId
             WHERE user.userId = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);

    if ($query_run) {
        $doctorId = mysqli_fetch_assoc($query_run)['doctorId'];
        mysqli_stmt_close($stmt);
        return $doctorId;
    } else {
        mysqli_stmt_close($stmt);
        return null;
    }
}

function getDoctorById($id){
    global $con;
    $query = "SELECT * FROM doctor 
             INNER JOIN user ON doctor.userId = user.userId
             WHERE user.userId = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);

    return $query_run;
}

function getAppointmentRequest($id){
    global $con;
    $query = "SELECT `Fname`, `Lname`, `date`, `time`, `appId` FROM `appointment`, `patient`, `user`, `doctor` WHERE 
    user.userId = patient.userId AND appointment.patientId = patient.patientId AND 
    appointment.status = 'pending' AND doctor.doctorId = appointment.doctorId AND doctor.doctorId = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $query_run;
}

function getAppointments(){
    global $con;
    $query = "SELECT `Fname`, `Lname`, `date`, `time`, `status` FROM `appointment`, `patient`, `user` WHERE 
    user.userId = patient.userId AND appointment.patientId = patient.patientId";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $query_run;
}

function getAppointmentById($id,$id2){
    global $con;
    $query = "SELECT * FROM `appointment`, `patient`, `user` WHERE 
    user.userId = patient.userId AND appointment.patientId = patient.patientId AND patient.patientId = ?
    AND appointment.doctorId = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $id,$id2);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $query_run;
}

function getPatients($id){
    global $con;
    $query = "SELECT DISTINCT patient.*, user.* FROM `patient`, `user`, `appointment` WHERE patient.userId = user.userId 
    AND appointment.patientId = patient.patientId AND appointment.doctorId = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $query_run;
}

function getPatientById($id){
    global $con;
    $query = "SELECT * FROM `patient`, `user` WHERE patient.userId = user.userId AND patient.PatientId = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return $query_run;
}


?>