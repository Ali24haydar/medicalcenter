<?php

class Urgentbt
{
    public $urgentBTId;
    public $bloodType;
    public $number;
}

require_once('../../config/dbcon.php');

$query= "SELECT * FROM urgentbt";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    for ($i = 0; $row = $result->fetch_assoc(); $i++) {
        $BT = new Urgentbt();
        $BT->urgentBTId = $row['urgentBTId'];
        $BT->bloodType = $row['bloodType'];
        $BT->number = $row['number'];
        array_push($data, $BT);
    }

    echo json_encode($data);

}else{
    echo json_encode("empty");
}

?>
