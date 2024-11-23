<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'));

    $urgentBT=test_input($json->urgentBT);
    $number=test_input($json->urgentBTN);

    $data = [];
    if (!empty($urgentBT) && !empty($number)) {

        $check_query = "SELECT * FROM urgentbt WHERE bloodType=?";
        $check_query_run = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($check_query_run, "s",$urgentBT);
        mysqli_stmt_execute($check_query_run);
        $check_result = mysqli_stmt_get_result($check_query_run);

        if(mysqli_num_rows($check_result) > 0){

            $update_query = "UPDATE urgentbt SET number=? WHERE bloodType=? ";//iza l2ir b3ml update iza knt taleb urgent btn 3 bsiro 4
            $update_query_run = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($update_query_run, "is", $number, $urgentBT);
    
            if(mysqli_stmt_execute($update_query_run))
            {
                $response = 200;
                $msg ="UrgentBT Updated Successfully!";

                $data["bloodType"] = $urgentBT;
                $data["number"] = $number;
        
            }else{
                $response = 500;
                $msg ="Something Went Wrong!";
            }

            mysqli_stmt_close($update_query_run); //iza ma l2it b3ml insert la value w number

        }else{
            $urgentbt_query = "INSERT INTO urgentbt (bloodType, number) VALUES (?, ?)";
            $urgentbt_query_run = mysqli_prepare($con, $urgentbt_query);
            mysqli_stmt_bind_param($urgentbt_query_run, "si", $urgentBT, $number);
    
            if(mysqli_stmt_execute($urgentbt_query_run)){
    
                $response = 200;
                $msg = "UrgentBT Added Successfully!";
                $data["bloodType"] = $urgentBT;
                $data["number"] = $number;
    
            } else{
                $response = 500;
                $msg = "Something Went Wrong!";
            }
    
            mysqli_stmt_close($urgentbt_query_run);
        }
        mysqli_stmt_close($check_query_run);
        mysqli_close($con);
    } else{
        $response = 500;
        $msg = "Please Enter Needed Information";
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}
