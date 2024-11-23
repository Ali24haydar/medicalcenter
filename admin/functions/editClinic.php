<?php
require('validate.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input')); //hun la est2bl el file
    
    $clinicId= mysqli_real_escape_string($con, $_POST['editClinicFormId']);
    $name=test_input($_POST['editClinicName']);
    $description=test_input($_POST['editClinicDesc']);

    $path="../../uploads";

    $new_image = $_FILES['editClinicImg']['name']; //hun 3m el2t image w tht icon
    $old_image = $_POST['old_image'];

    $new_icon = $_FILES['editClinicIcon']['name'];
    $old_icon = $_POST['old_icon'];

    if ($new_image != "") {
        $image_ext = strtolower(pathinfo($new_image, PATHINFO_EXTENSION)); 
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    if ($new_icon != "") {
        $icon_ext = strtolower(pathinfo($new_icon, PATHINFO_EXTENSION));
        $update_filename2 = time() + 1 . '.' . $icon_ext;
       
    } else {
        $update_filename2 = $old_icon;
    }

    // Check if the file extension is allowed
    $allowed_extensions = array("jpg", "jpeg", "png"); //hun anwe3 suwar le fini est2beln
    $data = [];

    if($clinicId == ""){
        $response = 500;
        $msg= "Invalid Clinic ID!";
    }
    else if($name == ""){
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
    }else if($update_filename == ""){
        $response = 500;
        $msg= "Please Enter Clinic Image!";
    }else if($update_filename2 == ""){
        $response = 500;
        $msg= "Please Enter Clinic Icon!";
    }
    else{
        $update_clinic_query = "UPDATE clinic SET name=?, description=?, photo=?, icon=? WHERE clinicId=?";
        $update_clinic_query_run = mysqli_prepare($con, $update_clinic_query); //path bsyvo b2lbo back w ka sura akid m fini sayeva
        mysqli_stmt_bind_param($update_clinic_query_run, "ssssi", $name, $description, $update_filename, $update_filename2, $clinicId);

        if(mysqli_stmt_execute($update_clinic_query_run))
        {
            if($_FILES['editClinicImg']['name'] != ""){
                move_uploaded_file($_FILES['editClinicImg']['tmp_name'],$path.'/'.$update_filename); //hun 3m syv sura b file upload
                if(file_exists("../../uploads/".$old_image)){
                    unlink("../../uploads/".$old_image);
                }

            }
            
            if($_FILES['editClinicIcon']['name'] != ""){
                move_uploaded_file($_FILES['editClinicIcon']['tmp_name'],$path.'/'.$update_filename2);
                if(file_exists("../../uploads/".$old_icon)){
                    unlink("../../uploads/".$old_icon);
                }
            }
           
            $response = 200;
            $data["name"] = $name;
            $data["description"] = $description;
            $data["photo"] = $update_filename;
            $data["icon"] = $update_filename2;

            $msg="Clinic Updated Successfully!";
    
        }else{
            $response = 500;
            $msg ="Something Went Wrong!";
        }

        mysqli_stmt_close($update_clinic_query_run);
        mysqli_close($con);
    }

    $data["response"] = $response;
    $data["message"] = $msg;
    echo json_encode($data);
}