<?php
require('../../config/dbcon.php');

$keyword = '';

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
}

$sql = "SELECT userId,email FROM user WHERE (Fname LIKE '%" . addslashes($keyword) . "%' AND role='2')";


$res = mysqli_query($con, $sql);

$i = 0;
$patients = array();

while ($row = mysqli_fetch_assoc($res)) {
    $patients[$i] = array(
        'userId' => $row['userId'],
        'email' => $row['email']
    );
    $i++;
}

echo json_encode($patients);
?>