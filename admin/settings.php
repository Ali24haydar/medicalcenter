<?php
    session_start();
    require("functions/myfunctions.php");
    require('middleware/adminMiddleware.php');
    include('includes/header.php');
?>

  <main>
      <div class="header">
          <div class="left">
              <h1>Admin Settings</h1>
              <ul class="breadcrumb">
                  <li id="viewMode"><a href="#">
                          Profile
                      </a></li>
                      /
                  <li id="changeMode"><a href="#" class="active">Password</a></li>
              </ul>
          </div>
      </div>

      <section class="forms-section" id="adminForms">
          <h1 class="section-title">Login Information</h1>
          <div class="forms">
            <div id="viewWrapper" class="form-wrapper is-active">
              <button type="button" class="switcher switcher-login">
                Profile
                <span class="underline"></span>
              </button>
              <form class="animated-form form-login" id="adminForm1">
                <fieldset>
                  <legend>Please, enter your email and password for login.</legend>   
                  <div class="input-block">
                      <label for="signup-name">Name</label>
                      <div class="input-field"> 
                        <i class="bx bx-user"></i> 
                        <input id="signup-name" name="signup-name" value="" type="text" placeholder="name" required>
                        <span class="Name" id="signup-nameError">Admin Name</span>
                      </div>
                  </div>
                  <div class="input-block">
                    <label for="signup-email">E-mail</label>
                    <div class="input-field"> 
                      <i class="bx bx-envelope"></i> 
                      <input id="signup-email" name="signup-email" value="" type="email" placeholder="email" required>
                      <span id="signup-emailError">Admin Email</span>
                    </div>
                  </div>
                </fieldset>    
                <button id="adminFormBtn1" type="button" class="btn-signup">Save</button>
              </form>
            </div>
            <div id="changeWrapper" class="form-wrapper">
              <button type="button" class="switcher switcher-signup">
                Password
                <span class="underline"></span>
              </button>
              <form class="animated-form form-signup" id="adminForm2">
                <fieldset>
                  <legend>Please, enter your current password, new password and confirmation.</legend>
                  <div class="input-block">
                    <label for="signup-Currentpassword">Current Password</label>
                    <div class="input-field"> 
                      <i class="bx bx-lock"></i> 
                      <input id="signup-Currentpassword" name="signup-Currentpassword" value="" type="password" placeholder="Current Password" required>
                      <span id="signup-CurrentpasswordError">Current Password</span>
                    </div>
                  </div>
                  <div class="input-block">
                    <label for="signup-password">Password</label>
                    <div class="input-field"> 
                      <i class="bx bx-lock"></i> 
                      <input id="signup-password" name="signup-password" value="" type="password" placeholder="New Password" required>
                      <span id="signup-passwordError">New Password</span>
                    </div>
                  </div>
                  <div class="input-block">
                    <label for="signup-password-confirm">Confirm password</label>
                    <div class="input-field"> 
                      <i class="bx bx-lock"></i> 
                      <input id="signup-passwordConfirm" name="signup-passwordConfirm" value="" type="password" placeholder="Confirm Password" required>
                      <span id="signup-passwordConfirmError">Confirm Password</span>
                    </div>
                  </div>
                </fieldset>
                <button id="adminFormBtn2" type="button" class="btn-signup">Change</button>
              </form>
            </div>
          </div>
        </section>

  </main>

<?php
  include('includes/footer.php');
?>