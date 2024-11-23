<?php
require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $restrictedFilter=$json->filterBy;

    class patient
{
    public $userId;
    public $patientName;
    public $registrationDate;
    public $restricted;
}

if($restrictedFilter == 2){
    $query= "SELECT userId, CONCAT(Fname, ' ', Lname) AS patientName, registrationDate, restricted FROM user WHERE role = 2";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    $result = mysqli_stmt_get_result($query_run);
}else{
    $query= "SELECT userId, CONCAT(Fname, ' ', Lname) AS patientName, registrationDate, restricted FROM user WHERE role = 2 AND restricted =?";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($query_run, "i", $restrictedFilter);
    mysqli_stmt_execute($query_run);
    $result = mysqli_stmt_get_result($query_run);
}

    if (mysqli_num_rows($result) > 0) {
        $data = [];
        // output data of each row
        for ($i = 0; $row = $result->fetch_assoc(); $i++) {
            $d = new patient();
            $d->userId = $row['userId'];
            $d->patientName = $row['patientName'];
            $d->registrationDate = $row['registrationDate'];
            $d->restricted = $row['restricted'];
            array_push($data, $d);
        }

        echo json_encode($data);

    }else{
        echo json_encode("empty");
    }
}



?>
