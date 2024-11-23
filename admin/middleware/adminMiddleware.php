<?php

function isValidToken($token) { //la karen token le 3nde yeh m3 token le b database nfso aw la iza nfso wd3 salim w m 3nde hacker l3ben b token w fi access
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

function getUserByToken($token) { //bjib user hsb token le elo 
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

function checkRole($role) { //bt2kd mn token le 3nde yeh m3 role le elo hal msmu7 ykun hun mhl m huwi aw la
    if($role !=0){

        if($role == 1){
            redirect('../doctor/dashboard.php',"You Are Not Authorized To Access This Page!");
        }else{
            redirect('../home.php',"You Are Not Authorized To Access This Page!");
        }
    
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
                redirect('../logout.php',"You are Restricted form Logining in!");
            }
           
    
        } else {
            redirect('../sign-in-up.php',"Login to continue");
        }
    }else{
        checkRole($_SESSION['role_as']);
    }

} else {
    redirect('../sign-in-up.php',"Login to continue");
}
?>