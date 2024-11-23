<?php

class Center_Working_Hours
{
    public $day;
    public $fromHour;
    public $toHour;
    public $closed;
}

require_once('../../config/dbcon.php');

$query= "SELECT * FROM medicalhours ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    for ($i = 0; $row = $result->fetch_assoc(); $i++) {
        $wh = new Center_Working_Hours();
        $wh->day = $row['day'];
        $wh->fromHour = $row['fromHour'];
        $wh->toHour = $row['toHour'];
        $wh->closed = $row['closed'];
        array_push($data, $wh);
    }

    echo json_encode($data);

}else{
    echo json_encode("empty");
}

?>