<?php

require("../config/dbcon.php");

function redirect($url, $message){
    $_SESSION['message']= $message;
    header('Location: ' .$url);
    exit();
}
//function redirect b3te by paramiter url message ana msln 3mlt sign in la y5dne 3a sf7a tnye by3mali redirect la sf7a tnye w shu message l bdi e3rodlo yeha mtl welcome
function getRowCount($table){
    global $con;
    $query= "SELECT * FROM $table";
    $query_run = mysqli_prepare($con, $query);
    mysqli_stmt_execute($query_run);
    $result = mysqli_stmt_get_result($query_run);
    return mysqli_num_rows($result);
}

?>