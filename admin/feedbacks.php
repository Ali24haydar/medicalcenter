<?php
    session_start();
    require('middleware/adminMiddleware.php');
    require("functions/myfunctions.php");
    include('includes/header.php');
?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Manage Feedbacks</h1>
                <ul class="breadcrumb">
                    <li><a href="#">
                            View
                        </a></li>
                    /
                    <li><a href="#" class="active">Manage</a></li>
                </ul>
            </div>
            <a href="dashboard.php#dashboardAppt" class="report">
                <i class='bx bx-receipt'></i>
                <span>View Appointments</span>
            </a>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-receipt'></i>
                    <h3>Feedbacks</h3>
                    <form class="expanding-search-form">
                        <div class="search-dropdown">
                            <button class="button dropdown-toggle" type="button">
                            <span class="toggle-active">Doctor</span>
                            <span class="ion-arrow-down-b"></span>
                            </button>
                            <ul class="dropdown-menu">
                            <li class="menu-active"><a href="#">Doctor</a></li>
                            <li><a href="#">Patient</a></li>
                            <li><a href="#">Date</a></li>
                            </ul>
                        </div>
                        <input class="search-input" id="global-search" type="search" placeholder="Search">
                        <button class="button search-button" type="button">
                            <span class="icon ion-search">
                                <span class="sr-only">Search</span>
                            </span>
                        </button>
                    </form>
                </div>
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>publish</th>
                            <th>Delete</th>
                            <!-- <th class="action_center">Action</th> -->
                        </tr>
                    </thead>
                    <tbody id="feedbacksTbody">
   
                    </tbody>
                </table>
            </div>

        </div>

    </main>

<?php
    include('includes/footer.php');
?>