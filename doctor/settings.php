<?php
session_start();
require('../config/dbcon.php');
require('middleware/doctorMiddleware.php');
$did=$_SESSION['doctorId'];
$query="SELECT Fname, Lname, email, phoneNumber, profilePic, facebook, instagram, linkedin FROM user JOIN doctor ON user.userId = doctor.userId LEFT JOIN media ON doctor.doctorId = media.doctorId WHERE doctor.doctorid =$did;";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_assoc($result))
{
    $fname=$row['Fname'];
    $lname=$row['Lname'];
    $email=$row['email'];
    $facebook=$row['facebook'];
    $instagram=$row['instagram'];
    $linkedin=$row['linkedin'];
    $phoneNumber=$row['phoneNumber'];
    if($row['profilePic']==null)
    { $photo="docImgPlaceholder.jpg";}
    else
    {
        $photo=$row['profilePic'];
    }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Doctor Dashboard</title>
    <link rel="icon" href="/images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/settingscss.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- Sidebar -->
    <?php
        include('./includes/sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <div class="mainContent">
        <div class="center">
        <h2>Settings</h2>
        <form id="forminfo">
       <div class="title">
        <div class="title1">
            <img src="../uploads/<?=$photo?>" alt="" id="drimg">
            <input type="hidden" id="oldimg" name="oldimg" value="<?=$photo?>">
            <div class="round">
                
            <input type="file" name="drphoto">
            <i class="fa-solid fa-camera"></i>
           
            </div>
        </div>
        <div class="title2">
            <div class="title2i">
                <input type="text" name="dname" id="dname" value="<?=$fname?> <?=$lname?>">
                <i class="fa-solid fa-pen"></i>
            </div>
            <div class="title2i">
                <input type="text" name="demail" id="demail" value="<?=$email?>" style="color:gray" readonly>
                <i class="fa-solid fa-pen" style="color:gray"></i>
            </div>
            <div class="emailerror" id="emailerror"></div>
            <div class="title2i">
                <input type="text" name="dphnum" id="dphnum" value="<?=$phoneNumber?>">
                <i class="fa-solid fa-pen"></i>
            </div>
            <div class="phoneerror" id="phoneerror"></div>
            <div class="divsubmit">
                <input type="submit" name="submitinfo" id="submitinfo" class="submitinfo" value="Change">
            </div>
        </div>
        </form>
       </div>

       <div class="changepass">
        <h3>Social Media</h3>
        <form id="mediaform" enctype="multipart/form-data">
            <div>
                <div class="div">
            <label>FaceBook:</label> <input type="text" id="fb" name="fb" value="<?=$facebook?>">
        </div>
            </div>
            <div>
                <div class="div">
            <label>Instagram:</label> <input type="text" id="insta" name="insta" value="<?=$instagram?>">
                </div>
            </div>
            <div>
                <div class="div">
            <label>Linkedin:</label> <input type="text" id="linkedin" name="linkedin" value="<?=$linkedin?>">
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="Add" name="submit" class="submitBtn" id="submitm">
            </div>
            
        </form>
       </div>

       <div class="changepass">
        <h3>Do you want to change the passsword?</h3>
        <form id="formsubmit"  enctype="multipart/form-data">
            <div id="forpass1">
                <div class="div" id="div1">
            <label for="cpass">Current Password:</label> <input type="password" name="cpass" id="cpass">
        </div>
        <div id="errcurrentpass" style="color:red"></div>
            </div>
            <div id="forpass2">
                <div class="div" id="div2">
            <label for="cpass">New password:</label> <input type="password" name="npass" id="npass">
                </div>
            </div>
            <div id="forpass3">
                <div class="div" id="div3">
            <label for="cpass">Re-type new password:</label> <input type="password" name="rnpass" id="rnpass">
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="change" name="submit2" id="submit" class="submitBtn">
            </div>
            
        </form>
       </div>
    </div>
    </div>
    <script>

       
    $(function () {
        $("#submitm").on("click", function (e) {
            e.preventDefault();
            var formData = $("#mediaform").serialize();
            $.ajax({
                method: "POST",
                url: "queryFunctions/forSettings.php",
                data: formData + "&submit=submit",
                success: function () {
                
                }
            });
        });
    });
    $(function () {
    $("#forminfo").on("click", function (e) {
        document.getElementById('phoneerror').style.display="none";
        document.getElementById('emailerror').style.display="none";
    })
})


    </script>


    
    <!-- <script src="assets/js/dashboard.js"></script> -->
    <script src="assets/js/settings.js"></script>
 </body>
</html>