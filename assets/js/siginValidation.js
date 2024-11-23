//Form Variables

const signinForm = document.getElementById('sign-in');
const signupForm = document.getElementById('sign-up');
const updateForm = document.getElementById('update-form');
const passwordForm = document.getElementById('change-password');

//Input Variables

const fnameInput = document.getElementById('First-Name');
const lnameInput = document.getElementById('Last-Name');
const emailInput1 = document.getElementById('email');
const pwdInput1 = document.getElementById('password');
const emailInput2 = document.getElementById('email2');
const pwdInput2 = document.getElementById('pwd2');
const dateInput = document.getElementById('date');
const phoneInput = document.getElementById('phone');
const phoneInput2 = document.getElementById('phone2');
const confirmInput = document.getElementById('confirm-pwd');
const updateFname = document.getElementById('update-fname');
const updateLname = document.getElementById('update-lname');
const updateEmail = document.getElementById('update-email');
const updateDate = document.getElementById('update-date');
const updatePhone     = document.getElementById('phone2');
const updateGenderF   = document.getElementById('female');
const updateGenderM   = document.getElementById('male');
const updateBloodType = document.getElementById('mySelect');
const currentPasswordInput = document.getElementById('current-pwd');
const newPasswordInput = document.getElementById('new-pwd');
const cPasswordInput = document.getElementById('c-pwd');

//Message Variables
const emailMsg1 = document.getElementById('emailMsg');
const pwdMsg1 = document.getElementById('pwdMsg');
const emailMsg2 = document.getElementById('emailMsg2');
const pwdMsg2 = document.getElementById('pwdMsg2');
const nameMsg = document.getElementById('name');
const nameMsg2 = document.getElementById('name2');
const infoMsg = document.getElementById('infoMsg');
const phoneMsg = document.getElementById('pMsg');
const phoneMsg2 = document.getElementById('pMsg2');
const confirmMsg = document.getElementById('confirmMsg');
const firstMsg = document.getElementById('firstmsg');
const lastMsg = document.getElementById('lastmsg');
const emailMessage = document.getElementById('emailMessage');
const dateMessage = document.getElementById('dateMessage');
const currentMsg = document.getElementById('currentmsg');
const newMsg = document.getElementById('newmsg');
const cMsg = document.getElementById('cmsg');
const genderMsg = document.getElementById('radioMsg');

//Buttons
const signinBtn = document.getElementById('signin-btn');
const signupBtn = document.getElementById('signup-btn');

//variables for Table
const TableData = document.getElementById('patient-app');

document.addEventListener("DOMContentLoaded", function() {
    getPatientApp();
    getPatientProfile();
});

signinBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();

    }else{  
        let email= emailInput1.value;
        let password = pwdInput1.value;

        const isValid = validateSigninForm();

        if (!isValid) {
            /* alert("invalid form"); */
        } else {

           const checkAuth = async() => {
            const data = {
                email: email,
                password: password
            };
            await fetch('functions/authcode.php', {
                    method: 'POST', // or 'PUT'
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json() )
                .then((data) => {
                    if(data.response == 200){
                        window.location.href = 'admin/dashboard.php';
                    } 
                    else if(data.response == 201){
                        window.location.href = 'doctor/dashboard.php';
                    } 
                    else if(data.response == 202){
                        window.location.href = 'home.php';
                    } 
                    else if(data.response == 500){
                        swal("Invalid!", data.message +"!", "warning");
                    } 
                    else {
                        swal("Failed!", data.message +"!", "error");
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
            checkAuth();
            
        }
    }

});

const btnUpdate = document.getElementById('updateBtn');
btnUpdate?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");
    } else{
        const valid = validateUpdateForm();
        console.log(valid);
        if(valid){
            //alert("submit");
            const updatePatient = () => {
                const form = document.getElementById('update-form');
                const emailInput = document.getElementById('update-email');
                emailInput.disabled = false;
                const formData = new FormData(form);
                emailInput.disabled = true;
                fetch('functions/updateUserInfo.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log('Success:', data);
                    if(data.response == 200){
                        swal("Updated!", "Your informations are updated successfully.", "success");
                    }
                    else if(data.response == 400){
                        swal("Error!", "All fields are required.", "error");
                    }
                    else if(data.response == 500){
                        swal("Error!", "Something Went Wrong", "error");
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
            updatePatient();
        }
    }
});






const getPatientApp = async() => {
    if(TableData){ // here to check that we are in page user
        const res = await fetch('functions/getPatientAppData.php');
        const received_data = await res.json();
        TableData.innerHTML = "";
        console.log('App records:',received_data);
        received_data.forEach(user => {
            TableData.innerHTML += `<tr>
                                        <td>${user.doctor}</td>
                                        <td>${user.date}</td>
                                        <td>${user.time}</td>
                                        <td>${user.status}</td>
                                        <td><button id="cancel-btn" onclick ='del(${user.id})'>Cancel</button></td>
                                    </tr>`
    
        });
    }
}

function del(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            fetch('functions/deleteAppointmentByPatient.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json, charset=UTF-8'
                }
            })
            .then((response) => response.json())
            .then((data) => {
                if(data.response == 200){
                    swal("Deleted", "Your appointment deleted successfully.", "success");
                    
                }
                else if(data.response == 500){
                    swal("Error!", "could not delete from database.", "error");
                } 
            })
            getPatientApp();
        }
    });
}
const getPatientProfile = async() => {
    if(updatePhone){ // here to check that we are in page user (we can put any elemet in page user)
        const response      = await fetch('functions/getPatientInfo.php');
        const res = await response.json();
        console.log('patient info record:', res);
        if (res.length > 0) {
            res.forEach( patient => {
                updateFname.value = patient.firstName;
                updateLname.value = patient.lastName;
                updateEmail.value = patient.email;
                updateDate.value  = patient.date;
                updatePhone.value= patient.phoneNumber;
                if (patient.gender === "male") {
                    updateGenderM.checked = true;
                } else {
                    updateGenderF.checked = true;
                }
                updateBloodType.value = patient.bloodType;
            });
        } else {
            console.log('No patient data received.');
        }
    }
}



