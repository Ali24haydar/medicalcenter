<?php
session_start();
include("queryFunctions/queryfunctions.php");
require('middleware/doctorMiddleware.php');
$doctorId = $_SESSION['doctorId'];
$userEmail = $_SESSION['auth_user']['email'];
/* $doctorId = getDoctorId($doctor);  */
if (isset($_GET['id'])) {
    $patientId = $_GET['id'];
}
$sql = "SELECT `email` FROM `patient`, `user` WHERE patient.patientId = $patientId AND
 patient.userId = user.userId";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Patients </title>
    <link rel="icon" href="/images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/patient.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!-- Sidebar -->
    <?php
        include('./includes/sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <!-- Start of Content -->
    <div class="content">
        <div class="left-side">
        <h3>Patient's Info</h3>
        <?php 
            $specificPatient = getPatientById($patientId);
            if(mysqli_num_rows($specificPatient) > 0){
            foreach($specificPatient as $patient){
            ?>
        <div class="patient-info">
            <div class="left">
            <h2 class="name" id="name"><?= $patient['Fname'] ?> <?= $patient['Lname']?></h2>
            <p class="email" id="email"><?= $patient['email'] ?></p>
            <h5>Appointments</h5>
            <table class="apps">
                <tr>
                <td>
                    <h2 class="past" id="past"><?= getPastAppointments($patientId,$doctorId) ?></h2>
                    <label>Past</label>
                </td>
                <td>
                    <h2 class="upcoming" id="upcoming"><?= getUpcomingAppointments($patientId,$doctorId) ?></h2>
                    <label>Upcoming</label>
                </td>
                </tr>
            </table>
            </div>

            <div class="right">
                <table class="info">
                <tr>
                    <td>
                        <div class="cell">
                        <label>Gender</label>
                        <span><?= $patient['gender'] ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="cell">
                        <label>Birthday</label>
                        <span><?= $patient['dateOfBirth'] ?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="cell">
                        <label>Blood Group</label>
                        <span><?= $patient['bloodType'] ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="cell">
                        <label>Registration Date</label>
                        <span><?= $patient['registrationDate'] ?></span>
                        </div>
                    </td>
                </tr>
            <?php
            }}
            ?>
                </table>
                <button class="send-email" id="sendEmailButton">Send Email</button>
            </div>
            
        </div>

        <div class="apps-table">
            <h3>Appointments</h3>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
                <?php 
                $apps = getAppointmentById($patientId,$doctorId);
                if(mysqli_num_rows($apps) > 0){
                foreach($apps as $app){
                ?>
                <tr>
                    <td><?= $app['date'] ?></td>
                    <td><?= $app['time'] ?></td>
                    <td><span class="<?= $app['status']; ?>"><?= $app['status'] ?></span></td>
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

        <div class="right-side">
        <div class="notes">
            <div class="page">
            <h2>Health Hub</h2>
            <form id="patient-from" class="patient-from">
                <div class="inputs">
                <div class="input-field"><label>First Name </label><input type="text" name="first-name"></div>
                <div class="input-field"><label>Last Name </label><input type="text" name="last-name"></div>
                </div>
                <div class="inputs">
                <div class="input-field"><label>Age</label><input type="number" name="age"></div>
                <div class="input-field"><label class="date">Date </label><input type="date" name="first-name"></div>
                </div>
                <textarea id="myTextarea" rows="7"></textarea>
            </form>
            <div class="signature">
                <label>Doctor Signature: </label><input type="text" name="doctor">
            </div>
            </div>
            <button>Print</button>
        </div>
        </div>
    </div>
    <!-- End of Content -->

    <script>
    document.getElementById('sendEmailButton').addEventListener('click', function() {
    // Replace 'patient_email@example.com' with the patient's email address
    var patientEmail = "<?php echo $email; ?>";
    
    // Constructing the mailto link
    var mailtoLink = 'mailto:' + patientEmail;
    
    // Open the mail client
    window.location.href = mailtoLink;

    });

    </script>

    <script src="assets/js/patient.js"></script>
</body>
</html>