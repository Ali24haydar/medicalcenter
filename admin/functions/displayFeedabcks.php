<?php

class feedback
{
    public $feedbackId;
    public $docName;
    public $patientName;
    public $feedback;
    public $date;
    public $published;
}

require_once('../../config/dbcon.php');

$query= "SELECT
f.feedbackId AS feedbackId,
f.message AS feedback,
f.date AS date,
f.published AS published,
CONCAT(doct_user.Fname, ' ', doct_user.Lname) AS docName,
CONCAT(pat_user.Fname, ' ', pat_user.Lname) AS patientName
FROM
feedback AS f
JOIN
doctor ON f.doctorId = doctor.doctorId
JOIN
user AS doct_user ON doctor.userId = doct_user.userId
JOIN
patient ON f.patientId = patient.patientId
JOIN
user AS pat_user ON patient.userId = pat_user.userId
ORDER BY
date DESC;";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    for ($i = 0; $row = $result->fetch_assoc(); $i++) {
        $fdk = new feedback();
        $fdk->feedbackId = $row['feedbackId'];
        $fdk->docName = $row['docName'];
        $fdk->patientName = $row['patientName'];
        $fdk->feedback = $row['feedback'];
        $fdk->date = $row['date'];
        $fdk->published = $row['published'];
        array_push($data, $fdk);
    }

    echo json_encode($data);

}else{
    echo json_encode("empty");
}

?>
