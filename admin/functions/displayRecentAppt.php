<?php

class recentAppt
{
    public $PatientName;
    public $date;
    public $time;
    public $status;
}

require_once('../../config/dbcon.php');

$query = "SELECT CONCAT(user.Fname, ' ', user.Lname) AS PatientName, app.date AS date, app.time AS time, app.status AS status
              FROM appointment AS app
              INNER JOIN patient
              ON app.patientId = patient.patientId
              INNER JOIN user
              ON patient.userId = user.userId
              WHERE app.status <> 'rejected';";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    for ($i = 0; $row = $result->fetch_assoc(); $i++) {
        $rm = new recentAppt();
        $rm->PatientName = $row['PatientName'];
        $rm->date = $row['date'];
        $rm->time = $row['time'];
        $rm->status = $row['status'];
        array_push($data, $rm);
    }

    echo json_encode($data);

}else{
    echo json_encode("empty");
}

?>
