<?php

class doctor_Working_Hours
{
    public $doctorId;
    public $docName;
    public $profilePic;
    public $workingDays; // Array to store working days
}

require_once('../../config/dbcon.php');

$query = "SELECT CONCAT(user.Fname, ' ', user.Lname) AS docName, 
            doctor.doctorId AS doctorId, doctor.profilePic AS profilePic, 
            dh.day AS day, dh.fromHour AS fromHour, dh.toHour AS toHour, dh.available AS available 
            FROM user
            JOIN doctor ON user.userId = doctor.userId
            JOIN doctorhours AS dh ON doctor.doctorId = dh.doctorId
            JOIN medicalHours ON medicalHours.day = dh.day AND medicalHours.closed = 0
            ORDER BY FIELD(dh.day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');";

$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $doctorId = $row['doctorId'];

        // Check if the doctorId is already in the associative array
        if (!isset($data[$doctorId])) {
            // If not, create a new doctor_Working_Hours object
            $wh = new doctor_Working_Hours();
            $wh->doctorId = $doctorId;
            $wh->docName = $row['docName'];
            $wh->profilePic = $row['profilePic'];
            $wh->workingDays = []; // Initialize the workingDays array
            $data[$doctorId] = $wh;
        }

        // Add working day details to the workingDays array
        $workingDay = [
            'day' => $row['day'],
            'fromHour' => $row['fromHour'],
            'toHour' => $row['toHour'],
            'available' => $row['available']
        ];

        $data[$doctorId]->workingDays[] = $workingDay;
    }

    // Convert the associative array to a simple array of objects
    $resultArray = array_values($data);

    echo json_encode($resultArray);

} else {
    echo json_encode("empty");
}

?>