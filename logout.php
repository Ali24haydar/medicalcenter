<?php
session_start();
require("config/dbcon.php"); // Adjust the path as needed

// Function to clear the token from the server-side database
function clearTokenFromDatabase($userId) {
    global $con;
    $clear_token_query = "UPDATE user SET auth_token =NULL WHERE userId = ?";
    $clear_token_query_run = mysqli_prepare($con, $clear_token_query);
    mysqli_stmt_bind_param($clear_token_query_run, "i", $userId);
    mysqli_stmt_execute($clear_token_query_run);
    mysqli_stmt_close($clear_token_query_run);
}

// Check if the user is logged in
if (isset($_SESSION['auth_user']['user_id']) || isset($_COOKIE['auth_token'])) {
    // Clear the token from the client's cookies
    setcookie("auth_token", "", time() - 3600, "/");

    // Clear the token from the server-side database
    clearTokenFromDatabase($_SESSION['auth_user']['user_id']);
}

// Clear the session
session_unset();
session_destroy();

// Redirect to the login page
header('Location: sign-in-up.php');
exit();

?>
