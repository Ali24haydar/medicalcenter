<?php
require('../config/dbcon.php');
$did=$_SESSION['doctorId'];
$query="select Fname,Lname,profilePic from user,doctor where user.userId=doctor.userId and doctorId=?";
$stmt= mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $did);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$photo="docImgPlaceholder.jpg";
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $drfname = $row['Fname'];
    $drlname=$row['Lname'];
    if($row['profilePic']!=null)
    {
      $photo=$row['profilePic'];
    }
}

$currentScript = basename($_SERVER['PHP_SELF']);

$currentPage = ($currentScript == 'dashboard.php') ? 'dashboard.php' :
               (($currentScript == 'addpatient.php') ? 'addpatient.php' :
               (($currentScript == 'settings.php') ? 'settings.php' : ''));

?>
<aside class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="logo">
                <i class='bx bx-pulse'></i>
                <div class="logo-name"><span>Health</span>Hub</div>
            </a>
        <i class="bx bx-menu"></i>
        </div>
        <div class="user">
            <img src="../../uploads/<?=$photo?>" class="user-img">
            <label class="user-name">Dr. <?=$drfname?> <?=$drlname?></label>
            <!-- <label class="user-clinic">Cardiology</label> -->
        </div>
        <ul class="side-menu">
        <ul class="side-menu">
        <li <?php echo ($currentPage == 'dashboard.php') ? 'class="active"' : ''; ?>>
            <a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a>
        </li>
        <li <?php echo ($currentPage == 'addpatient.php') ? 'class="active"' : ''; ?>>
            <a href="addpatient.php"><i class='bx bx-calendar-edit'></i>Manage Appointments</a>
        </li>
        <li <?php echo ($currentPage == 'settings.php') ? 'class="active"' : ''; ?>>
            <a href="settings.php"><i class='bx bx-cog'></i>Settings</a>
        </li>
    </ul>
        </ul>
        <ul class="side-menu">
            <li class="log-li">
                <a href="../logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
     </aside>