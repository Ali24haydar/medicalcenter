<?php
session_start();
require('config/dbcon.php');
require('middleware/patientMiddleware.php'); 
$did=$_GET['did'];
$pid=$_SESSION['patientId'];
$enabledDays=array();
$query="select Fname, Lname,ProfilePic,phoneNumber,linkedin,instagram,facebook,doctor.clinicId,name from user join doctor on user.userId=doctor.userId  left join media on doctor.doctorId=media.doctorId left join clinic on doctor.clinicId = clinic.clinicId where doctor.doctorId=$did";
$result=mysqli_query($con,$query);

$query4="select day from doctorhours where doctorId=$did";
$result4=mysqli_query($con,$query4);

while ($row = mysqli_fetch_assoc($result4)) {
    $enabledDays[] = $row['day'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthHub Doctor Page</title>
    
    <link rel="icon" href="images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/doctorpage.css">
    <link rel="stylesheet" href="assets/css/calendar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lexend:wght@300&family=Open+Sans:wght@400;500;700&family=Poppins:wght@200;300;400;500&family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900|Source+Sans+Pro:400,600,700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!-- Main Content -->
    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <?php 
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $profilePic = "docImgPlaceholder.jpg";
                        if($row['ProfilePic'] != null){
                            $profilePic = $row['ProfilePic'];
                        }
                        echo '
                        <div class="photo">
                            <img src="uploads/'.$profilePic.'" alt="">
                        </div>
                        <div class="drInfo">
                            <h1>Dr '.$row['Fname'].' '.$row['Lname'].'</h1>
                            <ul class="breadcrumb">
                                <li><a href="#" class="active">'.$row['name'].'</a></li>
                                /
                                <li><a href="'.$row["facebook"].'" class="active"><i class="bx bxl-facebook-circle"></i></a></li>
                                <li><a href="'.$row["instagram"].'" class="active"><i class="bx bxl-instagram"></i></a></li>
                                <li><a href="'.$row["linkedin"].'" class="active"><i class="bx bxl-linkedin"></i></a></li>
                            </ul>
                            <span class="forCall"><i class="fa-solid fa-phone"></i><span class="phoneNum">:'.$row["phoneNumber"].'</span></span>
                        </div>
                </div>
                <a href="bookappsinglenew.php?cid='.$row["clinicId"].'" class="report">
                    <i class="bx bx-arrow-back"></i>
                    <span>Back</span>
                </a>
                        ';
                    }
                    ?>
            </div>

            <div class="bottom-data">
                <div class="appBook">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Book Apointment</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                    </div>

                    <div class="wrapper">
                        <div id="calendar">
                          <div class="header">
                            <div class="overlay">
                              <h1>Make appointment</h1>
                            </div>
                          </div>
                          <div class="monthChange"></div>
                        </div>
                        
                         <div class="inner-wrap">
                            <button type="submit" class="request disabled" id="btn">
                              Request appointment <br class="break">
                              <span>on</span>
                              <span class="day"></span>
                              <span>at</span>
                              <span class="time"></span>
                              <div class="sendRequest"></div>
                            </button>
                          <!-- </form> -->
                          <div class="notyou">
                            <p>Not you? <a href="logout.php">Change accout</a></p>
                          </div>
                      
                        </div>
                        
                        <input type="hidden" id="docId_Get" value="<?= $did;?>">
                        <div class='timepicker'>
                            <div class="owl" id="owl1">
                              
                            </div>
          
                            <div class="fade-l"></div>
                            <div class="fade-r"></div>
                        </div>

                          
                    </div>

                </div>

                <!-- feedbacks -->
                <div class="feedbacks">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Feedbacks</h3>
                        <a href="#yourFB"><i class='bx bx-pencil'></i></a>
                    </div>

                    <ul class="task-list" id="feedback_list">
                      
                    </ul>
                    
                    <form class="form" id="yourFB">
                        <p class="message">Enter Your Feedback Here. </p>        
                        <label>
                            <textarea class="input" name="feedback" id="description" cols="50" rows="2" placeholder="Write Your Feedback"></textarea>
                            <input type="hidden" value="<?=$did?>" name="did" id="did">
                            <input type="hidden" value="<?=$pid?>" name="pid" id="pid">
                            <div id="errmsg"></div>
                        </label>
                        <button type="submit" class="addfb" id="addfb">Add your feedback</button>
                    </form>
                </div>
                <!-- End of feedbacks-->

            </div>

        </main>

    </div>

    <script>
             var enabledDays = <?php echo json_encode($enabledDays); ?>;
    </script>
    <script>


    $(".request").on("click",function (e) {
        e.preventDefault();
        var urlParams = new URLSearchParams(window.location.search);
        var did = urlParams.get('did');
        var day = $(".day").text();
        var time = $(".time").text();
        var dateObj = new Date(day + ' ' + new Date().getFullYear());
        var mysqlDate = dateObj.toISOString().slice(0, 10);
        //console.log(mysqlDate);

        $.post("./functions/makeApp.php", { did: did, day:mysqlDate, time: time }, function(response) {
            Swal.fire({
                title: "Appointment Sent!",
                icon: "success",
                text: `Your appointment  request on ${day} at ${time} has been sent successfully.`,
                confirmButtonText: "OK"
            });
});

    });

    </script>
    <script src="assets/js/calendar.js"></script>
    <script src="assets/js/doctorpage.js"></script>

    
</body>
</html>