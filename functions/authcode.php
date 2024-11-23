<?php
session_start();
require("../config/dbcon.php");

header('Content-type: application/json'); //3m bt2kd eno rad json
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //request le 3m eb3ata heye 3a shkl post
    $json = json_decode(file_get_contents('php://input'));

    $email = mysqli_real_escape_string($con, $json->email); //3m 2o2ra email w password
    $password = mysqli_real_escape_string($con, $json->password);

    $data = [];

    if ($email != "" && $password != "") { //iza ma keno fadyin yaane b2lbon valur fa
        $login_query = "SELECT * FROM user WHERE email=? AND restricted=0  AND account_activation_hash IS NULL";//3m jib user le 
        $login_query_run = mysqli_prepare($con, $login_query);//active w mano m3mulo block
        mysqli_stmt_bind_param($login_query_run, "s", $email);
        mysqli_stmt_execute($login_query_run);
        $result = mysqli_stmt_get_result($login_query_run);

        if (mysqli_num_rows($result) > 0) {
            $userdata = mysqli_fetch_array($result);
            $stored_password = $userdata['password'];

            if (password_verify($password, $stored_password)) {
                $token = bin2hex(random_bytes(32)); // Generate a unique token

                $_SESSION['auth'] = true;
                $username = $userdata['Fname'] . " " . $userdata['Lname'];
                $useremail = $userdata['email'];
                $userid = $userdata['userId'];
                $role_as = $userdata['role'];

                $_SESSION['auth_user'] = [
                    'user_id' => $userid,
                    'name' => $username,
                    'email' => $useremail,
                    'token' => $token // Save the token in the session
                ];

                // Save the token in the database
                $updateTokenQuery = "UPDATE user SET auth_token = ? WHERE userId = ?";
                $updateTokenQuery_run = mysqli_prepare($con, $updateTokenQuery);
                mysqli_stmt_bind_param($updateTokenQuery_run, "si", $token, $userid);
                mysqli_stmt_execute($updateTokenQuery_run);

                // Set the token as a cookie
                setcookie("auth_token", $token, time() + (86400 * 30), "/"); // 30 days validity

                $_SESSION['role_as'] = $role_as;

                if ($role_as == 0) {
                    $msg = "Welcome to Admin Dashboard";
                    $response = 200;
                } elseif ($role_as == 1) {
                    $getId_query= "SELECT doctorId FROM doctor WHERE userId=?";
                    $getId_query_run = mysqli_prepare($con, $getId_query);
                    mysqli_stmt_bind_param($getId_query_run, "i", $userid);
                    mysqli_stmt_execute($getId_query_run);
                    $result = mysqli_stmt_get_result($getId_query_run);

                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                        $doctorId = $row['doctorId'];
                        $_SESSION['doctorId'] = $doctorId;

                        $msg = "Welcome to Doctor Dashboard";
                        $response = 201;
                    }else{
                        $msg = "Something Went Wrong!";
                        $response = 500;
                    }

                } elseif ($role_as == 2) {
                    $getId_query= "SELECT patientId FROM patient WHERE userId=?";
                    $getId_query_run = mysqli_prepare($con, $getId_query);
                    mysqli_stmt_bind_param($getId_query_run, "i", $userid);
                    mysqli_stmt_execute($getId_query_run);
                    $result = mysqli_stmt_get_result($getId_query_run);

                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                        $patientId = $row['patientId'];
                        $_SESSION['patientId']= $patientId;
    
                        $response = 202;
                        $msg = "Loged In Successfully As Patient";
                    }else{
                        $msg = "Something Went Wrong!";
                        $response = 500;
                    }

                }
            } else {
                $response = 500;
                $msg = "Invalid Credentials!";
            }
        } else {
            $response = 500;
            $msg = "Invalid Credentials or Inactive Account !";
        }

        mysqli_stmt_close($login_query_run);
        mysqli_close($con);
    } else {
        $response = 500;
        $msg = "Please Enter needed Information!";
    }

    $data["message"] = $msg;
    $data["response"] = $response;
    echo json_encode($data);
}
?>