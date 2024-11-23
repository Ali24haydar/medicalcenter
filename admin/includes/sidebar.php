<?php
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
?>
<!-- Sidebar -->
<aside class="sidebar">
<a href="dashboard.php" class="logo">
    <i class='bx bx-pulse'></i>
    <div class="logo-name"><span>Health</span>Hub</div>
</a>
<ul class="side-menu">
    <li class="<?= $page == 'dashboard.php'? "active" : "";?>"><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
    <li class="<?= $page == 'clinics.php'? "active" : "";?>"><a href="clinics.php"><i class='bx bx-store-alt'></i>Clinics</a></li>
    <li class="<?= $page == 'doctors.php'? "active" : "";?>"><a href="doctors.php"><i class='bx bx-first-aid'></i>Doctors</a></li>
    <li class="<?= $page == 'patients.php'? "active" : "";?>"><a href="patients.php"><i class='bx bx-group'></i>Patients</a></li>
    <li class="<?= $page == 'donors.php'? "active" : "";?>"><a href="donors.php"><i class='bx bx-donate-blood'></i>Donors</a></li>
    <li class="<?= $page == 'workingHours.php'? "active" : "";?>"><a href="workingHours.php"><i class='bx bx-time'></i>Working Hours</a></li>
    <li class="<?= $page == 'feedbacks.php'? "active" : "";?>"><a href="feedbacks.php"><i class='bx bx-notepad'></i>Feedbacks</a></li>
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
<!-- End of Sidebar -->