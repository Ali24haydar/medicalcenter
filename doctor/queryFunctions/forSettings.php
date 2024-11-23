 <?php
require("../../config/dbcon.php");
$doctorId='2';


if(isset($_POST['submit']))
{
        $fb=isset($_POST['fb'])?$_POST['fb']:null;
        $insta=isset($_POST['insta'])?$_POST['insta']:null;
        $linkedin=isset($_POST['linkedin'])?$_POST['linkedin']:null;
        //hon l doctorId bda mahal
        $query = "SELECT EXISTS (SELECT 1 FROM media WHERE doctorId = ?) AS doctorExists";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $doctorId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $doctorExists);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($doctorExists) {
                $query="update media set facebook=? ,instagram=?,linkedin=? where doctorId=?";
                $stmt=mysqli_prepare($con,$query);
                mysqli_stmt_bind_param($stmt,"sssi",$fb, $insta, $linkedin,$doctorId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
        } else {
                $query="insert into media(doctorId,facebook,instagram,linkedin) values (?,?,?,?)";
                $stmt=mysqli_prepare($con,$query);
                mysqli_stmt_bind_param($stmt,"isss", $doctorId, $fb, $insta, $linkedin);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
        }
}
//for info
if(isset($_POST['submitinfo']))
{
        $dname=$_POST['dname'];
        $nameParts = explode(" ", $dname);
        $dfname = $nameParts[0];
        $dlname = isset($nameParts[1]) ? $nameParts[1] : '';
        $demail=$_POST['demail'];
        $oldimg=$_POST['oldimg'];

        $uploadDir = '../../uploads';
        $uploadedFileName = $_FILES['drphoto']['name'];
        if($uploadedFileName!="")
        {
                $uploadedFilePath = $uploadDir . $uploadedFileName;
                if (move_uploaded_file($_FILES['drphoto']['tmp_name'], $uploadedFilePath)) {
                $success = true;
                } else {
                $success = false;
        }
        }
        else
        {
                $uploadedFileName=$oldimg;   
        }

        $dphnum=(int)$_POST['dphnum'];
        $query2 ="SELECT EXISTS ( SELECT 1 FROM doctor  WHERE phoneNumber = ? AND doctorId <> ?  UNION  SELECT 1 FROM patient WHERE phoneNumber = ? ) AS numExists";
        $stmt2 = mysqli_prepare($con, $query2);
        mysqli_stmt_bind_param($stmt2, "iii", $dphnum,$doctorId,$dphnum);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2, $numExists);
        mysqli_stmt_fetch($stmt2);
        mysqli_stmt_close($stmt2);
        $query3 = "SELECT EXISTS (SELECT 1 FROM user JOIN doctor ON user.userId=doctor.userId WHERE email = ? AND doctorId<>?) AS emailExists";
        $stmt3 = mysqli_prepare($con, $query3);
        mysqli_stmt_bind_param($stmt3, "si", $demail,$doctorId);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $emailExists);
        mysqli_stmt_fetch($stmt3);
        mysqli_stmt_close($stmt3);
        if($numExists && $emailExists )
        {
                echo "Phone Number and email already taken";
        }
        else if($numExists)
        {
                echo "Phone Number already taken";
        }
        else if($emailExists)
        {
                echo "Email already taken";
        }
        else{
                $query="update user join doctor ON user.userId = doctor.userId set user.Fname=?,user.Lname=?,user.email=?,doctor.phoneNumber=?,doctor.profilePic=? where doctor.doctorId = ?";
                $stmt=mysqli_prepare($con,$query);
                mysqli_stmt_bind_param($stmt,"sssisi",$dfname, $dlname, $demail,$dphnum,$uploadedFileName,$doctorId);
                mysqli_stmt_execute($stmt);
        }
        
}
//for change password
if(isset($_POST['submit2']))
{
        $cpass = $_POST['cpass'] ;
        $npass = $_POST['npass'];
        $rnpass = $_POST['rnpass'];
        $query = "select password from user,doctor where user.userId=doctor.userId and doctor.doctorId=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt,"i",$doctorId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $pass);
        mysqli_stmt_fetch($stmt);

        if ($pass!== null & password_verify($cpass, $pass)) {
                $hashedNewPassword = password_hash($npass, PASSWORD_DEFAULT);
                $query="UPDATE user JOIN doctor ON user.userId = doctor.userId SET user.password=? WHERE doctor.doctorId = ?";
                $stmt=mysqli_prepare($con,$query);
                mysqli_stmt_bind_param($stmt,"si",$hashedNewPassword,$doctorId);
                mysqli_stmt_execute($stmt);
                
        } else {
                echo "incorrect password";
        }
}




?>