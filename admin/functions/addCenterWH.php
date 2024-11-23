<?php
require('validate.php');// medical center hours la zid se3at sh8l medical center //validate name email exct..
header('Content-type: application/json');//la eb3t body mn front la back ka javascript bhawelon la json object la e3ml decode json w object
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  //w bl2ton ka variable  //bt2kd mn request eno post
    $json = json_decode(file_get_contents('php://input')); //la 22rahon 3a shkl input 
    
    $day=test_input($_POST['WHDay']); //3am b2ra whday ka input b dolar day
    $from= "";
    if(isset($_POST['WHFrom'])){
        $from=test_input($_POST['WHFrom']); //3m sayev ay se3a blsh 
    }
    $to= "";
    if(isset($_POST['WHTO'])){
        $to=test_input($_POST['WHTO']); // la ay se3a
    }
    $closed= isset($_POST['closed']) ? "1":"0"; //1 iza mskr mrkz 0 iza mftuh

    $data = []; // la hot data fiha
    
    if($day!= "" && $day!= "WHDay"){
//3m etka2ad iza nhar mwjud abl bhal database iza mwjud b3ml update 3a se3at iza la bdi e3ml insert la day la ysir yum sh8l
        $check_query = "SELECT * FROM medicalHours WHERE day=?";  
        $check_query_run = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($check_query_run, "s",$day);
        mysqli_stmt_execute($check_query_run);
        $check_result = mysqli_stmt_get_result($check_query_run);

        if(mysqli_num_rows($check_result) > 0){ //iza l2ina response akbr mn 0 yaane l2ine

            $update_query = "UPDATE medicalHours SET fromHour=? , toHour=?, closed=? WHERE day=? "; //b3ml update la medical hour iza kn day mwjud
            $update_query_run = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($update_query_run, "ssis", $from, $to, $closed,$day);
    
            if(mysqli_stmt_execute($update_query_run))
            {
                $response = 200;
                $msg ="Medical Hour Updated Successfully!";

                $data["day"] = $day;
                $data["from"] = $from;
                $data["to"] = $to;
                $data["closed"] = $closed;
        
            }else{
                $response = 500;
                $msg ="Something Went Wrong!";
            }

            mysqli_stmt_close($update_query_run);

        }else{

            $medicalHours_query = "INSERT INTO medicalHours (day, fromHour, toHour, closed) VALUES (?, ?, ?, ?)"; // iza ma l2ito yaane day msh mwjud 
            $medicalHours_query_run = mysqli_prepare($con, $medicalHours_query);//lzm zido e3ml inser fo2 b3nl update
            mysqli_stmt_bind_param($medicalHours_query_run, "sssi", $day, $from, $to, $closed);
    
            if(mysqli_stmt_execute($medicalHours_query_run))
            {
                $response = 200;
                $msg ="Medical Hour Added Successfully!";

                $data["day"] = $day;
                $data["from"] = $from;
                $data["to"] = $to;
                $data["closed"] = $closed;
        
            }else{
                $response = 500;
                $msg ="Something Went Wrong!";
            }

            mysqli_stmt_close($medicalHours_query_run);
        }

        mysqli_stmt_close($check_query_run);
        mysqli_close($con);
    }else{
        $response = 500;
        $msg ="Please Enter Working Day!";
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}