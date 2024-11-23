<?php
session_start();
include("queryFunctions/queryfunctions.php");
require('middleware/doctorMiddleware.php');

/* $doctor = $_SESSION['doctor_id']; */
$userId = $_SESSION['auth_user']['user_id'];
$userName = $_SESSION['auth_user']['name'];
$userEmail = $_SESSION['auth_user']['email'];

$doctorId = $_SESSION['doctorId'];

/* $doctorId = getDoctorId($userId);  */
$patientsNb = getPatientCount($doctorId);
$AppointmentsNb = getAppoinmentCount($doctorId);
$requestNb = getRequestCount($doctorId);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Doctor Dashboard</title>
    <link rel="icon" href="/images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>

    <!-- Sidebar -->
    <?php
        include('./includes/sidebar.php');
    ?>
    <!-- End of Sidebar -->

     <!-- Main Content -->
     <div class="content">
        <div class="left-side">
        <div class="top">
       <h1>Dashboard</h1>
       <span class="currentDay" id="currentDay"></span>,<span class="currentDate" id="currentDate"></span>
       </div>
       <div class="banner">
        <div class="banner-img"><img src="../images/ban.png"></div>
        <div class="title"><h2>Welcome, dr. <span><?= $userName ?></span></h2>
        <p>Have a nice day at work.</p></div>
       </div>


       <ul class="insights">
        <li>
            <i class='bx bx-group'></i>
            <span class="insight">
                <h3>
                 <?= $patientsNb ?>
                </h3>
                <p>Patients</p>
            </span>
        </li>
        <li>
            <i class='bx bx-calendar-check'></i>
            <span class="insight">
                <h3>
                <?= $AppointmentsNb ?>
                </h3>
                <p>Appointments</p>
            </span>
        </li>
        <li>
            <i class='bx bx-comment-dots'></i>
            <span class="insight">
                <h3>
                <?= $requestNb ?>
                </h3>
                <p>Requests</p>
            </span>
        </li>
    </ul>

       
       <div class="request">
        <h4>Appointment Requests</h4>
        <table class="request-table" id="requestTable">
            <thead>
            <tr>
                <th>Name of Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                    <?php 
                        $appointments= getAppointmentRequest($doctorId);
                        if(mysqli_num_rows($appointments) >0){
                            foreach($appointments as $item)
                            {
                                ?>
                                    <tr>
                                        <td>
                                        <p class="name"><?= $item['Fname']; ?> <?= $item['Lname'] ?></p>
                                        </td>
                                        <td><?= $item['date']; ?></td>
                                        <td><?= $item['time']; ?></td>
                                        <td>
                                        <button class="acc-btn" value="<?= $item['appId'] ?>"><i class='bx bx-check-circle'></i></button>
                                        <button class="del-btn" value="<?= $item['appId'] ?>"><i class='bx bx-x-circle'></i></button>
                                       </td>
                                    </tr>

                    <?php

                            }

                        }else{
                            echo "<tr><td colspan ='4'>no appointments found</td></tr>";
                        }
                    ?>
           
        </table>
        
       </div>
       </div>
       <div class="right">
        <div class="right-side">
            <div class="top">
            <h2>Patients</h2>
           <div class="filter">
            <input type="text" id="searchInput" placeholder="Search..."><i class='bx bx-search-alt-2'></i>
           </div>
           </div>
           <table class="appointments" id="dataTable">
            <?php

            $patients = getPatients($doctorId);
            if (mysqli_num_rows($patients) > 0){
                foreach ($patients as $patient){
            ?>   
            <tr class="p-row">
                <td>
                    <div class="info">
                    <h3 id="name"><?= $patient['Fname']; ?> <?= $patient['Lname'] ?></h3>
                    <label><i class='bx bxs-phone' >Phone:</i><span id="phone"><?= $patient['phoneNumber']?></span></label>
                    <label><i class='bx bxs-envelope' ></i>Email:<span id="email"><?= $patient['email']?></span></label>
                    </div>  
                </td>
                <td>
                    <div class="view-btn">
                        <a href="patient.php?id=<?= $patient['patientId'] ?>"><button id="view" name="view">View</button></a>
                    </div>
                </td>
            </tr>
            <?php

                }

                }else{
                        echo "<tr><td colspan ='4'>no appointments found</td></tr>";
                    }
            ?>
           </table>
        </div>
        </div>
     </div>
     <!-- End of Main Content-->

    <script src="assets/js/dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/js/buttonActions.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>