const btn_changePassword = document.getElementById('changeBtn');
btn_changePassword?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");
    }else{
        const valid = validatePasswordForm();
        console.log(valid);
        if(valid){
            const changePassword = () => {
                //alert('change Btn');
                fetch('functions/changePatientPassword.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        currentPassword: currentPasswordInput.value,
                        newPassword: newPasswordInput.value,
                        confirmPassword: cPasswordInput.value
                    }),
                    headers: {
                        'Content-type': 'application/json; charset=UTF-8'
                    }
                })
                .then((response) => response.json())
                .then((data) => {
                    if(data.response == 200){
                        swal("Error!", "All fields are required.", "error");
                    }
                    else if(data.response == 300){
                        swal("Error!", "All fields must be validated.", "error");
                    }
                    else if(data.response == 400){
                        swal("Error!", "New password and confirm password do not match.", "error");
                    }
                    else if(data.response == 500){
                        swal("Updated!", "Password updated successfully.", "success");
                        passwordForm.reset();
                    }
                    else if(data.response == 600){
                        swal("Error!", "Please enter the old password correct.", "error");
                    }
                })
                .catch(error => {
                    console.error('Something went wrong:', error);
                })
            }
            changePassword();
        }
    }
});

//Forms Validation Functions
/* signinForm?.addEventListener('submit', (e) => { 
    //prevents the default form submission behavior 
    const isValid = validateSigninForm();

    // If validation fails, prevent the default form submission
    if (!isValid) {
        e.preventDefault();
    }
});
 */
/*document.getElementById('sign-in').addEventListener('submit', (e) => {
    e.preventDefault();

    var formData = new FormData(document.getElementById('sign-in'));
    
    // Log the form data for debugging purposes
    for (var pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
    }

    $.ajax({
        method: 'POST',
        url: './test.php',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success: function(response) {
            // Handle success, you can log the response for debugging
            console.log(response);
            // Redirect to a new page or handle the response accordingly
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(xhr.responseText);
        }
    });
});
*/
signupForm?.addEventListener('submit', (e) => { 
    //prevents the default form submission behavior 
    const isValid = validateSignupForm();

    // If validation fails, prevent the default form submission
    if (!isValid) {
        e.preventDefault();
    }
});

/*updateForm?.addEventListener('submit', (e) => { 
    const isValid = validateUpdateForm();

    // If validation fails, prevent the default form submission
    if (!isValid) {
        e.preventDefault();
    }
});

passwordForm?.addEventListener('submit', (e) => { 
    const isValid = validatePasswordForm();
    // If validation fails, prevent the default form submission
    if (!isValid ) {
        e.preventDefault();
    }
});*/



//Check if the Email is Empty
function isEmailEmpty(emailInput,emailMsg){
    email = emailInput.value;
    if(email === ""){
        emailMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        return false;
    }else{
        return true;
    }
}

emailInput1?.addEventListener('focusout', function(){
    isEmailEmpty(emailInput1,emailMsg1);
});
emailInput2?.addEventListener('focusout',function(){
    isEmailEmpty(emailInput2,emailMsg2);
});
updateEmail?.addEventListener('focusout', function(){
    isEmailEmpty(updateEmail,emailMessage);
});

