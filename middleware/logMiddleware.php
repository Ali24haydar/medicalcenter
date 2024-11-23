<?php

function isValidToken($token) {
    // Implement your logic to check if the token is valid (e.g., compare with the database)
    // Return true if valid, false otherwise
    // ...
    global $con;
    $token_check = "SELECT * From user WHERE auth_token = ?";
    $token_check_run = mysqli_prepare($con, $token_check);
    mysqli_stmt_bind_param($token_check_run, "s", $token);
    mysqli_stmt_execute($token_check_run);
    $result = mysqli_stmt_get_result($token_check_run);

    if (mysqli_num_rows($result) > 0) {
        return true;
    }else{
        return false;
    }
}

function getUserByToken($token) {
    // Implement your logic to retrieve user information based on the token
    // Return user information array if found, or false if not found
    // ...

    global $con;
    $get_user = "SELECT * From user WHERE auth_token = ?";
    $get_user_run = mysqli_prepare($con, $get_user);
    mysqli_stmt_bind_param($get_user_run, "s", $token);
    mysqli_stmt_execute($get_user_run);
    $result = mysqli_stmt_get_result($get_user_run);

    
    return $result;
}

function checkRole($role) {
 
    if($role == 0){
        header('Location: admin/dashboard.php');
    }
    else if($role == 1){
        header('Location: doctor/dashboard.php');
    }
    else if($role == 2){
        header('Location: home.php');
    }
    
}

// Check if the user is logged in
if (isset($_COOKIE['auth_token'])) {

    if(!isset($_SESSION['auth']))
    {
        $token = $_COOKIE['auth_token'];

        // Check if the token is valid (compare with the database)
        if (isValidToken($token)) {
            // Token is valid, user is logged in
            $user = getUserByToken($token);
            $userdata = mysqli_fetch_array($user);
            $username = $userdata['Fname'] . " " . $userdata['Lname'];
            $useremail = $userdata['email'];
            $userid = $userdata['userId'];
            $role_as = $userdata['role'];

            $restricted = $userdata['restricted'];

            if($restricted == 0){
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = [
                    'user_id' => $userid,
                    'name' => $username,
                    'email' => $useremail,
                    'token' => $token // Save the token in the session
                ];
                $_SESSION['role_as'] = $role_as;
                checkRole($_SESSION['role_as']);
            }else{
                header('Location: logout.php');
            }
    
        }
    }else{
        checkRole($_SESSION['role_as']);
    }

}
?>