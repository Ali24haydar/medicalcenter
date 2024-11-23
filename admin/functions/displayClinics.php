<?php

class clinic
{
    public $clinicId;
    public $name;
    public $description;
    public $photo;
    public $icon;
}

require_once('../../config/dbcon.php');

$query= "SELECT * FROM clinic";
$query_run = mysqli_prepare($con, $query);
mysqli_stmt_execute($query_run);
$result = mysqli_stmt_get_result($query_run);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    for ($i = 0; $row = $result->fetch_assoc(); $i++) {
        $c = new clinic();
        $c->clinicId = $row['clinicId'];
        $c->name = $row['name'];
        $c->description = $row['description'];
        $c->photo = $row['photo'];
        $c->icon = $row['icon'];
        array_push($data, $c);
    }

    echo json_encode($data);

}else{
    echo json_encode("empty");
}

?>
