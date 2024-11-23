<?php
require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $deletedFilter=$json->filterBy;

    class doctor //la et2akad mn m3lumet le jeyebon kelon mwjudin
{
    public $doctorId;
    public $userId;
    public $docName;
    public $clinicName;
    public $profilePic;
    public $deleted;
}

if($deletedFilter == 2){
    $query= "SELECT  CONCAT(user.Fname, ' ', user.Lname) AS docName, clinic.name AS clinicName, doctor.doctorId AS doctorId, doctor.userId AS userId , doctor.profilePic AS profilePic, doctor.deleted AS deleted
    FROM user
    INNER JOIN doctor ON doctor.userId = user.userId
    LEFT JOIN clinic ON doctor.clinicId = clinic.clinicId";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    $result = mysqli_stmt_get_result($query_run);
}else{
    $query= "SELECT  CONCAT(user.Fname, ' ', user.Lname) AS docName, clinic.name AS clinicName, doctor.doctorId AS doctorId, doctor.userId AS userId, doctor.profilePic AS profilePic, doctor.deleted AS deleted
    FROM user
    INNER JOIN doctor ON doctor.userId = user.userId
    LEFT JOIN clinic ON doctor.clinicId = clinic.clinicId
    WHERE doctor.deleted =?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "i", $deletedFilter);
    mysqli_stmt_execute($query_run);
    $result = mysqli_stmt_get_result($query_run);
}

    if (mysqli_num_rows($result) > 0) {
        $data = [];
        // output data of each row
        for ($i = 0; $row = $result->fetch_assoc(); $i++) {
            $d = new doctor();
            $d->doctorId = $row['doctorId'];
            $d->userId = $row['userId'];
            $d->docName = $row['docName'];
            $d->clinicName = $row['clinicName'];
            $d->profilePic = $row['profilePic'];
            $d->deleted = $row['deleted'];
            array_push($data, $d);
        }

        echo json_encode($data);

    }else{
        echo json_encode("empty");
    }
}



?>
