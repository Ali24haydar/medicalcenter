<?php
    session_start();
    require("functions/myfunctions.php");
    require('middleware/adminMiddleware.php');
    include('includes/header.php');
?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Manage Working Hours</h1>
                <ul class="breadcrumb">
                    <li><a href="#">
                            Choose Hours
                        </a></li>
                    /
                    <li><a href="#" class="active">Available Doctors</a></li>
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
                    <i class='bx bx-time'></i>
                    <h3>Medical Hours</h3>
            
                </div>
                <table id="dataTable2">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="centerWHTbody">

                    </tbody>
                </table>
            </div>

            <!-- Reminders -->
            <div class="reminders centerBox">
                <div class="header">
                    <i class='bx bx-timer'></i>
                    <h3>Medical Hours</h3>
                </div>
                <form class="form" id="manageWHForm">
                    <p class="title">Manage WH</p>
                    <p class="message">Please Enter The Needed Information. </p>
                    <label>
                        <select name="WHDay" id="WHDay" class="input" required>
                            <option value="WHDay">Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thurday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                        <span id="WHDayError">WHD</span>
                    </label>

                    <div class="flex">
                        <label>From:
                            <input id="WHFrom" name="WHFrom" required placeholder="" type="time" class="input">
                            <p id="WHFromError" class="imgError">From</p>
                        </label>
                
                        <label>To:
                            <input id="WHTO" name="WHTO" required placeholder="" type="time" class="input">
                            <p id="WHTOError" class="imgError">To</p>
                        </label>
                    </div>                        
                    
                    <label class="check-container" id="check_display">Closed
                        <input type="checkbox" name="closed" id="closed">
                        <span class="checkmark"></span>
                    </label>

                    <button id="manageWHFormBtn" type="button" class="submit">Submit</button>
                </form>
            </div>
            <!-- End of Reminders-->

            <div class="orders">
                <div class="header">
                    <i class='bx bx-time'></i>
                    <h3>Doctors Working Hours</h3>
                    <form class="expanding-search-form">
                        <div class="search-dropdown">
                            <button class="button dropdown-toggle" type="button">
                            <span class="toggle-active">Name</span>
                            <span class="ion-arrow-down-b"></span>
                            </button>
                            <ul class="dropdown-menu">
                            <li class="menu-active"><a href="#">Name</a></li>
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
                <table id="dataTable" class="whTable">
                    <thead id="workingDaysTH">
<!--                         <tr >

                        </tr> -->
                    </thead>
                    <tbody id="doctorsWHTbody">
 
                    </tbody>
                </table>
            </div>

        </div>

    </main>

<?php
  include('includes/footer.php');
?>