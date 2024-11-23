<?php
require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $id= mysqli_real_escape_string($con, $json->userId);

    class patient
{
    public $patientId;
    public $Pname;
    public $email;
    public $phoneNumber;
    public $gender;
    public $bloodType;
    public $dateOfBirth;
}

$query= "SELECT CONCAT(user.Fname, ' ', user.Lname) AS Pname, user.email AS email, patient.patientId As patientId , patient.gender AS gender, patient.bloodType AS bloodType, patient.dateOfBirth AS dateOfBirth, patient.phoneNumber AS phoneNumber
FROM user, patient 
WHERE user.userId = patient.userId
AND user.userId =?";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($query_run, "i", $id);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

    if (mysqli_num_rows($result) > 0) {
        $data = [];
        // output data of each row
        for ($i = 0; $row = $result->fetch_assoc(); $i++) {
            $p = new patient();
            $p->patientId = $row['patientId'];
            $p->Pname = $row['Pname'];
            $p->email = $row['email'];
            if($row['phoneNumber'] == ""){
                $p->phoneNumber = "undefined";
            }else{
                $p->phoneNumber = $row['phoneNumber'];
            }
            $p->gender = $row['gender'];
            if($row['phoneNumber'] == ""){
                $p->bloodType = "undefined";
            }else{
                $p->bloodType = $row['bloodType'];
            }
            $p->dateOfBirth = $row['dateOfBirth'];
            array_push($data, $p);
        }

        echo json_encode($data);

    }else{
        echo json_encode("empty");
    }
}

?>