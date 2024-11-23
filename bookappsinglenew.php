<?php
require('config/dbcon.php');
$cid=$_GET['cid'];
$query1="select name from clinic where clinicid=$cid";
$result1=mysqli_query($con,$query1);
$query2 = "SELECT user.Fname, user.Lname, doctor.doctorId, doctor.ProfilePic, media.facebook, media.instagram, media.linkedin  FROM user  JOIN doctor ON user.userId = doctor.userId LEFT JOIN media ON doctor.doctorId = media.doctorId WHERE doctor.clinicId = $cid AND deleted='0'";

$result1=mysqli_query($con,$query1);
$result2=mysqli_query($con,$query2);
while($row=mysqli_fetch_assoc($result1))
{
    $cname=$row['name'];
}
$query="select clinicId,name,description,icon from clinic";
$res=mysqli_query($con,$query);
$facebook = "#";
$instagram="#";
$linkedin="#";
while($row=mysqli_fetch_assoc($result1))
{
    if($row['facebook'] != null){
        $facebook = $row['facebook'];
    }
    if($row['instagram'] != null){
        $instagram = $row['instagram'];
    }
    if($row['linkedin'] != null){
        $linkedin= $row['linkedin'];
    }
}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== REMIXICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.PNG" type="image/x-icon">
        
        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="assets/css/doctorcss.css">
        <link rel="stylesheet" href="assets/css/doctorcss2.css">

        

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Doctors</title>
    </head>
    <body>

        <div class="sidebar" id="sidebar">
            <div class="logo">
                <!-- <i class="fa-solid fa-clinic-medical"></i> -->
                <i id="sideMenu" class="fa-solid fa-list"></i>
                <span>Clinics</span>
            </div>
            <ul class="menu">
            <?php
            while($row=mysqli_fetch_assoc($res))
            {
                echo '
                <li>
                    <a href="bookappsinglenew.php?cid='.$row["clinicId"].'">
                    <img src="uploads/'.$row["icon"].'" alt="">
                        <span>'.$row["name"].'</span>
                    </a>
                </li>
                ';
            } 
            ?>
               
                <div class="back">
                <li>
                    <a href="clinics.php">
                       <img src="images/back.png" alt="">
                        <span>Back</span>
                    </a>
                </li>   
            </div>               
            </ul>   
        </div>


        <div class="main--content">
            <div class="header--wrapper">
                <div class="header--title">
                    <span style="color:#0051A1">Doctors of</span>
                    <h2><?=$cname?></h2>
                </div>
                <div class="user--info">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="search" id="search">
                    </div>
                </div>
            </div>


        <div class="container">
          <?php
              while($row=mysqli_fetch_assoc($result2))
              {
                 $profilePic = "docImgPlaceholder.jpg";
                    if($row['ProfilePic'] != null){
                        $profilePic = $row['ProfilePic'];
                    }
                echo '
                <div class="card">
                <div class="card__border">
                    <img src="uploads/'.$profilePic.'" alt="card image" class="card__img">
                </div>

                <h3 class="card__name">Dr '.$row['Fname'].' '.$row['Lname'].'</h3>
                <span class="card__profession">'.$cname.'</span>

                <div class="card__social" id="card-social">
                    <div class="card__social-control">
        
                        <div class="card__social-toggle" id="card-toggle">
                            <i class="ri-add-line"></i>
                        </div>
    
                        <a href="doctorpage.php?did='.$row["doctorId"].'"><span class="card__social-text">Book Appointment</span></a>
    
                       
                        <ul class="card__social-list">
                            <a href="'.$facebook.'" class="card__social-link">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
    
                            <a href="'.$instagram.'" class="card__social-link">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
    
                            <a href="'.$linkedin.'" class="card__social-link">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>';
              }
          ?>

            

        </div>


    </div>
    <script>
 var filterInput = document.getElementById('search');
 var cards=document.querySelectorAll('.card');

filterInput.addEventListener('input', function() {
  var filterValue = filterInput.value.toLowerCase();
  cards.forEach(card => {
    cardname=card.querySelector('.card__name').textContent.toLowerCase();
    card.style.display = cardname.includes(filterValue) ? 'block' : 'none';

  });
  }
);
    </script>

        <!--=============== MAIN JS ===============-->
        <script src="assets/js/doctor.js"></script>
    </body>
</html>