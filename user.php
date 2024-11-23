<?php
  session_start();
  require('config/dbcon.php');
  require('middleware/patientMiddleware.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Page </title>
    <link rel="icon" href="images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/user.css" /> 
</head>
<body>

    <div class="container">
            <div class="header">
                <div class="title">
                <label>Welcome, </label><span><?= $_SESSION['auth_user']['name']; ?></span><br>
                <label class="date" id="date"></label>
                </div>
                <div class="buttons">
                    <a href="home.php" class="back"><button type="button" id="back" name="back"><i class="fas fa-arrow-left"></i>  Back</button></a>
                    <a href="logout.php"><button type="button" id="logout" name="logout" class="log-out">Log out</button></a>
                </div>
            </div>

            <div class="tables">
                <div class="table1">
                    <h2>Your Appointments</h2>
                    <table>
                      <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id= "patient-app"> 
                      </tbody>
                    </table>
                </div>
                <div class="table2">
                    <h2>Update Info</h2>
                    <form class="update-info" id="update-form">

                        <div class="content-field">
                          <div class="input-field"> 
                            <i class="fas fa-user"></i> 
                            <input type="text" placeholder="First Name" name="First-Name" id="update-fname" /> 
                          </div> 
                          <div class="display"><p class="message" id="firstmsg"></p></div>
                        </div>

                        <div class="content-field">
                          <div class="input-field"> 
                            <i class="fas fa-user"></i> 
                            <input type="text" placeholder="Last Name" name="Last-Name" id="update-lname"/> 
                          </div> 
                          <div class="display"><p class="message" id="lastmsg"></p></div>
                        </div>

                        <div class="content-field">
                          <div class="input-field"> 
                            <i class="fas fa-envelope"></i> 
                            <input type="email" placeholder="Email" name ="pat-email" id="update-email" disabled/> 
                          </div> 
                          <div class="display"><p class="message" id="emailMessage"></p></div>
                        </div> 

                        <div class="content-field">
                          <div class="input-field"> 
                            <i class="fas fa-phone"></i> 
                            <input type="number" placeholder="Phone Number" name="phone" class="contact" id="phone2" /> 
                          </div> 
                          <div class="display"><p class="message" id="pMsg2"></p></div>
                        </div>

                          <div class="row">
                          <div class="info"> 
                            <label>Date of Birth</label>
                            <div class="date-of-birth"> 
                              <input type="date" name="date" class="date" id="update-date"> 
                              <div class="display"><p class="message" id="dateMessage"></p></div>
                            </div> 
                           
                          </div>
                          <div class="info">
                            <label>Gender</label>
                            <div class="gender">
                              <input class="radio-input" type="radio" name="gender" id="female" value="female"><label for="female" class="radio-label">Female</label> 
                              <input class="radio-input" type="radio" name="gender" id="male" value="male"><label for="male" class="radio-label">Male</label> 
                            </div> 
                            </div>
                          </div> 

                          <div class="blood-group"> 
                            <label for="mySelect">Select your blood group:</label> 
                            <select id="mySelect" name="mySelect"> 
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
                        <button type="button" id="updateBtn" class="update-btn" name="update"> Update </button>
                    </form>
                    <h2>Change Password</h2>
                    <form class="change-pwd" id="change-password">

                      <div class="field-content">
                        <div class="input-field"> 
                        <i class="fas fa-lock"></i> 
                        <input type="password" placeholder="Current Password" name="password" id="current-pwd"/> 
                        </div>
                        <div class="display"><p class="message" id="currentmsg"></p></div>
                      </div>

                      <div class="field-content">
                        <div class="input-field"> 
                        <i class="fas fa-lock"></i> 
                        <input type="password" placeholder="New Password" name="password" id="new-pwd"/> 
                        </div> 
                        <div class="display"><p class="message" id="newmsg"></p></div>
                      </div>

                      <div class="field-content">
                        <div class="input-field"> 
                        <i class="fas fa-lock"></i> 
                        <input type="password" placeholder="Confirm Password" name="password" id="c-pwd"/> 
                        </div> 
                        <div class="display"><p class="message" id="cmsg"></p></div>
                      </div>

                      <button type="button" id="changeBtn" name="change-btn" class="change-btn"> Change </button>
                    </form> 
                </div>
            </div>
    </div>

    <script src="assets/js/user.js"></script>
    <script src="assets/js/siginValidation.js"></script>
   <!-- <script src="assets/js/validation.js"></script> -->
    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>