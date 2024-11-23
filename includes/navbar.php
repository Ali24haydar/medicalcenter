<nav>
    <a href="home.php" class="navlogo">
        <img src="images/logoNav.png" alt="Logo Image">
    </a>
    <div class="hamburger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
    <ul class="nav-links">
        <div class="links">
        
            
            <li><a href="home.php"><?php echo $nav['HOME'] ?></a></li>
            <li><a href="home.php#aboutSection"><?php echo $nav['ABOUT'] ?></a></li>
            <li><a href="home.php#serviceSection"><?php echo $nav['SERVICES'] ?></a></li>
            <li><a href="clinics.php"><?php echo $nav['CLINICS'] ?></a></li>
            <li><a href="home.php#doctorSection"><?php echo $nav['DOCTORS'] ?></a></li>
           

        </div>
        <div class="icons">
            <li class="dropdown dropdown-6">
                <?php
                    if(isset($_SESSION['auth'])){
                        $fullname = $_SESSION['auth_user']['name'];
                        $nameArray = explode(' ', $fullname);
                        $firstNameInitial = strtoupper(substr($nameArray[0], 0, 1));
                        $lastNameInitial = strtoupper(substr(end($nameArray), 0, 1));
                        ?>
                        <button class="login-button"><i class="fa-solid fa-user"></i> <?= $firstNameInitial .'.' .$lastNameInitial .'. '; ?></button>
                        <ul class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
                            <?php
                                if($_SESSION['role_as'] == 2){
                                    ?>
                                        <a href="user.php"><li class="dropdown_item-2">Profile</li></a>
                                    <?php
                                }
                            ?>
                            <a href="logout.php"><li class="dropdown_item-1"><?php echo $nav['Logout']; ?></li></a>
                        </ul>
                        <?php
                    }else{
                        ?>
                        <button class="login-button"><i class="fa-solid fa-user"></i><?php echo $nav['Log in']; ?></button>
                        <ul class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
                            <a href="sign-in-up.php"><li class="dropdown_item-1"><?php echo $nav['Log in']; ?></li></a>
                            <a href="sign-in-up.php"><li class="dropdown_item-2"><?php echo $nav['SignUp']; ?></li></a>
                        </ul>
                        <?php
                    }
                ?>
            </li>
            <li class="dropdown dropdown-6">
                <button class="join-button" href="#"><i class="fa-solid fa-globe"></i> <?php echo $nav['EN']; ?></button>
                <ul class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
                  
                    <li class="dropdown_item-1"><a href="?lang=en"><?php echo $nav['EN']; ?></a></li>
                    <li class="dropdown_item-2"><a href="?lang=ar"><?php echo $nav['AR']; ?></a></li>
                </ul>
            </li>
           
        </div>
    </ul>
</nav>