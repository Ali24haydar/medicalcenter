<?php
session_start();
if(!isset($_GET["token"])){
    die("token not found");
}

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

include("../config/dbcon.php");

$sql = "SELECT * FROM user WHERE reset_token_hash = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $token_hash);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="icon" href="images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/resetPage.css" /> 
    
</head>
<body>

<div class="form-container">
    <form method="post" action="process-reset-password.php">
    <h1>Reset Password</h1>

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

              <div class="input-field"> 
                <i class="fas fa-lock"></i> 
                <input type="password" placeholder="New Password" name="password" id="pass1"/> 
              </div>
              <div class="display"><p class="message" id="msg1"></p></div>
             
              <div class="input-field"> 
                <i class="fas fa-lock"></i> 
                <input type="password" placeholder="Confirm Password" name="cpassword" id="pass2"/> 
              </div>
              <div class="display"><p class="message" id="msg2"></p></div>

              <?php
                if(isset($_SESSION['message'])){
                    ?>
                         <div class="display"><p class="message"><?= $_SESSION['message']; ?></p></div>
                    <?php
                    unset($_SESSION['message']);
                }
                ?>

        <button class="button">Send</button>
    </form>
</div>

<script src="../assets/js/resetPassword.js"></script>
</body>
</html>