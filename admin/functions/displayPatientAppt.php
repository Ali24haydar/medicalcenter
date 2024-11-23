<?php
require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $id= mysqli_real_escape_string($con, $json->patientId);

    class Appointment
{
    public $doctorId;
    public $docName;
    public $profilePic;
    public $date;
    public $time;
    public $status;
}

$query = "SELECT CONCAT(Fname, ' ', Lname) AS docName, app.date AS date, app.time AS time, app.status AS status, doctor.doctorId As doctorId , doctor.profilePic As profilePic
FROM user, appointment AS app, patient, doctor
WHERE app.patientId = patient.patientId 
AND app.doctorId = doctor.doctorId 
AND doctor.userId = user.userId
AND patient.patientId=? ";

$query_run = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($query_run, "i", $id);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

    if (mysqli_num_rows($result) > 0) {
        $data = [];
        // output data of each row
        for ($i = 0; $row = $result->fetch_assoc(); $i++) {
            $appt = new Appointment();
            $appt->doctorId = $row['doctorId'];
            $appt->docName = $row['docName'];
            $appt->profilePic = $row['profilePic'];
            $appt->date = $row['date'];
            $appt->time = $row['time'];
            $appt->status = $row['status'];
            array_push($data, $appt);
        }

        echo json_encode($data);

    }else{
        echo json_encode("empty");
    }
}

?>