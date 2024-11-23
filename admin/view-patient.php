<?php
    session_start();
    require("functions/myfunctions.php");
    require('middleware/adminMiddleware.php');
    include('includes/header.php');
?>

<?php
        if(isset($_GET['userId']))
        {
            $id = $_GET['userId'];
            ?>

            <input type="hidden" value="<?= $id; ?>" id="PuserId">
            <main>
            <div class="header">
                <div class="left">
                    <h1>View Patient</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                View Info
                            </a></li>
                        ->
                        <li><a class="active" id="specPatientName"></a></li>
                    </ul>
                </div>
                <a href="patients.php" class="report">
                    <i class='bx bx-arrow-back'></i>
                    <span>Back</span>
                </a>
            </div>
    
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Previous Appts</h3>
                        <form class="expanding-search-form">
                            <div class="search-dropdown">
                                <button class="button dropdown-toggle" type="button">
                                <span class="toggle-active">Name</span>
                                <span class="ion-arrow-down-b"></span>
                                </button>
                                <ul class="dropdown-menu">
                                <li class="menu-active"><a href="#">Name</a></li>
                                <li><a href="#">Date</a></li>
                                <li><a href="#">Status</a></li>
                                </ul>
                            </div>
                            <input class="search-input" id="global-search" type="search" placeholder="Search">
                            <button class="button search-button" type="button">
                                <span class="icon ion-search">
                                    <span class="sr-only">Search</span>
                                </span>
                            </button>
                        </form>  
                        <input type="hidden" value="" id="specPatientId">
                    </div>
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="specPApptTbody">

                        </tbody>
                    </table>
                </div>
    
                <div class="orders reminders">
                    <div class="header">
                        <i class='bx bx-user'></i>
                        <h3>Patient Data</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Info</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody id="specificPatientTbody">

                        </tbody>
                    </table>
                </div>
        </main>

            <?php

    }else{
        die("Id Missing From url");
    }

?>

<?php
  include('includes/footer.php');
?>