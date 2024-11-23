<?php

class reminder
{
    public $reminderId;
    public $reminder;
    public $date;
}

require_once('../../config/dbcon.php');

$query= "SELECT * FROM reminders ORDER BY date DESC";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    for ($i = 0; $row = $result->fetch_assoc(); $i++) {
        $rm = new reminder();
        $rm->reminderId = $row['reminderId'];
        $rm->reminder = $row['reminder'];
        $rm->date = $row['date'];
        array_push($data, $rm);
    }

    echo json_encode($data);

}else{
    echo json_encode("empty");
}

?>
