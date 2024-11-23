<?php
    session_start();
    require("functions/myfunctions.php");
    require('middleware/adminMiddleware.php');
    include('includes/header.php');
?>

<?php
        if(isset($_GET['doctorId']))
        {
            $id = $_GET['doctorId'];
        

            ?>

        <main>
            <div class="header">
                <div class="left">
                    <h1>Edit Doctor</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Edit Profile
                            </a></li>
                        /
                        <li><a id="specDocNameDisplay" class="active"></a></li>
                    </ul>
                </div>
                <a href="doctors.php" class="report">
                    <i class='bx bx-arrow-back'></i>
                    <span>Back</span>
                </a>
            </div>
    
            <div class="bottom-data">
   
            <input type="hidden" id="editDrpageId" value="<?= $id; ?>">
            <!-- Reminders -->
            <div class="reminders centerBox">
                <div class="header">
                    <i class='bx bx-timer'></i>
                    <h3>Doctor WHours</h3>
                </div>
                <form class="form" id="manageDWHForm">
                    <p class="title">Manage WH</p>
                    <p class="message">Please Enter The Needed Information. </p>

                    <input id="manageDWHFormId" name="manageDWHFormId" value="<?= $id; ?>" required type="hidden">

                    <label>
                        <select name="DWHDay" id="DWHDay" class="input" required>

                        </select>
                        <span id="DWHDayError">WHD</span>
                    </label>

                    <div class="flex">
                        <label>From:
                            <input id="DWHFrom" name="DWHFrom" required placeholder="" type="time" class="input">
                            <p id="DWHFromError" class="imgError">From</p>
                        </label>
                
                        <label>To:
                            <input id="DWHTO" name="DWHTO" required placeholder="" type="time" class="input">
                            <p id="DWHTOError" class="imgError">To</p>
                        </label>
                    </div>                        
                    
                    <label class="check-container" id="check_display">Available
                        <input type="checkbox" name="available" id="available" checked>
                        <span class="checkmark"></span>
                    </label>

                    <button id="manageDWHFormBtn" type="button" class="submit">Submit</button>
                </form>
            </div>
            <!-- End of Reminders-->

            <!-- Reminders -->
            <div class="reminders centerBox">
                <div class="header">
                    <i class='bx bx-timer'></i>
                    <h3>Exception Hours</h3>
                </div>
                <form class="form" id="manageExceptionForm">
                    <p class="title">Working Exceptions</p>
                    <p class="message">ADD Exception:</p>

                    <input type="hidden" value="<?= $id; ?>" id="docId" name="docId">
                    
                    <label>Date:
                        <input id="exceptionDay" name="exceptionDay" placeholder="" required type="date" class="input">
                        <p id="exceptionDayError" class="imgError">From</p>
                    </label>
                    <div class="flex">
                        <label>From:
                            <input id="exceptionFrom" name="exceptionFrom" required placeholder="" type="time" class="input">
                            <p id="exceptionFromError" class="imgError">From</p>
                        </label>
                
                        <label>To:
                            <input id="exceptionTO" name="exceptionTO" required placeholder="" type="time" class="input">
                            <p id="exceptionTOError" class="imgError">To</p>
                        </label>
                    </div>               
                    
                    <label class="check-container" id="check_display">Available
                        <input type="checkbox" name="availableException" id="availableException" checked>
                        <span class="checkmark"></span>
                    </label>

                    <button id="manageExceptionFormBtn" type="button" class="submit">ADD</button>
                </form>
            </div>
            <!-- End of Reminders-->
    
                <!-- Reminders -->
                <div class="reminders centerBox">
                    <div class="header">
                        <i class='bx bx-pencil'></i>
                        <h3>Edit Doctor Account</h3>
                    </div>
                    <form class="form" id="editDoctorForm">
                        <p class="title">Update Info</p>
                        <p class="message">Please Enter The Needed Information. </p>

                        <input type="hidden" value="" id="editDoctorFormId" name="editDoctorFormId">
                        <input type="hidden" value="" id="editUserId" name="editUserId">
                        <div class="flex">
                            <label>
                                <input id="editDoctorFN" name="editDoctorFN" value="" required placeholder="" type="text" class="input">
                                <span class="FirstName" id="editDoctorFNError">Firstname</span>
                            </label>
                    
                            <label>
                                <input id="editDoctorLN" name="editDoctorLN" value="" required placeholder="" type="text" class="input">
                                <span class="LastName" id="editDoctorLNError">Lastname</span>
                            </label>
                        </div>  

                        <label>
                            <select id="editDoctorClinic" name="editDoctorClinic" class="input s2" required>
     
                            </select>
                            <span id="editDoctorClinicError">Clinic</span>
                        </label> 
                                
                        <label>
                            <input disabled id="editDoctorEmail" name="editDoctorEmail" value="" required placeholder="" type="email" class="input">
                            <!-- <span id="editDoctorEmailError">Email</span> -->
                        </label>
                        
                        <label>
                            <input id="editDoctorPhone" name="editDoctorPhone" value="" required placeholder="" type="tel" class="input">
                            <span id="editDoctorPhoneError">Phone</span>
                        </label>
                        
                        <button id="editDoctorFormBtn" type="button" class="submit">Save Changes</button>                              
                    </form>
                </div>
                <!-- End of Reminders-->
    
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-time'></i>
                        <h3>Manage Exceptions</h3>
                        <form class="expanding-search-form">
                            <div class="search-dropdown">
                                <button class="button dropdown-toggle" type="button">
                                <span class="toggle-active">Day</span>
                                <span class="ion-arrow-down-b"></span>
                                </button>
                                <ul class="dropdown-menu">
                                <li class="menu-active"><a href="#">Day</a></li>
                                </ul>
                            </div>
                            <input class="search-input" id="global-search" type="search" placeholder="Search">
                            <button class="button search-button" type="button">
                                <span class="icon ion-search">
                                    <span class="sr-only">Search</span>
                                </span>
                            </button>
                        </form>
    <!--                     <form class="form" style="background: transparent;">
                            <div class="flex3">     
                                <label>ADD Exception: </label>
                                <label>
                                    <input required="" placeholder="" type="date" class="input">
                                </label>
                                <label>
                                    <input required="" placeholder="" type="text" class="input">
                                    <span>reason</span>
                                </label>
                                <button class="submit">ADD</button>
                            </div>
                        </form> -->
<!--                     <form class="form" id="manageExceptionForm" action="functions/code.php"  method="post" enctype="multipart/form-data">
                        <p class="title">Working Exceptions</p>
                        <p class="message">ADD Exception:</p>

                        <input type="hidden" value="" id="docId" name="docId">

                        <div class="flex">
                            <label>Date:
                                <input id="exceptionDay" name="exceptionDay" placeholder="" required type="date" class="input">
                                <p id="exceptionDayError" class="imgError">From</p>
                            </label>
                            <label>From:
                                <input id="exceptionFrom" name="exceptionFrom" required placeholder="" type="time" class="input">
                                <p id="exceptionFromError" class="imgError">From</p>
                            </label>
                    
                            <label>To:
                                <input id="exceptionTO" name="exceptionTO" required placeholder="" type="time" class="input">
                                <p id="exceptionTOError" class="imgError">To</p>
                            </label>
                        </div>               
                        
                        <label class="check-container" id="check_display">Available
                            <input type="checkbox" name="availableException" id="availableException">
                            <span class="checkmark"></span>
                        </label>
    
                        <button id="manageExceptionFormBtn" type="button" class="submit">ADD</button>
                    </form> -->
                    </div>
                    <table id="dataTable" class="exceptionTable">
                        <thead>
                            <tr>
                                <th>Day</th>  
                                <th>From</th>  
                                <th>To</th>  
                                <th>Available</th>  
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="exceptionTbody">

                        </tbody>
                    </table>
                </div>
    
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