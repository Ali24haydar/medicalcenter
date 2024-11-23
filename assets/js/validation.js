// Function to validate name
const validateNameStructure = (name) => {
    return name.match(/^[a-zA-Z]{3,}$/);
};

// Function to validate email
const validateEmailStructure = (email) => {
    return email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);
};

// Function to validate subject
const validateSubjectStructure = (subject) => {
    return subject.match(/^.{1,}$/);
};

// Function to handle submit email and phone events
function validateInput(input) {
    var lebanesePhoneRegex = /^\d{8}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (lebanesePhoneRegex.test(input)) {
      return input.match(lebanesePhoneRegex);
    }
    if (emailRegex.test(input)) {
        return input.match(emailRegex);
    }
}

//Validation on Focusout Event For Empty Input
const checkFirstname = () => {
    if(fname_input.value === ''){
        if(fnameError){
            fnameError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required*';
            return false;
        }
    }
    else{
        if(fnameError){
            return true;
        }
    }
}
const checkLastname = () => {
    if(lname_input.value === ''){
        if(lnameError){
            lnameError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required*';
            return false;
        }
    }
    else{
        if(lnameError){
            return true;
        }
    }
}
const checkEmail = () => {
    if(email_input.value === ''){
        if(emailError){    
            emailError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i>This field is required*';
            return false;
        }
    }
    else{
        if(emailError){  
            return true;
        }
    }
}
const checkSubject = () => {
    if(subject_input.value === ''){
        if(subjectError){
            subjectError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required*';
            return false;
        }
    }
    else{
        if(subjectError){
            return true;
        }
    }
}
const checkMessage = () => {
    if(message_input.value === ''){
        if(messageError){
            messageError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required*';
            return false;
        }
    }
    else{
        if(messageError){
            return true;
        }
    }
}
const checkEmail2 = () => {
    if(emailText.value == ''){
        if(errorDisplay){
            errorDisplay.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required*';
            return false;
        }
    }
    else{
        if(errorDisplay){
            return true;
        }
    }
}

//Validation on Input Event For Format
const validateFirstname = () => {
    const fnameValue   = fname_input.value;
    if(!validateNameStructure(fnameValue)){
        if(fnameError){
            fnameError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> Must contain only and at least 3 Letters.';
            return false;
        }
    }
    else{
        if(fnameError){
            fnameError.innerHTML   = '<i class="fa-regular fa-circle-check"></i>';
            return true;
        }
    }    
}
const validateLastname = () => {
    const lnameValue   = lname_input.value;
    if(!validateNameStructure(lnameValue)){
        if(lnameError){
            lnameError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> Must contain only and at least 3 Letters.';
            return false;
        }
    }
    else{
        if(lnameError){
            lnameError.innerHTML   = '<i class="fa-regular fa-circle-check"></i>';
            return true;
        }
    }
}
const validateEmail3 = () => {
    const emailValue   = email_input.value;
    if(!validateEmailStructure(emailValue)){
       if(emailError){
            emailError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> example@hotmail.com';
            return false;
        }
    }
    else{
       if(emailError){
            emailError.innerHTML   = '<i class="fa-regular fa-circle-check"></i>';
            return true;
        }
    }
}
const validateSubject = () => {
    const subjectValue   = subject_input.value;
    if(!validateSubjectStructure(subjectValue)){
        if(subjectError){
            subjectError.innerHTML   = '<i class="fa-solid fa-triangle-exclamation"></i> Subject must be clear.';
            return false;
        }
    }
    else{
        if(subjectError){
            subjectError.innerHTML   = '<i class="fa-regular fa-circle-check"></i>';
            return true;
        }
    }
}
const validateMessage = () => {
    if(message_input.value !== ''){
        messageError.innerHTML   = "";
    }
    const message      = message_input.value;
    const required     = 30;
    const left         = required - message.length;
    messageError.innerHTML = '';
    if(left>0){
        messageError.innerHTML = left + ' more characters required. <br> Please the message must be clear.';
        return false;
    }
    else{
        messageError.innerHTML = '<i class="fa-regular fa-circle-check"></i>';
        return true;
    }
}
const validateEmail2 = () => {
    if(!validateInput(emailText.value)){
        if(errorDisplay){
            errorDisplay.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Phone or Email';
            return false;
        }
    }
    else{
        if(errorDisplay){
            errorDisplay.innerHTML = '<i class="fa-regular fa-circle-check"></i>'
            return true;
        }
    }
}
const validateSelect = () => {
    var selectedOption = bloodType.options[bloodType.selectedIndex];
    var selectedValue  = selectedOption.value;
    if(selectedValue == 'Blood-Type'){
        bloodType.style.color = 'red';
        return false;
    }
    else{
        bloodType.style.color = '#0051a1';
        return true;
    }
}

