<?php
    session_start();
    require("functions/myfunctions.php");
    require('middleware/adminMiddleware.php');
    include('includes/header.php');
?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Manage Donors</h1>
                <ul class="breadcrumb">
                    <li><a href="#">
                            View Donors
                        </a></li>
                    /
                    <li><a href="#" class="active">Add blood type</a></li>
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
                    <h3>Possible Donors</h3>
                    <div class="filterContainer">
                        <button type="button" id="sendDonorEmailBtn" class="sendConfEmailBtn">Send Emails</button>

                        <form class="expanding-search-form">
                            <div class="search-dropdown">
                                <button class="button dropdown-toggle" type="button">
                                <span class="toggle-active">Info</span>
                                <span class="ion-arrow-down-b"></span>
                                </button>
                                <ul class="dropdown-menu">
                                <li class="menu-active"><a href="#">Info</a></li>
                                <li><a href="#">BloodType</a></li>
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
                            <th>Donor Info</th>
                            <th>Blood Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="donorsTbody">
    
                    </tbody>
                </table>
            </div>


            <div class="orders">
                <div class="header">
                    <i class='bx bx-receipt'></i>
                    <h3>Urgent BloodTypes</h3>
   
                    <form class="form" id="urgentBloodTypeForm" >
                    <p class="title">ADD Needed Blood Type </p>
                    <p class="message">Please Enter The Needed Information. </p>
                    <div class="flex">
                        <label>
                            <select name="urgentBT" id="urgentBT" class="input" required>
                                <option value="BT">Blood Type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            <span id="urgentBTError">BT</span>
                        </label>
                
                        <label>
                            <input id="urgentBTN" name="urgentBTN" required placeholder="" type="number" min="0" class="input">
                            <span id="urgentBTNError">Number Needed</span>
                        </label>
                    
                        <button id="urgentBloodTypeFormBtn" type="button" class="submit">ADD</button>
                    </div>
                </form>
                </div>
                <table id="dataTable2">
                    <thead>
                        <tr>
                            <th>Blood Type</th>
                            <th>Number Needed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="urgentBTDetails">

                    </tbody>
                </table>
            </div>

        </div>

    </main>

<?php
    include('includes/footer.php');
?>