<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //nt3kd eno post request
    $json = json_decode(file_get_contents('php://input'));

    $doctorId=mysqli_real_escape_string($con, $_POST['docId']);
    $date=test_input($_POST['exceptionDay']); //bl2t yum el eststne2e le 7adado dr
    $from= "";
    if(isset($_POST['exceptionFrom'])){
        $from= test_input($_POST['exceptionFrom']); //b5d exception from w to
    }
    $to= "";
    if(isset($_POST['exceptionTO'])){
        $to= test_input($_POST['exceptionTO']);
    }
    $available= isset($_POST['availableException']) ? "1":"0"; //w hal dr available 2sesan bhal nhar aw la

    $data = [];
    $response = 200;

    if($date != ""){
        $day= date("l", strtotime($date)); //3m e5d  day nhar mn date le huwi bkun 3a shkl nhar shaher sene time

        $select_query = "SELECT * FROM medicalhours WHERE day=?"; //3m shil kl shi data mn hal table bhal nhar
        $select_query_run = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($select_query_run, "s", $day);
        mysqli_stmt_execute($select_query_run);
        $select_result = mysqli_stmt_get_result($select_query_run);

        if(mysqli_num_rows($select_result) <= 0){ //iza ma l2it se3at sh8l bhal nhar bhot eno
            $response = 500;
            $msg = "Medical Hours Still Not Defined On this Day.";
        }else{
            $select_data = mysqli_fetch_array($select_result);
            $medFrom = $select_data['fromHour'];
            $medTo = $select_data['toHour']; //3m shil from w to mn hal ligne le nradale mn medical hours mn database

            if($medFrom == "00:00:00" || $medTo == "00:00:00"){ //dead time 
                $response = 500;
                $msg = "Center is closed This Day"; // b3d se3a 12 bhoto eno system mskr m fik
            }else{
                // Split the MFrom and MTo into hours, minutes, and seconds
                list($MFrom_hours, $MFrom_minutes, $MFrom_seconds) = explode(":", $medFrom); //3m jaze2 medfrom la min w sec w se3a
                list($MTo_hours, $MTo_minutes, $MTo_seconds) = explode(":", $medTo); //w med to kmn

                // Now, create DateTime objects for MFrom and MTo
                $MFrom_datetime = new DateTime("1970-01-01 $medFrom");//brj3 b3ml new date menun ho t3ul medical hour
                $MTo_datetime = new DateTime("1970-01-01 $medTo");

                $MFrom_time = $MFrom_datetime->format('H:i:s'); //3m e3mln 3a shkl hour minute second
                $MTo_time = $MTo_datetime->format('H:i:s');

                if($to != "" && $from != ""){
                    // Now, create DateTime objects for DFrom and DTO with the same format
                    $DFrom_datetime = new DateTime("1970-01-01 $from"); //from le ana d5lto le fo2 hene mn databse la karen byneton
                    $DTO_datetime = new DateTime("1970-01-01 $to");

                    $DFrom_time = $DFrom_datetime->format('H:i:s');//w b2sem from le 3nde la nfs shi la 22dr karenon b ba3ed
                    $DTO_time = $DTO_datetime->format('H:i:s');
                    if($DFrom_time < $MFrom_time || $DTO_time > $MTo_time){ //bkare w2t la hato dr m3 w2t le mn databse iza in range or not 
                        $response = 500;
                        $msg= "Exception Hour Not In Range!";
                    }
                }

                if($response != 500){
                    $clinic_check_query = "SELECT * FROM workingexception WHERE doctorId=? AND date=?";
                    $clinic_check_query_run = mysqli_prepare($con, $clinic_check_query);
                    mysqli_stmt_bind_param($clinic_check_query_run, "is", $doctorId, $date);
                    mysqli_stmt_execute($clinic_check_query_run);
                    $clinic_check_result = mysqli_stmt_get_result($clinic_check_query_run);
            
                    if(mysqli_num_rows($clinic_check_result) > 0){
             //iza l2it m3abihon abl b3mal bs update iza awl mara by3ml exception hour la hal day b3mal insert
                        $exception_query = "UPDATE workingexception SET fromHour=? , toHour=?, available=? WHERE doctorId=? AND date=? ";
                        $exception_query_run = mysqli_prepare($con, $exception_query);
                        mysqli_stmt_bind_param($exception_query_run, "ssiis", $from, $to, $available,$doctorId,$date);
            
                        if(mysqli_stmt_execute($exception_query_run))
                        {
                            $response = 200;
                            $msg= "Exception Updated Successfully!";

                            $data["date"] = $date;
                            $data["from"] = $from;
                            $data["to"] = $to;
                            $data["available"] = $available;
                    
                        }else{
                            $response = 500;
                            $msg= "Something Went Wrong!";
                        }

                        mysqli_stmt_close($exception_query_run);
                        
                    }else{
                        $exception_query = "INSERT INTO workingexception (doctorId, date, fromHour, toHour, available) VALUES (?, ?, ?, ?,?)";
                        $exception_query_run = mysqli_prepare($con, $exception_query);
                        mysqli_stmt_bind_param($exception_query_run, "isssi", $doctorId, $date, $from, $to, $available);
                
                        if(mysqli_stmt_execute($exception_query_run))
                        {
                            $response = 200;
                            $msg= "Exception Added Successfully!";

                            $data["date"] = $date;
                            $data["from"] = $from;
                            $data["to"] = $to;
                            $data["available"] = $available;
                    
                        }else{
                            $response = 500;
                            $msg= "Something Went Wrong!";
                        }

                        mysqli_stmt_close($exception_query_run);
                    }

                    mysqli_stmt_close($clinic_check_query_run);
                }
            }
        }

        mysqli_stmt_close($select_query_run);
        mysqli_close($con);
  
    }else{
        $response = 500;
        $msg= "Please Enter Exception Date!";
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}