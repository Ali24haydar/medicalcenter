<?php
session_start();
require('config/dbcon.php');
$query="select clinicId,name,description,icon from clinic";
$res=mysqli_query($con,$query);
$pid=$_SESSION['patientId'];
$queryn="select Fname,Lname from user,patient where user.userId=patient.userId and patientId=?";
$stmt= mysqli_prepare($con, $queryn);
mysqli_stmt_bind_param($stmt, "i", $pid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $pfname = $row['Fname'];
    $plname=$row['Lname'];
  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Book Appointment </title>
  <link rel="icon" href="images/favicon.PNG" type="image/x-icon">
  <!--css style sheet-->
  <link rel="stylesheet" href="assets/css/clinics.css">
  <link rel="stylesheet" href="assets/css/nav.css">
  <link rel="stylesheet" href="assets/css/dropdown.css">
  <!--awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  
  <?php include("includes/header.php") ?>

  <div class="container">
    <div class="sidebar">
      <img src="images/hayaClinic.jpg" alt="">
    </div>
    <div class="main-content">
      <div class="title"> 
        <h1>Get well soon,<?=$pfname?> <?=$plname?></h1>
        <h2>Book Appointment</h2>
      </div>
      <div class="clinicsContainer">
      <div class="clinics">
<?php 
while($row=mysqli_fetch_assoc($res))
{
  echo '
       <div class="item">
          <a href="bookappsinglenew.php?cid='.$row["clinicId"].'">
            <img src="uploads/'.$row["icon"].'" alt="">
            <div class="name">'.$row["name"].'</div>
            <div class="des">
              '.$row["description"].'
            </div>
          </a>
        </div>
  ';
}
?>
      </div>
    </div>
    </div>
  </div>

  <script src="assets/js/nav.js"></script>
</body>
</html>
