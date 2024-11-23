<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $doctorId=mysqli_real_escape_string($con, $_POST['manageDWHFormId']);
    $day=test_input($_POST['DWHDay']);
    $from= "";
    if(isset($_POST['DWHFrom'])){
        $from= test_input($_POST['DWHFrom']);
    }
    $to= "";
    if(isset($_POST['DWHTO'])){
        $to= test_input($_POST['DWHTO']);
    }
    $available= isset($_POST['available']) ? "1":"0";

    $data = [];
    $response = 200;
    
    if($day!= "" && $day != "WHDay"){
        $check_query = "SELECT * FROM doctorhours WHERE doctorId=? AND day=?";
        $stmt = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($stmt, "is", $doctorId, $day);
        mysqli_stmt_execute($stmt);
        $check_query_run = mysqli_stmt_get_result($stmt);

        $select_query = "SELECT * FROM medicalhours WHERE day=?";
        $select_query_run = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($select_query_run, "s", $day);
        mysqli_stmt_execute($select_query_run);
        $select_result = mysqli_stmt_get_result($select_query_run);
        $select_data = mysqli_fetch_array($select_result);
        $medFrom = $select_data['fromHour']; //3m jib mn medical hour from w to ay se3a fthin  w b2asemon brj3 bshuf from w to le haton dr hal
        $medTo = $select_data['toHour'];//dmn hal range aw la

        // Split the MFrom and MTo into hours, minutes, and seconds
        list($MFrom_hours, $MFrom_minutes, $MFrom_seconds) = explode(":", $medFrom);
        list($MTo_hours, $MTo_minutes, $MTo_seconds) = explode(":", $medTo);

        // Now, create DateTime objects for MFrom and MTo
        $MFrom_datetime = new DateTime("1970-01-01 $medFrom");
        $MTo_datetime = new DateTime("1970-01-01 $medTo");

        $MFrom_time = $MFrom_datetime->format('H:i:s');
        $MTo_time = $MTo_datetime->format('H:i:s');

        if($to != "" && $from != ""){
            // Now, create DateTime objects for DFrom and DTO with the same format
            $DFrom_datetime = new DateTime("1970-01-01 $from");
            $DTO_datetime = new DateTime("1970-01-01 $to");

            $DFrom_time = $DFrom_datetime->format('H:i:s');
            $DTO_time = $DTO_datetime->format('H:i:s');
            if($DFrom_time < $MFrom_time || $DTO_time > $MTo_time){
                $response = 500;
                $msg= "Working Hour Not In Range!";
            }
        }

        if($response != 500){

            if(mysqli_num_rows($check_query_run) >0){
//iza dr kn mda5el bhal nhar abl se3at b3ml bs update iza mano mwjud b3mal insert 3a database
                $update_query = "UPDATE doctorhours SET fromHour=? , toHour=?, available=? WHERE doctorId=? AND day=? ";
                $update_query_run = mysqli_prepare($con, $update_query);
                mysqli_stmt_bind_param($update_query_run, "ssiis", $from, $to, $available,$doctorId,$day);
        
                if(mysqli_stmt_execute($update_query_run))
                {
                    $response = 200;
                    $msg= "Doctor WH Updated Successfully!";
    
                    $data["day"] = $day;
                    $data["from"] = $from;
                    $data["to"] = $to;
                    $data["available"] = $available;
            
                }else{
                    $response = 500;
                    $msg= "Something Went Wrong!";
                }
    
                mysqli_stmt_close($update_query_run);
    
            }else{
                $doctorHours_query = "INSERT INTO doctorhours (doctorId,day, fromHour, toHour, available) VALUES (?, ?, ?, ?, ?)";
                $doctorHours_query_run = mysqli_prepare($con, $doctorHours_query);
                mysqli_stmt_bind_param($doctorHours_query_run, "isssi", $doctorId, $day, $from, $to, $available);
        
                if(mysqli_stmt_execute($doctorHours_query_run))
                {
                    $response = 200;
                    $msg= "Doctor WH Added Successfully!";
    
                    $data["day"] = $day;
                    $data["from"] = $from;
                    $data["to"] = $to;
                    $data["available"] = $available;
            
                }else{
                    $response = 500;
                    $msg= "Something Went Wrong!";
                }
    
                mysqli_stmt_close($doctorHours_query_run);
            }

        }
        
        mysqli_stmt_close($select_query_run);
        mysqli_close($con);
    }else{
        $response = 500;
        $msg= "Please Enter Working Day!";
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}