//validates Form 
function validateContactForm(){
    if(checkFirstname() && checkLastname() && checkEmail() && checkSubject() && checkMessage() && validateFirstname() && validateLastname() && validateEmail() && validateSubject() && validateMessage()){
        //alert('Submit Done');
        console.log('Submit Successfully');
        return true;
    }
    else{
        checkFirstname();
        checkLastname();
        checkEmail();
        checkSubject();
        checkMessage();
        //alert('something wrong'); 
        console.log('something wrong');
        return false;
    }
}

// Add event listeners to input fields
fname_input?.addEventListener('focusout', checkFirstname);
lname_input?.addEventListener('focusout', checkLastname);
email_input?.addEventListener('focusout', checkEmail);
subject_input?.addEventListener('focusout', checkSubject);
message_input?.addEventListener('focusout', checkMessage);
emailText?.addEventListener('focusout', checkEmail2);
fname_input?.addEventListener('input', validateFirstname);
lname_input?.addEventListener('input', validateLastname);
email_input?.addEventListener('input', validateEmail3);
subject_input?.addEventListener('input', validateSubject);
message_input?.addEventListener('input', validateMessage);
emailText?.addEventListener('input', validateEmail2);
bloodType?.addEventListener('change', validateSelect);

/*const btn_update = document.getElementById('updateBtn');
btn_update?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");
    }else{
        const valid = validateUpdateForm();
        //console.log(valid);
        if(valid){
            /*console.log(updateFname.value);
            console.log(updateLname.value);
            console.log(updateEmail.value);
            console.log(updatePhone.value);
            console.log(updateDate.value);
            console.log(updateBloodType.value);*/
            /*
            const updatePatient = () => {
                //alert('update Btn');
                const genderRadio = document.querySelector('input[name="gender"]:checked');
                const updateGender = genderRadio ? genderRadio.value : null;
                //console.log(updateGender);
                const requestBody = {
                    updateFname: updateFname.value,
                    updateLname: updateLname.value,
                    updateEmail: updateEmail.value,
                    updatePhone: updatePhone.value,
                    updateDate: updateDate.value,
                    updateGender: updateGender,
                    updateBloodType: updateBloodType.value
                };
                fetch('functions/updatePatientInfo1.php', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json; charset=UTF-8'
                    },
                    body: JSON.stringify(requestBody),
                })
                .then((response) => response.json())
                .then((data) => {
                    //console.log('Received data:', data);

                    // Access individual properties
                    //console.log('updateFname:', data.updateFname);
                    //console.log('updateLname:', data.updateLname);
                    
                    
                    if(data.response == 200){
                        swal("Error!", "All fields are required.", "error");
                    }
                    else if(data.response == 100){
                        swal("Error!", "Something went wrong", "error");
                    }
                    else if(data.response == 500){
                        swal("Updated!", "Your informations are updated successfully.", "success");
                        //passwordForm.reset();
                    }
                })
                .catch(error => {
                    console.error('Something went wrong:', error);
                })
                
            }
            updatePatient();
        }
    }
});
*/

