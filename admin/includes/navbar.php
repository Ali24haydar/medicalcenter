<!-- Navbar -->
<?php

$fullname = $_SESSION['auth_user']['name'];
$nameArray = explode(' ', $fullname);
$firstNameInitial = strtoupper(substr($nameArray[0], 0, 1));
$lastNameInitial = strtoupper(substr(end($nameArray), 0, 1));
$profileName = $firstNameInitial .$lastNameInitial;

?>
<nav>
    <i class='bx bx-menu'></i>
    <form action="#">
        <div class="form-input">
          
            <div class="container">
                <div class="searchInput">
                    <input type="search" placeholder="Search...">
                    <div class="resultBox">
                    <!-- here list are inserted from javascript -->
                    </div>
                    <button class="icon" type="submit"><i class="bx bx-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <input type="checkbox" id="theme-toggle" hidden>
    <label for="theme-toggle" class="theme-toggle"></label>
  
    <a href="settings.php" class="notif">
        <i class='bx bx-user'></i>
        <span class="count"><?= $profileName; ?></span>
    </a>
    <a href="../images/HealthHubLogo.png" class="imageLB profile"> 
        <img src="../images/HealthHubLogo.png" alt="LOGO">
    </a>
</nav>
<!-- End of Navbar -->