//Email Structure Validation

function validateEmail(emailInput,emailMsg){
    const email = emailInput.value;
    if(!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){
        emailMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Invalid Email';
        return false;
    }
    emailMsg.innerHTML = '';
    return true;
}

emailInput1?.addEventListener('input', function(){
    validateEmail(emailInput1,emailMsg1);
});
emailInput2?.addEventListener('input',function(){
    validateEmail(emailInput2,emailMsg2);
});
updateEmail?.addEventListener('input', function(){
    validateEmail(updateEmail,emailMessage);
});


//Check if the Password is Empty

function isPasswordEmpty(pwdInput,pwdMsg){
    const pwd = pwdInput.value;
    if(pwd === ""){
        pwdMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        return false;
    }else{
        return true;
    }
}

pwdInput1?.addEventListener('input',function(){
    const pwd = pwdInput1.value;
    if(pwd === ""){
        pwdMsg1.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        return false;
    }else{
        pwdMsg1.innerHTML = '';
        return true;
    }
});
pwdInput2?.addEventListener('focusout',function(){
    isPasswordEmpty(pwdInput2,pwdMsg2);
});
confirmInput?.addEventListener('focusout',function(){
    isPasswordEmpty(confirmInput,confirmMsg);
});
currentPasswordInput?.addEventListener('input',function(){
    const pwd = currentPasswordInput.value;
    if(pwd === ""){
        currentMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        return false;
    }else{
        currentMsg.innerHTML = '';
        return true;
    
    }
});
newPasswordInput?.addEventListener('focusout',function(){
    isPasswordEmpty(newPasswordInput,newMsg);
});
cPasswordInput?.addEventListener('focusout',function(){
    isPasswordEmpty(cPasswordInput,cMsg);
});


//Password Structure Validation

function validatePwd(pwdInput,pwdMsg){
    const pwd = pwdInput.value;
    if(!pwd.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)){
        pwdMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one digit.';
        return false;
    }
    pwdMsg.innerHTML = '';
    return true;
}

/*pwdInput1?.addEventListener('input',function(){
    validatePwd(pwdInput1,pwdMsg1);
});*/
pwdInput2?.addEventListener('input',function(){
    validatePwd(pwdInput2,pwdMsg2);
});
/*confirmInput?.addEventListener('input',function(){
    validatePwd(confirmInput,confirmMsg);
});*/
/*currentPasswordInput?.addEventListener('input',function(){
    validatePwd(currentPasswordInput,currentMsg);
});*/
newPasswordInput?.addEventListener('input',function(){
    validatePwd(newPasswordInput,newMsg);
});
/*cPasswordInput?.addEventListener('input',function(){
    validatePwd(cPasswordInput,cMsg);
});*/

// Compare Password and Confirm password

function comparePasswords(firstPasswordInput,SecondPasswordInput,secondMsg){
    const firstPassword = firstPasswordInput.value;
    const secondPassword = SecondPasswordInput.value;

    if(firstPassword !== secondPassword){
        secondMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Password Confirmation is Incorrect.'
        return false;
    }else{
        secondMsg.innerHTML = '';
        return true;
    }
}

confirmInput?.addEventListener('input',function(){
    comparePasswords(pwdInput2,confirmInput,confirmMsg);
});
cPasswordInput?.addEventListener('input',function(){
    comparePasswords(newPasswordInput,cPasswordInput,cMsg);
});


//Check if the Name is Empty

function isNameEmpty(nameInput,nameMessage){
    const name = nameInput.value;
    if(name === ''){
        nameMessage.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        return false;
    }else{
        return true;
    }
}

fnameInput?.addEventListener('focusout',function(){
    isNameEmpty(fnameInput,nameMsg);
});
lnameInput?.addEventListener('focusout',function(){
    isNameEmpty(lnameInput,nameMsg2);
});
updateFname?.addEventListener('focusout',function(){
    isNameEmpty(updateFname,firstMsg);
});
updateLname?.addEventListener('focusout',function(){
    isNameEmpty(updateLname,lastMsg);
});

//Name Structure Validation

function validateName(nameInput,nameMessage){
    const name = nameInput.value;
    
    if(!name.match(/^[a-zA-Z]+$/) || name.length<=3){
        nameMessage.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Must contain only and at least 3 letters.';
        return false;
    }
    nameMessage.innerHTML = '';
    return true;
}

