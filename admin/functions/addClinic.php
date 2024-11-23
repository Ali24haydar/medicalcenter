<?php
require('validate.php');
header('Content-type: application/json');//la eb3t body mn front la back ka javascript bhawelon la json object la e3ml decode json w object
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //w bl2ton ka variable  //bt2kd mn request eno post
    $json = json_decode(file_get_contents('php://input')); //3m eb3t post request mn front la back 


    $name = test_input($_POST['clinicName']); //3m jib clinic name w desc
    $description = test_input($_POST['clinicDesc']);

    $image = $_FILES['clinicImg']['name'];
    $path="../../uploads";
   
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION)); //3m el2at el image w icon
    $filename= time().'.'.$image_ext;

    $icon = $_FILES['clinicIcon']['name'];
    
    $icon_ext = strtolower(pathinfo($icon, PATHINFO_EXTENSION));
    $filename2= time()+1 .'.'.$icon_ext;

    // Check if the file extension is allowed
    $allowed_extensions = array("jpg", "jpeg", "png"); //m7aded ay anwe3 suwar ana bst2bel
    $data = [];

    if($name == ""){ //iza name fady
        $response = 500;
        $msg= "Please Enter Clinic Name!";
    }else if(!validateName($name)){
        $response = 500;
        $msg= "Please Enter a Valid Name!";
    }else if($description == ""){
        $response = 500;
        $msg= "Please Enter Clinic Description!";
    }else if(!validateDesc($description)){
        $response = 500;
        $msg= "Please Enter a Valid  Description!";
    }else if($filename == ""){
        $response = 500;
        $msg= "Please Enter Clinic Image!";
    }else if (!in_array($image_ext, $allowed_extensions)) {
        $response = 500;
        $msg = "Invalid file extension for photo. Allowed extensions: " . implode(", ", $allowed_extensions);
    }else if($filename2 == ""){
        $response = 500;
        $msg= "Please Enter Clinic Icon!";
    }else if (!in_array($icon_ext, $allowed_extensions)) { //iza no3 sura msh msmu7
        $response = 500;
        $msg = "Invalid file extension for icon. Allowed extensions: " . implode(", ", $allowed_extensions);
    }
    else{ //yaane kl shiu msmu7 bdi et2kd iza 3iyede mwjude abl
        $clinic_check_query = "SELECT * FROM clinic WHERE name=?";
        $clinic_check_query_run = mysqli_prepare($con, $clinic_check_query);
        mysqli_stmt_bind_param($clinic_check_query_run, "s", $name);
        mysqli_stmt_execute($clinic_check_query_run);
        mysqli_stmt_store_result($clinic_check_query_run);
        if (mysqli_stmt_num_rows($clinic_check_query_run) > 0) { //rj3le imi fo2 0 yaane mwjude abl
            mysqli_stmt_close($clinic_check_query_run);
          
            $response = 500;
            $msg= "Clinic already exists!";
        }else{
            // Prepare the statement
            $clinic_query = "INSERT INTO clinic (name, description, photo, icon) VALUES (?, ?, ?, ?)"; //b3ml insert
            $clinic_query_run = mysqli_prepare($con, $clinic_query);
            // Bind the parameters
            mysqli_stmt_bind_param($clinic_query_run, "ssss", $name, $description, $filename, $filename2);

            if(mysqli_stmt_execute($clinic_query_run))
            {
                move_uploaded_file($_FILES['clinicImg']['tmp_name'],$path.'/'.$filename);
                move_uploaded_file($_FILES['clinicIcon']['tmp_name'],$path.'/'.$filename2);
 
                $response = 200;
                $data["name"] = $name;
                $data["description"] = $description;
                $data["photo"] = $filename;
                $data["icon"] = $filename2;

                $msg="Clinic Added Successfully!";

            }else{
                $response = 500;
                $msg ="Something Went Wrong!";
            }

            mysqli_stmt_close($clinic_check_query_run);
            mysqli_stmt_close($clinic_query_run);
        } 

        mysqli_close($con);
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}