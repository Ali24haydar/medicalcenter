<?php

include("config/dbcon.php");

// Counter Section //function la counter
function getRowCount($table) {
    global $con;
    $query = "SELECT * FROM $table";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_num_rows($result);
    } else {
        die("Error in prepared statement: " . mysqli_error($con));
    }
}


//Doctor Section
function getDoctors(){
    global $con;
    $query= 'SELECT doctor.profilePic AS doctorPhoto, CONCAT(user.Fname, " ", user.Lname) AS FullName, clinic.name AS clinicName, media.facebook, media.instagram, media.linkedin
    FROM doctor
    LEFT JOIN user   ON doctor.userId = user.userId
    LEFT JOIN clinic ON clinic.clinicId = doctor.clinicId
    LEFT JOIN media  ON doctor.doctorId = media.doctorId;
    ';
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    } else {
        die("Error in prepared statement: " . mysqli_error($con));
    }
}


// Clinic Section
function getClinics(){
    global $con;
    $query    = 'SELECT * FROM clinic';
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    } else {
        die("Error in prepared statement: " . mysqli_error($con));
    }
}

// Footer Section
function getOpeningHour(){
    global $con;
    
    $query    = "SELECT *, LEFT(day, 3) AS shortDay  FROM medicalhours ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    } else {
        die("Error in prepared statement: " . mysqli_error($con));
    }
}

?>