fnameInput?.addEventListener('input',function(){
    validateName(fnameInput,nameMsg);
});
lnameInput?.addEventListener('input',function(){
    validateName(lnameInput,nameMsg2);
});
updateFname?.addEventListener('input',function(){
    validateName(updateFname,firstMsg);
});
updateLname?.addEventListener('input',function(){
    validateName(updateLname,lastMsg);
});


//Phone Structure Validation

function validatePhone(phone,msg){
    const nb = phone.value;
    if(nb.length == 8 || nb.length == 0){
        msg.innerHTML = '';
        return true;
    }else{
        msg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Phone number should be 8 characters';
        return false;
    }
    
}

phoneInput?.addEventListener('input',function(){
    validatePhone(phoneInput,phoneMsg);
});

phoneInput2?.addEventListener('input',function(){
    validatePhone(phoneInput2,phoneMsg2);
});

//Check if Gender is Empty

function genderCheck(){
    if(maleCheck.checked || femaleCheck.checked){
        if(genderMsg){
            genderMsg.innerHTML = '';
        }
        return true;
    }else{
        if(genderMsg){
            genderMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        }
        return false;
    }

}

var maleCheck = document.getElementById('male');
maleCheck?.addEventListener("change", genderCheck);
var femaleCheck = document.getElementById('female');
femaleCheck?.addEventListener("change",genderCheck);

//Check if date is empty

function isDateEmpty(datesInput,msg){
    const date = datesInput.value;
    if(date === ''){
        msg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        return false;
    }else{
        msg.innerHTML = '';
        return true;
    }
}

updateDate?.addEventListener('focusout',function(){
    isDateEmpty(updateDate,dateMessage);
});
dateInput?.addEventListener('input', function(){
    isDateEmpty(dateInput,infoMsg);
});

function validateSigninForm(){
    
    if(isEmailEmpty(emailInput1,emailMsg1) && isPasswordEmpty(pwdInput1,pwdMsg1) && validateEmail(emailInput1,emailMsg1)){
    //    alert('Submitted Successfully');
        return true;
    }else{
        isEmailEmpty(emailInput1,emailMsg1);
        isPasswordEmpty(pwdInput1,pwdMsg1);
        return false;
    }
    
}

function validateSignupForm(){
    
    if(validateEmail(emailInput2,emailMsg2) && validatePwd(pwdInput2,pwdMsg2) && validateName(lnameInput,nameMsg2) && validateName(fnameInput,nameMsg)
     && isEmailEmpty(emailInput2,emailMsg2) && isPasswordEmpty(pwdInput2,pwdMsg2) && isPasswordEmpty(confirmInput,confirmMsg) && isNameEmpty(lnameInput,nameMsg2)
     && isNameEmpty(fnameInput,nameMsg)  && comparePasswords(pwdInput2,confirmInput,confirmMsg) && validatePhone(phoneInput,phoneMsg)
     && isDateEmpty(dateInput,infoMsg) && genderCheck() ){

    //    alert('Submitted Successfully!');
    return true;
    }else{
        isEmailEmpty(emailInput2,emailMsg2);
        isPasswordEmpty(pwdInput2,pwdMsg2);
        isPasswordEmpty(confirmInput,confirmMsg);
        isNameEmpty(lnameInput,nameMsg2);
        isNameEmpty(fnameInput,nameMsg);
        isDateEmpty(dateInput,infoMsg);
        genderCheck();
        return false;
    }
}

function validateUpdateForm(){
    if(validateEmail(updateEmail,emailMessage) && isEmailEmpty(updateEmail,emailMessage) && validateName(updateFname,firstMsg)
    && validateName(updateLname,lastMsg) && isNameEmpty(updateFname,firstMsg) && isNameEmpty(updateLname,lastMsg) && isDateEmpty(updateDate,dateMessage)
    && validatePhone(phoneInput2,phoneMsg2)){
        
       // alert('Submitted Successfully!');
       return true;
    }else{
        isEmailEmpty(updateEmail,emailMessage);
        isNameEmpty(updateFname,firstMsg);
        isNameEmpty(updateLname,lastMsg);
        isDateEmpty(updateDate,dateMessage);
        return false;
    }
}

function validatePasswordForm(){
    if(isPasswordEmpty(currentPasswordInput,currentMsg) && isPasswordEmpty(newPasswordInput,newMsg) && isPasswordEmpty(cPasswordInput,cMsg)
     && validatePwd(newPasswordInput,newMsg) && comparePasswords(newPasswordInput,cPasswordInput,cMsg)){

      //  alert('Submitted successfully!');
      return true;
    }else{
        isPasswordEmpty(currentPasswordInput,currentMsg);
        isPasswordEmpty(newPasswordInput,newMsg);
        isPasswordEmpty(cPasswordInput,cMsg);
        return false;
    }
}