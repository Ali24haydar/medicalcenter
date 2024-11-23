<?php 
session_start(); 
require('config/dbcon.php');
require('middleware/logMiddleware.php');
?>

<!DOCTYPE html> 
<html lang="en"> 
  <head> 
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <title>Sign in & Sign up Form</title> 
    <link rel="icon" href="images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css" /> 
  </head> 
  <body> 


    <div class="container"> 
      <div class="forms-container"> 

        <div class="signin-signup"> 

        <form class="sign-in-form" id="sign-in"> 
            <h2 class="title">Sign in</h2> 
            <div class="input-field"> 
              <i class="fas fa-user"></i> 
              <input type="text" placeholder="email" name="email" id="email" class="email"/> 
            </div> 
            <div class="display"><p class="message" id="emailMsg"></p></div>
            <div class="input-field"> 
              <i class="fas fa-lock"></i> 
              <input type="password" placeholder="Password" name="password"  id="password"/> 
            </div> 
            <div class="display"><p class="message pwd" id="pwdMsg"></p></div>
            <div class="form-footer"> 

            <a class="forget-link" href="ResetPassword/resetPassword-Form.php"> Forget your password? </a> 
            <input type="button" value="Login" class="btn solid" name="loginBtn" id="signin-btn" />
            </div>
        </form> 

          <form action="phpCode.php" method="post" class="sign-up-form" id="sign-up"> 
            <h2 class="title">Sign up</h2> 

            <div class="fullname">
              <div class="content-field">
                <div class="input-field name first"> 
                  <i class="fas fa-user"></i> 
                  <input type="text" placeholder="First Name" name="FirstName" id="First-Name" /> 
                </div>
                <div><p class="message" id="name"></p></div>
              </div>

              <div class="content-field">
                <div class="input-field name last"> 
                  <i class="fas fa-user"></i>
                  <input type="text" placeholder="Last Name" name="LastName" id="Last-Name"/> 
                </div>
                <div><p class="message" id="name2"></p></div>
              </div>
            </div>
            
            <div class="content-field">
              <div class="input-field"> 
                <i class="fas fa-envelope"></i> 
                <input type="email" placeholder="Email" class="email" name="email2" id="email2" /> 
              </div> 
              <div class="display"><p class="message" id="emailMsg2"></p></div>
           </div>

            <div class="content-field">
              <div class="input-field"> 
                <i class="fas fa-phone"></i> 
                <input type="number" placeholder="Phone Number"name="contact" class="contact" id="phone" /> 
              </div> 
              <div class="display"><p class="message" id="pMsg"></p></div>
            </div>

            <div class="content-field">
              <div class="input-field"> 
                <i class="fas fa-lock"></i> 
                <input type="password" placeholder="Password" name="password" id="pwd2"/> 
              </div>
              <div class="display"><p class="message pwd" id="pwdMsg2"></p></div>
            </div>

            <div class="content-field">
              <div class="input-field"> 
                <i class="fas fa-lock"></i> 
                <input type="password" placeholder="Confirm Password" name="cpassword" id="confirm-pwd"/> 
              </div>
              <div class="display"><p class="message pwd" id="confirmMsg"></p></div>
            </div>

            <div class="info"> 
              <div class="content-field">
                <label>Date of Birth</label> 
                <div class="date-of-birth"> 
                  <input type="date" name="date" class="date" id="date" > 
                </div> 
                <p class="message" id="infoMsg"></p>
              </div>
             
              <div class="content-field">
                <label>Gender</label> 
                <div class="gender"> 
                  <input class="radio-input" type="radio" name="gender" id="female" value="female"><label for="female" class="radio-label">Female</label> 
                  <input class="radio-input" type="radio" name="gender" id="male" value="male"><label for="male" class="radio-label">Male</label> 
                </div>
                <p class="message" id="radioMsg"></p>
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

            <input type="submit" name="submit" class="btn solid up" value="Sign up" id="signup-btn" />
          </form> 
        </div> 
      </div> 
 
      <div class="panels-container"> 
        <div class="panel left-panel"> 
          <div class="content"> 
            <h3>New here ?</h3> 
            <p> 
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, 
              ex ratione. Aliquid! 
            </p> 
            <button class="btn transparent" id="sign-up-btn"> 
              Sign up 
            </button> 
          </div> 
          <img src="images/img2.png" class="image left" alt="" />
        </div> 
        <div class="panel right-panel"> 
          <div class="content"> 
            <h3>One of us ?</h3> 
            <p> 
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum 
              laboriosam ad deleniti. 
            </p> 
            <button class="btn transparent" id="sign-in-btn"> 
              Sign in 
            </button> 
          </div> 
          <img src="images/img1.png" class="image right" alt="" /> 
        </div> 
      </div> 
    </div> 
 
    <script src="assets/js/app.js"></script> 
    <script src="assets/js/siginValidation.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/js/sign-in-up.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  </body> 
</html>