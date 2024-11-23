<?php

if(isset($_GET["token"])){
    $token = $_GET["token"];
    $token_hash = hash("sha256", $token);
    
    include("config/dbcon.php");
    
    $sql_select = "SELECT * FROM user WHERE account_activation_hash = ?";
    $stmt_select = mysqli_prepare($con, $sql_select);
    mysqli_stmt_bind_param($stmt_select, "s", $token_hash);
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    $user = mysqli_fetch_assoc($result_select);
    
    if ($user === null) {
        die("Token not found");
    }
    
    // UPDATE query
    $sql_update = "UPDATE user SET account_activation_hash = NULL WHERE userId = ?";
    $stmt_update = mysqli_prepare($con, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "i", $user['userId']);
    mysqli_stmt_execute($stmt_update);
    
    // Close statements
    mysqli_stmt_close($stmt_select);
    mysqli_stmt_close($stmt_update);
    
    // Close connection if ne`eded
    // mysqli_close($mysqli);
}else{
    die("Token not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Activated</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Account Activated</h1>

    <p>Account activated successfully. You can now
       <a href="sign-in-up.php">log in</a>.</p>

</body>
</html>