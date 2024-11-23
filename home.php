
    <?php
        session_start();
        include('functions/selectData.php');
        require('middleware/homeMiddleware.php');
        include('includes/header.php');

        $doctorCount  = getRowCount('doctor');
        $patientCount = getRowCount('patient');
        $clinicCount  = getRowCount('clinic');
        $donorCount   = getRowCount('donor');                
    ?>                
    
    <!-- Section Banner -->
    <section id="banner" class="banner">
        <div class="banner-container">
            <h1><?php echo $banner['greet']; ?></h1>
            <h1 class="bannerHeading-mt"><?php echo $banner['title']; ?></h1>
            <h2><?php echo $banner['subtitle']; ?> </h2>
        </div>
        <div class="why-us-container">
            <div class="why-us-grid-col1 col1-content">
                <h3><?php echo $whyUs['Why Choose Health Hub?']; ?></h3>
                <ul>
                    <li>-<?php echo $whyUs['Compassionate Care']; ?></li> 
                    <li>-<?php echo $whyUs['Medical Excellence']; ?></li>
                    <li>-<?php echo $whyUs['Innovation']; ?></li>
                </ul>
            </div>
    
            <div class="why-us-grid-col2">
                <div class="icon-box">
                    <i class="fa-solid fa-user-doctor"></i>
                    <h4><?php echo $whyUs['Medical Team']; ?></h4>
                    <p><?php echo $whyUs['boxdesc2']; ?> </p>
                </div>
            </div>
    
            <div class="why-us-grid-col2">
                <div class="icon-box">
                    <i class="fa-solid fa-calendar-days"></i>
                    <h4><?php echo $whyUs['Stay Informed']; ?></h4>
                    <p><?php echo $whyUs['boxdesc3']; ?></p>
                </div>
            </div>
    
            <div class="why-us-grid-col2">
                <div class="icon-box">
                    <i class="fa-solid fa-language"></i>
                    <h4><?php echo $whyUs['Accessible Language']; ?></h4>
                    <p><?php echo $whyUs['boxdesc4']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Book Appointment -->
    <div class="button-app">
        <a href="clinics.php"><i class="fa-solid fa-plus"></i></a>
    </div>

    <!-- Section About Us -->
    <section id="aboutSection" class="about">
        <div class="about-container">
            <div class="about-col1">
                <img id="aboutImage" src="images/about-home.jpg" alt="about-home">
            </div>
            <div class="about-col2">
                <h3><?php echo $aboutUs['aboutTitle']; ?></h3>
                <p><?php echo $aboutUs['aboutDesc']; ?></p>
  
                <div class="icon-box">
                    <div class="icon">
                        <i class="fa-solid fa-eye-low-vision"></i>
                    </div>
                    <div class="title-description">
                        <h4 class="title"><?php echo $aboutUs['Our Mission']; ?></h4>
                        <p class="description"><?php echo $aboutUs['missionDesc']; ?></p>
                    </div>
                </div>
                <div class="icon-box">
                    <div class="icon">
                        <i class='bx bx-target-lock'></i>
                    </div>
                    <div class="title-description">
                        <h4 class="title"><?php echo $aboutUs['Our Vision']; ?></h4>
                        <p class="description"><?php echo $aboutUs['vissionDesc']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- Section Counts -->
     <section id="countsID" class="counts">
        <div class="Counts-container">
            <div class="count-sub-container">
                <div class="count-box">
                    <i class="fas fa-user-md"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $doctorCount-1; ?>" data-purecounter-duration="0" class="count">0</span>
                    <p><?php echo $counter['Doctors']; ?></p> 
                </div>
                <div class="count-box">
                    <i class="bx bx-group"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $patientCount-1; ?>" data-purecounter-duration="0" class="count">0</span>
                    <p><?php echo $counter['Patients']; ?></p>
                </div>
                <div class="count-box">
                    <i class="bx bx-clinic"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $clinicCount-1; ?>" data-purecounter-duration="0" class="count">0</span>
                    <p><?php echo $counter['Clinics']; ?></p>
                </div>
                <div class="count-box">
                    <i class="bx bx-donate-blood"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $donorCount-1; ?>" data-purecounter-duration="0" class="count">0</span>
                    <p><?php echo $counter['Donors']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <section id="serviceSection" class="service-heading">
        <div class="section-title">
            <h2><?php echo $service['title']; ?></h2>
            <p><?php echo $service['subTitle']; ?></p>
        </div>
    </section>

    <!-- Section Services -->
    <section id="service" class="service">
        <div class="service-container">
            <div class="col col-1">
                <div class="service-column">
                    <i class='bx bxs-injection'></i>
                    <h1><?php echo $service['service1T']; ?></h1>
                    <p><?php echo $service['service1desc']; ?></p>
                </div>
    
                <div class="service-column">
                    <i class='bx bxs-camera-plus'></i>
                    <h1><?php echo $service['service2T']; ?></h1>
                    <p class="padding-on-ipad"><?php echo $service['service2desc']; ?></p>
                </div>
            </div>
            <div class="col col-2">
                <div class="service-center">
                    <img src="images/services-home.jpg" class="service-image" width="150" height="150">
                </div>
            </div>
            <div class="col col-3">
                <div class="service-column">
                    <i class='bx bxs-shield-plus'></i>
                    <h1><?php echo $service['service3T']; ?></h1>
                    <p><?php echo $service['service3desc']; ?></p>
                </div>
                <div class="service-column">
                    <i class='bx bxs-user-voice'></i>
                    <h1><?php echo $service['service4T']; ?></h1>
                    <p><?php echo $service['service4desc']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <section id="doctorSection" class="doctor-heading">
        <div class="section-title">
            <h2><?php echo $doctor['title']; ?></h2>
            <p><?php echo $doctor['subtitle']; ?></p>
        </div>
    </section>

    <section id="doctor" class = "doctor" >
        <div class="doctor-container">
        <?php
            $doctors  = getDoctors();
            $rowcount = mysqli_num_rows($doctors);
            //echo $rowcount;
            $max = 0;
            if($rowcount > 0){
                /*while($selectdata = mysqli_fetch_array($result)){*/
                for($i=0; $i < $rowcount ; $i++){
                    $max++;
                    if($max > 4){
                        break;
                    }
                    $selectdata = mysqli_fetch_array($doctors);
                    $profilePic = "docImgPlaceholder.jpg";
                    if($selectdata['doctorPhoto'] != null){
                        $profilePic = $selectdata['doctorPhoto'];
                    }   
            ?>
            <div class="doctor-column<?php echo $i; ?>">
                <div class="team__item">
                    <img src="uploads/<?php echo $profilePic; ?>" alt="">
                    <h5>Dr. <?php echo $selectdata['FullName']; ?></h5>
                    <span><?php echo $selectdata['clinicName']; ?></span>
                    <div class="team__item__social">
                        <a href="<?= $selectdata['facebook']  != "" ?  $selectdata['facebook']  : "#" ?>"><i class="fa-brands fa-facebook"></i></a>
                        <a href="<?= $selectdata['instagram'] != "" ?  $selectdata['instagram'] : "#" ?>"><i class="fa-brands  fa-instagram"></i></a>
                        <a href="<?= $selectdata['linkedin']  != "" ?  $selectdata['linkedin']  : "#" ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        <?php
                }
            }
        ?>
        </div> 
    </section>

    <section id="clinic-heading" class="clinic-heading">
        <div class="section-title">
            <h2><?php echo $clinic['title']; ?></h2>
            <p><?php echo $clinic['subtitle']; ?></p>
        </div>
    </section>
    
    <!-- Section Clinics -->
    <section id="clinics" class="clinics">
        <div class="clinic-container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                <?php
                    $clinics  = getClinics();
                    $rowcount = mysqli_num_rows($clinics);
                    //echo $rowcount;
                    $max = 0;
                    if($rowcount > 0){
                        for($i=0; $i < $rowcount; $i++){
                            $max++;
                            if($max > 10){
                                break;
                            }
                            $selectdata = mysqli_fetch_assoc($clinics);
                    ?>
                            <div class="swiper-slide item">
                                <div class="clinic-img">
                                    <img src="uploads/<?php echo $selectdata['photo']; ?>" class="w-80" alt="<?php echo $selectdata['name']; ?> clinic">
                                </div>
                                <div class="clinic-info">
                                    <h3><?php echo $selectdata['name']; ?></h3>
                                    <p><?php echo $selectdata['description']; ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>  
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Section Donation -->
     <section id="donation" class="donation">
        <div id="donatPanel" class="donation-panel">
            <h1><i class='<?php echo $donate['leftComma']; ?>'></i><?php echo $donate['title']; ?><i class='<?php echo $donate['rightComma']; ?>'></i></h1>
            <img src="images/donate-bg1-removebg-preview.png" alt="">
            <button id="btn-donate" class="click-to-donate"><span class="clickHere"><?php echo $donate['Donate']; ?></span></button>
        </div>
        <div id="donateForm" class="donation-form">
            <h1><i class='<?php echo $donate['leftComma']; ?>'></i><?php echo $donate['title']; ?><i class='<?php echo $donate['rightComma']; ?>'></i></h1>
            <div class="donation-content">
                <i class="fa-solid fa-xmark"></i>
                <div class="sectionOne">
                    <img src="images/donate-bg2-removebg-preview.png">
                </div>
                <p><?php echo $donate['formtitle']; ?></p>
                <form id = "donateform" method="post" enctype="multipart/form-data">    
                    <div class="email-input">  
                        <input type="text" id="email" name="email-phone" class="donation-input" placeholder="<?php echo $donate['placeholder']; ?>">
                        <span id="errorInput"></span>
                    </div>
                    <div class="blood-group"> 
                        <label for="mySelect"><?php echo $donate['select']; ?></label> 
                        <select id="mySelect" name="mySelect"> 
                            <option value="Blood-Type">Blood Type</option> 
                            <option value="A+">A+</option> 
                            <option value="B+">B+</option> 
                            <option value="O+">O+</option> 
                            <option value="AB+">AB+</option> 
                            <option value="A-">A-</option> 
                            <option value="B-">B-</option> 
                            <option value="O-">O-</option> 
                            <option value="AB-">AB-</option> 
                        </select>
                    </div> 
                    <button id="click_donate" name="btn_send" type="button" class="btn-send"> <?php echo $donate['Donate']; ?> </button>
                </form>
            </div>
        </div>
    </section> 

<?php 
    include('includes/footer.php'); 
?>
