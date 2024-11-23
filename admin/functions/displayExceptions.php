<?php
require_once('../../config/dbcon.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $id= mysqli_real_escape_string($con, $json->doctorId);

    class WorkingException
{
    public $doctorId;
    public $date;
    public $fromHour;
    public $toHour;
    public $available;
}

$query= "SELECT * FROM workingexception WHERE doctorId =?";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($query_run, "i", $id);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

    if (mysqli_num_rows($result) > 0) {
        $data = [];
        // output data of each row
        for ($i = 0; $row = $result->fetch_assoc(); $i++) {
            $ex = new WorkingException();
            $ex->doctorId = $row['doctorId'];
            $ex->date = $row['date'];
            $ex->fromHour = $row['fromHour'];
            $ex->toHour = $row['toHour'];
            $ex->available = $row['available'];
            array_push($data, $ex);
        }

        echo json_encode($data);

    }else{
        echo json_encode("empty");
    }
}

?>