<?php
    session_start();
    require("functions/myfunctions.php");
    require('middleware/adminMiddleware.php');
    include('includes/header.php');

    $clinicsNb= getRowCount("clinic");
    $doctorsNb= getRowCount("doctor");
    $patientsNb= getRowCount("patient");
    $donorsNb= getRowCount("donor");

?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a href="#">
                            Analytics
                        </a></li>
                    /
                    <li><a href="#" class="active">Appointments</a></li>
                </ul>
            </div>
            <a href="settings.php" class="report">
                <i class='bx bx-user'></i>
                <span>Welcome: <?= $_SESSION['auth_user']['name']; ?></span>
            </a>
        </div>

        <!-- Insights -->
        <ul class="insights">
            <li>
                <i class='bx bx-clinic'></i>
                <span class="info">
                    <h3>
                        <!-- 1,074 -->
                        <?= $clinicsNb ?>
                    </h3>
                    <p>Clinics</p>
                </span>
            </li>
            <li><i class='bx bx-first-aid'></i>
                <span class="info">
                    <h3>
                        <!-- 3,944 -->
                        <?= $doctorsNb ?>
                    </h3>
                    <p>Doctors</p>
                </span>
            </li>
            <li><i class='bx bx-group'></i>
                <span class="info">
                    <h3>
                        <!-- 14,721 -->
                        <?= $patientsNb ?>
                    </h3>
                    <p>Patients</p>
                </span>
            </li>
            <li><i class='bx bx-donate-blood'></i>
                <span class="info">
                    <h3>
                        <!-- 6,742 -->
                        <?= $donorsNb ?>
                    </h3>
                    <p>Donors</p>
                </span>
            </li>
        </ul>
        <!-- End of Insights -->

        <div class="bottom-data">
            <div class="orders" id="dashboardAppt">
                <div class="header">
                    <i class='bx bx-receipt'></i>
                    <h3>Recent Appts</h3>
                    <button type="button" id="sendConfEmailBtn" class="sendConfEmailBtn">Send Confirmation Emails</button>
                    <div class="filterContainer">
                        <form class="form">
                            <label>
                                <select name="apptDisplay" id="apptDisplay" class="input">
                                    <option value="0" selected>Today</option>
                                    <option value="1">Tomorrow</option>
                                    <option value="7">Last 7 days</option>
                                    <option value="8">Next 7 days</option>
                                    <option value="30">All</option>
                                </select>
                                <span>Date</span>
                            </label> 
                        </form>

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
                    </div>
                </div>
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="recentApptTbody">

                    </tbody>
                </table>
            </div>

            <!-- Reminders -->
            <div class="reminders">
                <div class="header">
                    <i class='bx bx-note'></i>
                    <h3>Reminders</h3>
                    <div id="reminderContainer" class="searchContainer">
                        <span id="searchIcon" onclick="toggleReminderBox()"><i class='bx bx-plus'></i></span>
                        <div id="reminderBox" class="reminderBox">
                            <form class="form" id="addReminderForm">
                                <label for="">
                                    <input class="input" type="text" id="reminderInput" name="reminderInput" required placeholder="">
                                    <span class="reminder" id="reminderInputError">reminder</span>
                                </label>
                                <button id="addReminderFormBtn" name="addReminderFormBtn" type="button" class="submit">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
                <ul class="task-list" id="reminders_list">
  
                </ul>
            </div>
            <!-- End of Reminders-->

        </div>

    </main>

<?php
    include('includes/footer.php');
?>