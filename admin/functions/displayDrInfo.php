<?php
require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $id= mysqli_real_escape_string($con, $json->doctorId);

    class doctor
{
    public $userId;
    public $Fname;
    public $Lname;
    public $email;
    public $phoneNumber;
    public $clinicId;
}

$query= "SELECT user.Fname AS Fname, user.Lname AS Lname, user.email AS email, doctor.userId As userId, doctor.clinicId As clinicId, doctor.phoneNumber As phoneNumber 
FROM user, doctor 
WHERE user.userId = doctor.userId
AND doctor.doctorId =?";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($query_run, "i", $id);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

    if (mysqli_num_rows($result) > 0) {
        $data = [];
        // output data of each row
        for ($i = 0; $row = $result->fetch_assoc(); $i++) {
            $dr = new doctor();
            $dr->userId = $row['userId'];
            $dr->Fname = $row['Fname'];
            $dr->Lname = $row['Lname'];
            $dr->email = $row['email'];
            $dr->phoneNumber = $row['phoneNumber'];
            $dr->clinicId = $row['clinicId'];
            array_push($data, $dr);
        }

        echo json_encode($data);

    }else{
        echo json_encode("empty");
    }
}

?>