const btnUpdate = document.getElementById('updateBtn');
btnUpdate?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
       event.preventDefault();
        alert("stop submit");
    }else{
        const valid = validateUpdateForm();
        console.log(valid);
        if(valid){
            //alert("submit");
            const updatePatient = () => {
                const form = document.getElementById('update-form');
                const formData = new FormData(form);
                fetch('functions/updateUserInfo.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    //console.log('Success:', data);
                    if(data.response == 200){
                        swal("Error!", "All fields are required.", "error");
                    }
                    else if(data.response == 100){
                        swal("Error!", "Something Went Wrong", "error");
                    }
                    else if(data.response == 500){
                        swal("Updated!", "Your informations are updated successfully.", "success");
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

let sendBtn = document.getElementById("btnSend");
sendBtn?.addEventListener('click', (e) =>{
    if(e.target.type == "submit"){
        e.preventDefault();
    }else{
        /* validateContactForm(); */
        const valid = validateContactForm();
        console.log(valid);
        if(valid){
            const sendMail = async () => {
                const form = document.getElementById('form2');
                const formData = new FormData(form);
            
                await fetch('functions/sendMail.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
                            swal("Thank You!", "Your data has been submitted successfully!", "success");
                            // Clear form inputs
                            form.reset();
                            document.getElementById('fname-error').innerHTML = '';
                            document.getElementById('lname-error').innerHTML = '';
                            document.getElementById('email-error').innerHTML = '';
                            document.getElementById('subject-error').innerHTML='';
                            document.getElementById('message-error').innerHTML='';
            
                        }else if(data.response == 500){
                            swal("Note!", data.message +"!", "warning");
                        }
                        else {
                            swal("Error!", "Failed: " + data.message, "error");
                        }
                        console.log('Success:', data);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
            sendMail();
        }
    }

})

const btn_donate   = document.getElementById('click_donate');
btn_donate?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");
    }else{
        if(!validateSelect() || !checkEmail2() || !validateEmail2()){
            validateSelect();
            checkEmail2();
            //alert("invalid form");
        } else {
            //alert("valid form");
            const addDonation = async() => {
                const data = {
                    email : emailText.value,
                    bloodtype : bloodType.value
                };
                await fetch('functions/donate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json; charset=UTF-8',
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.response === '100') {
                        swal("Thank You", "But you donated to us.", "success");
                        console.log('message', data);
                    }  
                    else if(data.response === '300') {
                        swal("Thank you", "Your data has been submitted successfully!", "success");
                        donateForm.reset();
                        errorDisplay.innerHTML = "";
                        console.log('message', data);
                    }  
                    else if(data.response === '400') {
                        swal("Error", "All fields must be validated", "error");
                    }  
                    else if(data.response === '500') {
                        swal("Error", "Please fill the fields", "error");
                    }  
                })
                .catch((error) => {
                    console.error('Something went wrong:', error);
                });
            }
            addDonation();
        }
    }
});

//validates Form 
function validateContactForm(){
    if(checkFirstname() && checkLastname() && checkEmail() && checkSubject() && checkMessage() && validateFirstname() && validateLastname() && validateEmail() && validateSubject() && validateMessage()){
        //alert('Submit Done');
        console.log('Submit Successfully');
        return true;
    }
    else{
        checkFirstname();
        checkLastname();
        checkEmail();
        checkSubject();
        checkMessage();
        //alert('something wrong'); 
        console.log('something wrong');
        return false;
    }
}

/* $(document).ready(function () {
    $(document).on('click','#btnSend', function (e) {
        e.preventDefault();
        validateContactForm();
        $.ajax({
            method: "POST",
            url: "functions/sendEmail.php",
            data: $('#form2').serialize(),
            success: function (response) {              
                if (response.trim() === '500') {
                    swal("Check!", "All Fileds should required* ", "error");
                }else{
                    swal("Thank You!", "Your data has been submitted successfully!", "success");
                    // Clear form inputs
                    $('#form2')[0].reset();
                    document.getElementById('fname-error').innerHTML = '';
                    document.getElementById('lname-error').innerHTML = '';
                    document.getElementById('email-error').innerHTML = '';
                    document.getElementById('subject-error').innerHTML='';
                    document.getElementById('message-error').innerHTML='';
                }
            },
            error: function () {
                swal("Error!", "Failed to communicate with the server.", "error");
            }
        });
    });
}); */

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



