// Function to validate name
function validateName(name) {
    var nameRegex = /^[a-zA-Z]+$/;
    return nameRegex.test(name);
}

// Function to validate desc
function validateDesc(desc) {
    var descRegex = /^[a-zA-Z\s]+$/;
    return descRegex.test(desc);
}

// Function to validate email
function validateEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to validate password
function validatePass(pass) {
    var passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return passRegex.test(pass);
}

// Function to validate phone
function validatePhone(phone) {
    var lebanesePhoneRegex = /^\d{8}$/;
    /* var lebanesePhoneRegex = /^(?:\+961|0\d{1,2}) \d{3} \d{3}$/; */
    return lebanesePhoneRegex.test(phone);
}

// Function to handle submit Name events mn esm le b3to m ykun fi r2m mtl fname
function validateNameSubmit(name, nameInput, errorName) { 
    if (name == '' || !validateName(name)) { 
        nameInput.classList.add("required");

        if (name == '') {
            errorName.textContent = errorName.className +' required';
            return false;
        } else if (!validateName(name)) {
            errorName.textContent = 'Only letters are allowed.';
            return false;
        }
    }
    return true;
}

// Function to handle submit Name events
function validateAdminNameSubmit(name, nameInput, errorName) {
    let strArray = name.split(" ");
    if (name == '' || !validateDesc(name) || strArray.length !=2) {
        nameInput.classList.add("required");

        if (name == '') {
            errorName.textContent = errorName.className +' required';
            return false;
        } else if (!validateDesc(name)) {
            errorName.textContent = 'Only letters are allowed.';
            return false;
        }else if(strArray.length !=2){
            errorName.textContent = 'Should enter First and last name.';
            return false;
        }
    }
    return true;
}


// Function to handle submit Email events
function validateEmailSubmit(email, emailInput, erroremail) {
    if (email == '' || !validateEmail(email)) {
        emailInput.classList.add("required");

        if (email == '') {
            erroremail.textContent = 'email required';
            return false;
        } else if (!validateEmail(email)) {
            erroremail.textContent = 'Invalid email';
            return false;
        }
    }
    return true;
}

// Function to handle submit Phone events
function validatePhoneSubmit(phone, phoneInput, errorPhone) {
    if (phone == '' || !validatePhone(phone)) {
        phoneInput.classList.add("required");

        if (phone == '') {
            errorPhone.textContent = 'Phone required';
            return false;
        } else if (!validatePhone(phone)) {
            errorPhone.textContent = 'Invalid Phone';
            return false;
        }
    }
    return true;
}

function validatePhoneSubmit2(phone, phoneInput, errorPhone) {
    if (phone != '' && !validatePhone(phone)) {
        phoneInput.classList.add("required");
        errorPhone.textContent = 'Invalid Phone';
        return false;
    }
    return true;
}

// Function to handle submit Password events
function validatePassSubmit(pass, passInput, errorPass) {
    if (pass == '' || !validatePass(pass)) {
        passInput.classList.add("required");

        if (pass == '') {
            errorPass.textContent = 'Password required';
            return false;
        } else if (!validatePass(pass)) {
            errorPass.textContent = 'Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one digit.';
            return false;
        }
    }
    return true;
}

// Function to handle submit ConfPass events
function ConfirmPassSubmit(confPass, confPassInput, pass, errorconfPass) {
    if (confPass == '' || confPass != pass) {
        confPassInput.classList.add("required");

        if (confPass == '') {
            errorconfPass.textContent = 'Confirm Password required';
            return false;
        } else if (confPass != pass) {
            errorconfPass.textContent = 'Password Confirmation Incorrect';
            return false;
        }
    }
    return true;
}

// Function to handle submit Desc events
function validateDescSubmit(name, nameInput, errorName) {
    if (name == '' || !validateDesc(name) || name.length < 5 || name.length > 50) {
        nameInput.classList.add("required");
        errorName.classList.add("count");
        if (name == '') {
            let st = errorName.className.split(" ");
            errorName.textContent =  st[0] +' required';
            return false;
        } else if (!validateDesc(name)) {
            errorName.textContent = 'Only letters are allowed.';
            return false;
        } else if (name.length < 5) {
            errorName.textContent = "min length: 5";
            return false;
        }
        else if (name.length > 50) {
            errorElement.textContent = "max length: 50";
            return false;
        }
    }
    return true;
}

// Function to handle submit SelectBOX events iza m 7adadet shu bdi error
function validateSelectSubmit(selectInput, errorselect) {
    var selectedOption = selectInput.options[selectInput.selectedIndex];
    var selectedValue = selectedOption.value;

    if (selectedValue == '' || selectInput.selectedIndex == 0) {
        

        selectInput.classList.add("required");
        errorselect.textContent = selectInput.options[0].value +" required";
        return false;
    }
    return true;
}

// Function to handle submit DOB events
function validateDOBSubmit(dobInput, errorDob) {
    var dobValue = dobInput.value;
    var dobDate = new Date(dobValue);
    var currentDate = new Date();

    if (isNaN(dobDate) || dobDate > currentDate) {
        dobInput.classList.add("required");
        errorDob.classList.add("count");

        if(isNaN(dobDate)){
            errorDob.textContent = "Date of Birth required";
            return false;
        }else if(dobDate > currentDate){
            errorDob.textContent = "Invalid Date of Birth";
            return false;
        }
        
    } 
    return true;
}

// Function to handle submit GENDER events
function validateGenderSubmit(maleInput, femaleInput) {

    if (!maleInput.checked && !femaleInput.checked) {
        alert("check Gender");
        return false;
    } 
    return true;
}

// Function to handle submit NUMBER events
function validateNumberSubmit(numberInput, errorNumber) {

    if (numberInput.value == '' || numberInput.value <= 0) {
        numberInput.classList.add("required");
        errorNumber.textContent = "Number required";
        return false;
    } 
    return true;
}

// Function to handle submit TIME events
function validateTimeSubmit(timeInput, errorTime) {

    if (timeInput.value == '') {
        timeInput.classList.add("required");
        errorTime.classList.add("count");
        errorTime.textContent = "Time required";
        return false;
    } 
    return true;
}

// Function to validate file image
function validateFile() {
    var fileInput = document.getElementById('clinicImg');
    var errorElement = document.getElementById('clinicImgError');

    if (fileInput.files.length <= 0) {
        fileInput.classList.add("required");
        errorElement.classList.add("count");
        errorElement.textContent = 'image required';
        return false;
    } else if (fileInput.files.length > 0) {
        var allowedTypes = ['image/jpeg', 'image/png'];
        var fileType = fileInput.files[0].type;

        if (allowedTypes.indexOf(fileType) === -1) {
            fileInput.classList.add("required");
            errorElement.classList.add("count");
            errorElement.textContent = 'Invalid file type. Please choose a valid image file.';
            return false;
        }
    }
    errorElement.textContent = '';
    fileInput.classList.remove("required");
    errorElement.classList.remove("count");
    return true;
}

// Function to validate file2 icon
function validateFile2() {
    var fileInput = document.getElementById('clinicIcon');
    var errorElement = document.getElementById('clinicIconError');

    if (fileInput.files.length <= 0) {
        fileInput.classList.add("required");
        errorElement.classList.add("count");
        errorElement.textContent = 'icon required';
        return false;
    } else if (fileInput.files.length > 0) {
        var allowedTypes = ['image/jpeg', 'image/png'];
        var fileType = fileInput.files[0].type;

        if (allowedTypes.indexOf(fileType) === -1) {
            fileInput.classList.add("required");
            errorElement.classList.add("count");
            errorElement.textContent = 'Invalid file type. Please choose a valid image file.';
            return false;
        }
    }
    errorElement.textContent = '';
    fileInput.classList.remove("required");
    errorElement.classList.remove("count");
    return true;
}


// Function to validate Edit file 
function validateFileEdit() {
    var fileInput = document.getElementById('editClinicImg');
    var errorElement = document.getElementById('editClinicImgError');

    if (fileInput.files.length > 0) {
        var allowedTypes = ['image/jpeg', 'image/png'];
        var fileType = fileInput.files[0].type;

        if (allowedTypes.indexOf(fileType) === -1) {
            fileInput.classList.add("required");
            errorElement.classList.add("count");
            errorElement.textContent = 'Invalid file type. Please choose a valid image file.';
            return false;
        }
    }
    errorElement.textContent = '';
    fileInput.classList.remove("required");
    errorElement.classList.remove("count");
    return true;
}

// Function to validate Edit file 2
function validateFileEdit2() {
    var fileInput = document.getElementById('editClinicIcon');
    var errorElement = document.getElementById('editClinicIconError');

    if (fileInput.files.length > 0) {
        var allowedTypes = ['image/jpeg', 'image/png'];
        var fileType = fileInput.files[0].type;

        if (allowedTypes.indexOf(fileType) === -1) {
            fileInput.classList.add("required");
            errorElement.classList.add("count");
            errorElement.textContent = 'Invalid file type. Please choose a valid image file.';
            return false;
        }
    }
    errorElement.textContent = '';
    fileInput.classList.remove("required");
    errorElement.classList.remove("count");
    return true;
}

// Function to handle input NAME events
function handleInputNameEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (inputElement.value == '' || !validateName(inputElement.value)) {
        inputElement.classList.add("required");

        if (inputElement.value == '') {
            errorElement.textContent = errorElement.className +' required';
        } else if (!validateName(inputElement.value)) {
            errorElement.textContent = 'Only letters are allowed.';
        }

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = errorElement.className;
    }
}

// Function to handle input Admin NAME events
function handleInputAdminNameEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    var strArray= inputElement.value.split(" ");

    if (inputElement.value == '' || !validateDesc(inputElement.value) || strArray.length !=2) {
        inputElement.classList.add("required");

        if (inputElement.value == '') {
            errorElement.textContent = errorElement.className +' required';
        } else if (!validateDesc(inputElement.value)) {
            errorElement.textContent = 'Only letters are allowed.';
        }else if(strArray.length !=2){
            errorElement.textContent = 'Should enter First and last name.';
        }

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = errorElement.className;
    }
}

// Function to handle input EMAIL events
function handleInputEmailEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (inputElement.value == '' || !validateEmail(inputElement.value)) {
        inputElement.classList.add("required");

        if (inputElement.value == '') {
            errorElement.textContent = 'Email required';
        } else if (!validateEmail(inputElement.value)) {
            errorElement.textContent = 'Invalid email';
        }

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = 'Email';
    }
}

// Function to handle input PHONE events
function handleInputPhoneEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (inputElement.value == '' || !validatePhone(inputElement.value)) {
        inputElement.classList.add("required");

        if (inputElement.value == '') {
            errorElement.textContent = 'Phone required';
        } else if (!validatePhone(inputElement.value)) {
            errorElement.textContent = 'Invalid Phone';
        }

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = 'Phone';
    }
}

function handleInputPhoneEvent2(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (!validatePhone(inputElement.value)) {
        inputElement.classList.add("required");

        errorElement.textContent = 'Invalid Phone';

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = 'Phone';
    }

    if(inputElement.value == ""){
        inputElement.classList.remove("required");
        errorElement.textContent = 'Phone';
    }
}

// Function to handle input PASSWORD events
function handleInputPassEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (inputElement.value == '' || !validatePass(inputElement.value)) {
        inputElement.classList.add("required");

        if (inputElement.value == '') {
            errorElement.textContent = 'Password required';
        } else if (!validatePass(inputElement.value)) {
            errorElement.textContent = 'Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one digit.';
        }

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = 'Password';
    }
}

// Function to handle input CONFPASS events
function handleInputConfPassEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);
    let passdId = inputElement.id;
    let confirm = "Confirm";
    let n = passdId.length - confirm.length;
    let string = passdId.substring(0, n);
    var passElement = document.getElementById(string);
    let pass = passElement.value;

    if(pass == ''){
        var errorPassElement = document.getElementById(string + "Error");
        passElement.classList.add("required");
        errorPassElement.textContent = 'Password required';
        inputElement.classList.add("required");
        errorElement.textContent = 'Enter Password First';
    }else{
        if (inputElement.value == '' || inputElement.value != pass) {
            inputElement.classList.add("required");
    
            if (inputElement.value == '') {
                errorElement.textContent = 'Confirm Password';
            } else if (inputElement.value != pass) {
                errorElement.textContent = 'Password Confirmation Incorrect';
            }
    
        } else {
            inputElement.classList.remove("required");
            errorElement.textContent = 'Confirm Password';
        }
    }
}

// Function to handle input DESC events
function handleInputDescEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (inputElement.value == '' || !validateDesc(inputElement.value) || inputElement.value.length < 5 || inputElement.value.length >= 50) {
        inputElement.classList.add("required");
        errorElement.classList.add("count");

        if (inputElement.value == '') {
            let st = errorName.className.split(" ");
            errorElement.textContent = st[0] +' required';
        } else if (!validateDesc(inputElement.value)) {
            errorElement.textContent = 'Only letters are allowed.';
        } else if (inputElement.value.length < 5) {
            errorElement.textContent = "min length: 5";
        }
        else if (inputElement.value.length >= 50) {
            errorElement.textContent = "max length: 50";
        }

    } else if (inputElement.value.length < 50 && (inputElement.value.length) > 5) {
        errorElement.classList.add("count");
        errorElement.textContent = " counter:" + inputElement.value.length;
    }
    else {
        inputElement.classList.remove("required");
        errorElement.classList.remove("count");
    }

}

// Function to handle CHANGE SELECTBOX events
function handleSelectEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    var selectedOption = inputElement.options[0];
    var selectedValue = selectedOption.value;

    if (inputElement.value == '' || inputElement.value == selectedValue) {
        inputElement.classList.add("required");
        errorElement.textContent = selectedValue +' required';

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = selectedValue;
    }
}

// Function to handle input DOB events
function handleDOBEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    var dobDate = new Date(inputElement.value);
    var currentDate = new Date();

    if (isNaN(dobDate) || dobDate > currentDate) {
        inputElement.classList.add("required");
        errorElement.classList.add("count");
        errorElement.textContent = 'Date of Birth required';

        if(isNaN(dobDate)){
            errorElement.textContent = "Date of Birth required";
        }else if(dobDate > currentDate){
            errorElement.textContent = "Invalid Date of Birth";
        }

    } else {
        inputElement.classList.remove("required");
        errorElement.classList.remove("count");
        errorElement.textContent = 'DOB';
    }
}

// Function to handle input URGENT BT events
function handleInputNumberUrgentBTEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (inputElement.value == '' || inputElement.value <= 0) {
        inputElement.classList.add("required");
        errorElement.textContent = 'Number required';

    } else {
        inputElement.classList.remove("required");
        errorElement.textContent = 'Number Needed';
    }
}

// Function to handle input TIME events
function handleInputTimeEvent(event) {
    var inputElement = event.target;
    var errorElementId = inputElement.id + 'Error';
    var errorElement = document.getElementById(errorElementId);

    if (inputElement.value == '') {
        inputElement.classList.add("required");
        errorElement.classList.add("count");
        errorElement.textContent = 'Time required';

    } else {
        errorElement.classList.remove("count");
        inputElement.classList.remove("required");
        errorElement.textContent = 'Time';
    }
}



// Function to handle input Acount CHECk events
function handleClosedCheckEvent(event) {
    var inputElement = event.target;

    if(inputElement.checked){
        WHFromInput.classList.remove("required");
        WHFromInput.disabled = true;
        WHFromInput.value = "";
        document.getElementById("WHFromError").classList.remove("count");
        document.getElementById("WHFromError").textContent = "From";

        WHTOInput.classList.remove("required");
        WHTOInput.disabled = true;
        WHTOInput.value = "";
        document.getElementById("WHTOError").classList.remove("count");
        document.getElementById("WHTOError").textContent = "To";
    }else{
        WHFromInput.disabled = false;
        WHTOInput.disabled = false;
    }
}

// Function to handle input available CHECk events
function handleAvailableCheckEvent(event) {
    var inputElement = event.target;

    if(!inputElement.checked){
        DWHFromInput.classList.remove("required");
        DWHFromInput.disabled = true;
        DWHFromInput.value = "";
        document.getElementById("DWHFromError").classList.remove("count");
        document.getElementById("DWHFromError").textContent = "From";

        DWHTOInput.classList.remove("required");
        DWHTOInput.disabled = true;
        DWHTOInput.value = "";
        document.getElementById("DWHTOError").classList.remove("count");
        document.getElementById("DWHTOError").textContent = "To";
    }else{
        DWHFromInput.disabled = false;
        DWHTOInput.disabled = false;
    }
}

// Function to handle input Acount CHECk events
function handleAvailableExcepCheckEvent(event) {
    var inputElement = event.target;

    if(!inputElement.checked){
        exceptionFromInput.classList.remove("required");
        exceptionFromInput.disabled = true;
        exceptionFromInput.value = "";
        document.getElementById("exceptionFromError").classList.remove("count");
        document.getElementById("exceptionFromError").textContent = "From";

        exceptionTOInput.classList.remove("required");
        exceptionTOInput.disabled = true;
        exceptionTOInput.value = "";
        document.getElementById("exceptionTOError").classList.remove("count");
        document.getElementById("exceptionTOError").textContent = "To";
    }else{
        exceptionFromInput.disabled = false;
        exceptionTOInput.disabled = false;
    }
}



// Add event listeners to input fields
//add clinic form
var clinicNameInput = document.getElementById('clinicName');
clinicNameInput?.addEventListener('input', handleInputNameEvent);

var clinicDescInput = document.getElementById('clinicDesc');
clinicDescInput?.addEventListener('input', handleInputDescEvent);

var clinicImgInput = document.getElementById('clinicImg');
var errorImg = document.getElementById('clinicImgError');
clinicImgInput?.addEventListener("change", validateFile);

var clinicIconInput = document.getElementById('clinicIcon');
var errorIcon = document.getElementById('clinicIconError');
clinicIconInput?.addEventListener("change", validateFile2);

//edit clinic form
var editClinicNameInput = document.getElementById('editClinicName');
editClinicNameInput?.addEventListener('input', handleInputNameEvent);

var editClinicDescInput = document.getElementById('editClinicDesc');
editClinicDescInput?.addEventListener('input', handleInputDescEvent);

var editClinicImgInput = document.getElementById('editClinicImg');
var errorImg = document.getElementById('editClinicImgError');
editClinicImgInput?.addEventListener("change", validateFileEdit);

var editClinicIconInput = document.getElementById('editClinicIcon');
var errorIcon = document.getElementById('editClinicIconError');
editClinicIconInput?.addEventListener("change", validateFileEdit2);

//add doctor form
var doctorFNInput = document.getElementById('doctorFN');
doctorFNInput?.addEventListener('input', handleInputNameEvent);

var doctorLNInput = document.getElementById('doctorLN');
doctorLNInput?.addEventListener('input', handleInputNameEvent);

var doctorEmailInput = document.getElementById('doctorEmail');
doctorEmailInput?.addEventListener('input', handleInputEmailEvent);

var doctorPhoneInput = document.getElementById('doctorPhone');
doctorPhoneInput?.addEventListener('input', handleInputPhoneEvent);

var doctorClinicInput = document.getElementById('doctorClinic');
doctorClinicInput?.addEventListener('change', handleSelectEvent);

var doctorPassInput = document.getElementById('doctorPass');
doctorPassInput?.addEventListener('input', handleInputPassEvent);

var doctorPassConfirmInput = document.getElementById('doctorPassConfirm');
doctorPassConfirmInput?.addEventListener('input', handleInputConfPassEvent);

//Edit doctor form
var editDoctorFNInput = document.getElementById('editDoctorFN');
editDoctorFNInput?.addEventListener('input', handleInputNameEvent);

var editDoctorLNInput = document.getElementById('editDoctorLN');
editDoctorLNInput?.addEventListener('input', handleInputNameEvent);

var editDoctorEmailInput = document.getElementById('editDoctorEmail');
editDoctorEmailInput?.addEventListener('input', handleInputEmailEvent);

var editDoctorPhoneInput = document.getElementById('editDoctorPhone');
editDoctorPhoneInput?.addEventListener('input', handleInputPhoneEvent);

var editDoctorClinicInput = document.getElementById('editDoctorClinic');
editDoctorClinicInput?.addEventListener('change', handleSelectEvent);

//add patient form
var patientFNInput = document.getElementById('patientFN');
patientFNInput?.addEventListener('input', handleInputNameEvent);

var patientLNInput = document.getElementById('patientLN');
patientLNInput?.addEventListener('input', handleInputNameEvent);

var patientMaleCheck = document.getElementById('male');
var patientFemaleCheck = document.getElementById('female');


var patientDOBInput = document.getElementById('patientDOB');
patientDOBInput?.addEventListener('input', handleDOBEvent);

var patientBloodTypeInput = document.getElementById('patientBT');


var patientEmailInput = document.getElementById('patientEmail');
patientEmailInput?.addEventListener('input', handleInputEmailEvent);

var patientPhoneInput = document.getElementById('patientPhone');
patientPhoneInput?.addEventListener('input', handleInputPhoneEvent2);

var patientPassInput = document.getElementById('patientPass');
patientPassInput?.addEventListener('input', handleInputPassEvent);

var patientPassConfirmInput = document.getElementById('patientPassConfirm');
patientPassConfirmInput?.addEventListener('input', handleInputConfPassEvent);

//add Urgent bloodType form
var urgentBTInput = document.getElementById('urgentBT');
urgentBTInput?.addEventListener('change', handleSelectEvent);

var urgentBTNInput = document.getElementById('urgentBTN');
urgentBTNInput?.addEventListener('input', handleInputNumberUrgentBTEvent);

//admin settings form
var adminNameInput = document.getElementById('signup-name');
adminNameInput?.addEventListener('input', handleInputAdminNameEvent);

var adminEmailInput = document.getElementById('signup-email');
adminEmailInput?.addEventListener('input', handleInputEmailEvent);

var adminCurrentPassInput = document.getElementById('signup-Currentpassword');
adminCurrentPassInput?.addEventListener('input', handleInputPassEvent);

var adminPassInput = document.getElementById('signup-password');
adminPassInput?.addEventListener('input', handleInputPassEvent);

var adminPassConfirmInput = document.getElementById('signup-passwordConfirm');
adminPassConfirmInput?.addEventListener('input', handleInputConfPassEvent);

//add center working hours form
var WHDayInput = document.getElementById('WHDay');
WHDayInput?.addEventListener('change', handleSelectEvent);

var WHFromInput = document.getElementById('WHFrom');
WHFromInput?.addEventListener('input', handleInputTimeEvent);

var WHTOInput = document.getElementById('WHTO');
WHTOInput?.addEventListener('input', handleInputTimeEvent);

var WHClosedCheck = document.getElementById('closed');
WHClosedCheck?.addEventListener("change",handleClosedCheckEvent);


var DWHDayInput = document.getElementById('DWHDay');
DWHDayInput?.addEventListener('change', handleSelectEvent);

var DWHFromInput = document.getElementById('DWHFrom');
DWHFromInput?.addEventListener('input', handleInputTimeEvent);

var DWHTOInput = document.getElementById('DWHTO');
DWHTOInput?.addEventListener('input', handleInputTimeEvent);

var DWHAvailableCheck = document.getElementById('available');
DWHAvailableCheck?.addEventListener("change",handleAvailableCheckEvent);

//add exception working hours form
var exceptionDayInput = document.getElementById('exceptionDay');
exceptionDayInput?.addEventListener('input', handleInputTimeEvent);

var exceptionFromInput = document.getElementById('exceptionFrom');
exceptionFromInput?.addEventListener('input', handleInputTimeEvent);

var exceptionTOInput = document.getElementById('exceptionTO');
exceptionTOInput?.addEventListener('input', handleInputTimeEvent);

var exceptionAvailableCheck = document.getElementById('availableException');
exceptionAvailableCheck?.addEventListener("change",handleAvailableExcepCheckEvent);

//add reminder form
var reminderInput = document.getElementById('reminderInput');
reminderInput?.addEventListener('input', handleInputDescEvent);

// event lister on Form Buttons
let addClinicFormBtn = document.getElementById("addClinicFormBtn");
addClinicFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let name = clinicNameInput.value;
        let desc = clinicDescInput.value;

        let errorName = document.getElementById("clinicNameError");
        let errorDesc = document.getElementById("clinicDescError");

        validateNameSubmit(name, clinicNameInput, errorName);
        validateDescSubmit(desc, clinicDescInput, errorDesc);
        validateFile();
        validateFile2();

        if (!validateNameSubmit(name, clinicNameInput, errorName) || !validateDescSubmit(desc, clinicDescInput, errorDesc) || !validateFile() || !validateFile2()) {
           
        } else {
          

                const addClinic = async () => {
                    const form = document.getElementById('addClinicForm');
                    const formData = new FormData(form);
                
                    await fetch('functions/addClinic.php', {
                            method: 'POST',
                            body: formData,
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.response == 200) {
            
                                clinicDetails();
                           
                                swal("Success!", data.message, "success");
                
                                clinicNameInput.value = "";
                                clinicDescInput.value = "";
                                document.getElementById('clinicImg').value = "";
                                document.getElementById('clinicIcon').value = "";
                                errorDesc.value = "";
                                clinicDescInput.classList.remove('required');
                                errorDesc.classList.remove("count");
                
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
                addClinic();
        }
    }
});

let editClinicFormBtn = document.getElementById("editClinicFormBtn");
editClinicFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let name = editClinicNameInput.value;
        let desc = editClinicDescInput.value;
    
        let errorName = document.getElementById("editClinicNameError");
        let errorDesc = document.getElementById("editClinicDescError");
    
        validateNameSubmit(name, editClinicNameInput, errorName);
        validateDescSubmit(desc, editClinicDescInput, errorDesc);
        validateFileEdit();
        validateFileEdit2();
    
        if (!validateNameSubmit(name, editClinicNameInput, errorName) || !validateDescSubmit(desc, editClinicDescInput, errorDesc) || !validateFileEdit() || !validateFileEdit2()) {
          
        } else {
          

            const editClinic = async () => {
                const form = document.getElementById('editClinicForm');
                const formData = new FormData(form);
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }
                await fetch('functions/editClinic.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
        
                            clinicDetails();
                           
                            swal("Success!", data.message, "success");
            
                            editClinicNameInput.value = "";
                            editClinicDescInput.value = "";
                            document.getElementById('editClinicImg').value = "";
                            document.getElementById('editClinicIcon').value = "";
                            editClinicDescInput.classList.remove('required');
                            errorDesc.classList.remove("count");


                            document.getElementById('clinicAdd').classList.add('view');
                            document.getElementById('clinicAdd').classList.remove('hide');
                    
                            document.getElementById('clinicEdit').classList.add('hide');
                            document.getElementById('clinicEdit').classList.remove('view');
            
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
            editClinic();
        }
    }
});

let addDoctorFormBtn = document.getElementById("addDoctorFormBtn");
addDoctorFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");//stop submit l2n bdi et7a2a2 abl mn data

    }else{
        let firstName= doctorFNInput.value;
        let lastName= doctorLNInput.value;
        let email = doctorEmailInput.value;
        let phone = doctorPhoneInput.value;
        let password = doctorPassInput.value;
        let confirm = doctorPassConfirmInput.value;
    
        let errorFN = document.getElementById("doctorFNError");
        let errorLN = document.getElementById("doctorLNError");
        let errorEmail = document.getElementById("doctorEmailError");
        let errorPhone = document.getElementById("doctorPhoneError");
        let errorClinic = document.getElementById("doctorClinicError");
        let errorPass = document.getElementById("doctorPassError");
        let errorPassConfirm = document.getElementById("doctorPassConfirmError");
    
        validateNameSubmit(firstName, doctorFNInput, errorFN);
        validateNameSubmit(lastName, doctorLNInput, errorLN);
        validateEmailSubmit(email, doctorEmailInput, errorEmail);
        validatePhoneSubmit(phone, doctorPhoneInput, errorPhone);
        validatePassSubmit(password, doctorPassInput, errorPass);
        ConfirmPassSubmit(confirm, doctorPassConfirmInput,password, errorPassConfirm);
        validateSelectSubmit(doctorClinicInput, errorClinic);
    
        if (!validateNameSubmit(firstName, doctorFNInput, errorFN) || !validateNameSubmit(lastName, doctorLNInput, errorLN) || !validateEmailSubmit(email, doctorEmailInput, errorEmail) || !validatePhoneSubmit(phone, doctorPhoneInput, errorPhone) || !validatePassSubmit(password, doctorPassInput, errorPass) || !ConfirmPassSubmit(confirm, doctorPassConfirmInput,password, errorPassConfirm) || !validateSelectSubmit(doctorClinicInput, errorClinic)) {
          
        } else {
          

            const addDoctor = async () => {
                const form = document.getElementById('addDoctorForm');
                const formData = new FormData(form);
            
                await fetch('functions/addDoctor.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
        
                            doctorDetails();
                         

                            swal("Success!", data.message, "success");
            
                            doctorFNInput.value = "";
                            doctorLNInput.value = "";
                            doctorEmailInput.value = "";
                            doctorPhoneInput.value = "";
                            doctorPassInput.value = "";
                            doctorPassConfirmInput.value = "";
                            doctorClinicInput.value = "clinic";
            
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
            addDoctor();
            
        }
    }
});

let editDoctorFormBtn = document.getElementById("editDoctorFormBtn");
editDoctorFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let firstName= editDoctorFNInput.value;
        let lastName= editDoctorLNInput.value;
        let email = editDoctorEmailInput.value;
        let phone = editDoctorPhoneInput.value;
    
        let errorFN = document.getElementById("editDoctorFNError");
        let errorLN = document.getElementById("editDoctorLNError");
        let errorEmail = document.getElementById("editDoctorEmailError");
        let errorPhone = document.getElementById("editDoctorPhoneError");
        let errorClinic = document.getElementById("editDoctorClinicError");
    
        validateNameSubmit(firstName, editDoctorFNInput, errorFN);
        validateNameSubmit(lastName, editDoctorLNInput, errorLN);
        validateEmailSubmit(email, editDoctorEmailInput, errorEmail);
        validatePhoneSubmit(phone, editDoctorPhoneInput, errorPhone);
        validateSelectSubmit(editDoctorClinicInput, errorClinic);
    
        if (!validateNameSubmit(firstName, editDoctorFNInput, errorFN) || !validateNameSubmit(lastName, editDoctorLNInput, errorLN) || !validateEmailSubmit(email, editDoctorEmailInput, errorEmail) || !validatePhoneSubmit(phone, editDoctorPhoneInput, errorPhone) || !validateSelectSubmit(editDoctorClinicInput, errorClinic)) {
          
        } else {
          

            const editDoctor = async () => {
                const form = document.getElementById('editDoctorForm');
                const formData = new FormData(form);
            
                await fetch('functions/editDoctor.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
        
                            specificDrDetails();
                            

                            swal("Success!", data.message, "success");
            
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
            editDoctor();
            
        }
    }

});

let addPatientFormBtn = document.getElementById("addPatientFormBtn");
addPatientFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let firstName= patientFNInput.value;
        let lastName= patientLNInput.value;
      
        let email = patientEmailInput.value;
        let phone = patientPhoneInput.value;
        let password = patientPassInput.value;
        let confirm = patientPassConfirmInput.value;
    
        let errorFN = document.getElementById("patientFNError");
        let errorLN = document.getElementById("patientLNError");
        let errorDOB = document.getElementById("patientDOBError");
        let errorEmail = document.getElementById("patientEmailError");
        let errorPhone = document.getElementById("patientPhoneError");
        
        let errorPass = document.getElementById("patientPassError");
        let errorPassConfirm = document.getElementById("patientPassConfirmError");
    
        validateNameSubmit(firstName, patientFNInput, errorFN);
        validateNameSubmit(lastName, patientLNInput, errorLN);
        validateGenderSubmit(patientMaleCheck,patientFemaleCheck);
        validateDOBSubmit(patientDOBInput, errorDOB);
            validateEmailSubmit(email, patientEmailInput, errorEmail);
            validatePhoneSubmit2(phone, patientPhoneInput, errorPhone);
            validatePassSubmit(password, patientPassInput, errorPass);
            ConfirmPassSubmit(confirm, patientPassConfirmInput,password, errorPassConfirm);
        
    
        if (!validateNameSubmit(firstName, patientFNInput, errorFN) || !validateNameSubmit(lastName, patientLNInput, errorLN) || !validateGenderSubmit(patientMaleCheck,patientFemaleCheck) || !validateDOBSubmit(patientDOBInput, errorDOB) /* || !validateSelectSubmit(patientBloodTypeInput, errorBT)  */
            || 
                !validateEmailSubmit(email, patientEmailInput, errorEmail) 
            || !validatePhoneSubmit2(phone, patientPhoneInput, errorPhone) 
            || !validatePassSubmit(password, patientPassInput, errorPass) 
            || !ConfirmPassSubmit(confirm, patientPassConfirmInput,password, errorPassConfirm) 
            ) {
           
        } else {
            

            const addPatient = async () => {
                const form = document.getElementById('addPatientForm');
                const formData = new FormData(form);
            
                await fetch('functions/addPatient.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
        
                            patientDetails();
                           

                            swal("Success!", data.message, "success");
            
                            patientFNInput.value = "";
                            patientLNInput.value = "";
                            patientDOBInput.value = "";
                            patientEmailInput.value = "";
                            patientPhoneInput.value = "";
                            patientPassInput.value = "";
                            patientPassConfirmInput.value = "";
                            patientMaleCheck.checked = true;
                            
                            document.getElementById('patientBT').value = "BT"
            
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
            addPatient();
            
        }
    }

});

let urgentBloodTypeFormBtn = document.getElementById("urgentBloodTypeFormBtn");
urgentBloodTypeFormBtn?.addEventListener("click",  function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let bloodType= urgentBTInput.value;
        let number= urgentBTNInput.value;
    
        let errorBT= document.getElementById("urgentBTError");
        let errorBTN = document.getElementById("urgentBTNError");
    
        validateSelectSubmit(urgentBTInput, errorBT);
        validateNumberSubmit(urgentBTNInput, errorBTN);
    
        if (!validateSelectSubmit(urgentBTInput, errorBT) || !validateNumberSubmit(urgentBTNInput, errorBTN)) {
            
        } else {
            

           const addUrgentBT = async() => {
            const data = {
                urgentBT: bloodType,
                urgentBTN: number
            };
            await fetch('functions/addUrgentBT.php', {
                    method: 'POST', // or 'PUT'
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json() )
                .then((data) => {
                    if (data.response === 200) {
        
                        bloodDetails();
                        

                        swal("Success!", data.message, "success");
        
                        urgentBTInput.value = "BT";
                        urgentBTNInput.value = "";
        
                    } else {
                        alert("Failed: " + data.message);
                    }
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
            addUrgentBT();
            
        }
    }

});

let adminFormBtn1 = document.getElementById("adminFormBtn1");
adminFormBtn1?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let name= adminNameInput.value;
        let email = adminEmailInput.value;
    
        let errorName= document.getElementById("signup-nameError");
        let errorEmail = document.getElementById("signup-emailError");
    
        validateAdminNameSubmit(name, adminNameInput, errorName);
        validateEmailSubmit(email, adminEmailInput, errorEmail);
    
        if (!validateAdminNameSubmit(name, adminNameInput, errorName) || !validateEmailSubmit(email, adminEmailInput, errorEmail) ) {
           
        } else {
          
            const updateAdminInfo = async () => {
                const form = document.getElementById('adminForm1');
                const formData = new FormData(form);
            
                await fetch('functions/editAdminInfo.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
        
                            

                            swal("Success!", data.message, "success");
                            
                            adminDetails();
            
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
            updateAdminInfo();
            
        }
    }

});

let adminFormBtn2 = document.getElementById("adminFormBtn2");
adminFormBtn2?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let currentPass = adminCurrentPassInput.value;
        let password = adminPassInput.value;
        let confirm = adminPassConfirmInput.value;
    
        let errorCurrPass = document.getElementById("signup-CurrentpasswordError");
        let errorPass = document.getElementById("signup-passwordError");
        let errorPassConfirm = document.getElementById("signup-passwordConfirmError");
    
        validatePassSubmit(currentPass, adminCurrentPassInput, errorCurrPass);
        validatePassSubmit(password, adminPassInput, errorPass);
        ConfirmPassSubmit(confirm, adminPassConfirmInput,password, errorPassConfirm);
    
        if (!validatePassSubmit(currentPass, adminCurrentPassInput, errorCurrPass) || !validatePassSubmit(password, adminPassInput, errorPass) || !ConfirmPassSubmit(confirm, adminPassConfirmInput,password, errorPassConfirm) ) {
           
        } else {
           /*  alert("done"); */
            /* document.getElementById('adminForm2').submit(); */

            const updateAdminPass = async () => {
                const form = document.getElementById('adminForm2');
                const formData = new FormData(form);
            
                await fetch('functions/editAdminPass.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
        
                            

                            swal("Success!", data.message, "success");

                            adminCurrentPassInput.value = "";
                            adminPassInput.value = "";
                            adminPassConfirmInput.value = "";
            
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
            updateAdminPass();
            
        }
    }

});

let manageWHFormBtn = document.getElementById("manageWHFormBtn");
manageWHFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
        let day= WHDayInput.value;
        let TFrom= WHFromInput.value;
        let TTo= WHTOInput.value;
    
        let errorDay= document.getElementById("WHDayError");
        let errorTFrom= document.getElementById("WHFromError");
        let errorTTo= document.getElementById("WHTOError");
    
        validateSelectSubmit(WHDayInput, errorDay);
        if(!WHClosedCheck.checked){
            validateTimeSubmit(WHFromInput, errorTFrom);
            validateTimeSubmit(WHTOInput, errorTTo);
        }
    
        if (!validateSelectSubmit(WHDayInput, errorDay)  || (!WHClosedCheck.checked && ( !validateTimeSubmit(WHFromInput, errorTFrom) || !validateTimeSubmit(WHTOInput, errorTTo)))) {
            
        } else {
           
            const addCenterWH = async () => {
                const form = document.getElementById('manageWHForm');
                const formData = new FormData(form);
            
                await fetch('functions/addCenterWH.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {

                            centerWHDetails();
                            doctorsWHDetails();
        
                           

                            swal("Success!", data.message, "success");

                            WHDayInput.value = "WHDay";
                            WHFromInput.value = "";
                            WHTOInput.value = "";
                            WHClosedCheck.checked = false;
            
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
            addCenterWH();
            
        }
    }

});

let manageDWHFormBtn = document.getElementById("manageDWHFormBtn");
manageDWHFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{
       
    
        let errorDay= document.getElementById("DWHDayError");
        let errorTFrom= document.getElementById("DWHFromError");
        let errorTTo= document.getElementById("DWHTOError");
        
        validateSelectSubmit(DWHDayInput, errorDay);
        if(DWHAvailableCheck.checked){
            validateTimeSubmit(DWHFromInput, errorTFrom);
            validateTimeSubmit(DWHTOInput, errorTTo);
        }
    
        if (!validateSelectSubmit(DWHDayInput, errorDay) || (DWHAvailableCheck.checked && ( !validateTimeSubmit(DWHFromInput, errorTFrom) || !validateTimeSubmit(DWHTOInput, errorTTo)))) {
           
        } else {
            

            const addDrWH = async () => {
                const form = document.getElementById('manageDWHForm');
                const formData = new FormData(form);
            
                await fetch('functions/addDrWH.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.response == 200) {
        
                            

                            swal("Success!", data.message, "success");
            
                            DWHDayInput.value = "WHDay";
                            DWHFromInput.value = "";
                            DWHTOInput.value = "";
            
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
            addDrWH();
            
        }
    }

});

let manageExceptionFormBtn = document.getElementById("manageExceptionFormBtn");
manageExceptionFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{  
        let errorDay= document.getElementById("exceptionDayError");
        let errorTFrom= document.getElementById("exceptionFromError");
        let errorTTo= document.getElementById("exceptionTOError");
    
        validateTimeSubmit(exceptionDayInput,errorDay);
        if(exceptionAvailableCheck.checked){
            validateTimeSubmit(exceptionFromInput, errorTFrom);
            validateTimeSubmit(exceptionTOInput, errorTTo);
        }
    
        if (!validateTimeSubmit(exceptionDayInput,errorDay)  || (exceptionAvailableCheck.checked && ( !validateTimeSubmit(exceptionFromInput, errorTFrom) || !validateTimeSubmit(exceptionTOInput, errorTTo)))) {
           
        } else {
            

           const addDrWException = async () => {
            const form = document.getElementById('manageExceptionForm');
            const formData = new FormData(form);
        
            await fetch('functions/addDrWException.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.response == 200) {
    
                       
                        swal("Success!", data.message, "success");
                        
                        exceptionDetails();

                        exceptionDayInput.value = "";
                        exceptionFromInput.value = "";
                        exceptionTOInput.value = "";
                        exceptionAvailableCheck.checked = true;
        
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
        addDrWException();
            
        }
    }

});

let addReminderFormBtn = document.getElementById("addReminderFormBtn");
addReminderFormBtn?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");

    }else{  
        let errorReminder= document.getElementById("reminderInputError");
        let reminder = reminderInput.value;

        validateDescSubmit(reminder,reminderInput,errorReminder);

        if (!validateDescSubmit(reminder,reminderInput,errorReminder)) {
            
        } else {
            

           const addReminder = async() => {
            const data = {
                reminderInput: reminder
            };
            await fetch('functions/addReminder.php', {
                    method: 'POST', // or 'PUT'
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json() )
                .then((data) => {
                    if (data.response === 200) {
        
                        reminderDetails();


                        swal("Success!", data.message, "success");
        
                        reminderInput.value = "";
        
                    } else {
                        alert("Failed: " + data.message);
                    }
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
            addReminder();
            
        }
    }

});

//display functions
let urgentBTDetails = document.getElementById('urgentBTDetails');
const bloodDetails = async() => {
    if(urgentBTDetails){
        const res = await fetch('functions/displayUrgentBT.php');
        const received_data = await res.json();  
        urgentBTDetails.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(bt => {
                urgentBTDetails.innerHTML += `   
                    <tr>
                    <td class="bloodtype">${bt.bloodType}</td>
                    <td>
                        <p>${bt.number}</p>
                    </td>
                    <td><button class="btn-delete deleteUrgentBTBtn" onclick="delUrgentBT(${bt.urgentBTId})" value="${bt.urgentBTId}"><i class="bx bx-trash-alt"></i><span>Delete</span></button></td>
                    </tr>`;
            });
        }else{
            urgentBTDetails.innerHTML = `<tr><td colspan ='3'>no urgent BT found</td></tr>`;
        }
    }
}
bloodDetails();

let reminders_list = document.getElementById('reminders_list');
const reminderDetails = async() => {
    if(reminders_list){
        const res = await fetch('functions/displayReminders.php');
        const received_data = await res.json();
        reminders_list.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(rm => {
                var formattedDate = formatJsDate(`${rm.date}`);
                reminders_list.innerHTML += `       
                    <li class="completed">
                    <div class="task-title">
                        <i class='bx bx-timer'></i>
                        <div>
                            <p>${rm.reminder}</p>
                            <p>${formattedDate}</p>
                        </div>
                    </div>
                    <button class="delete_reminder_btn" onclick="delReminder(${rm.reminderId})"><i class="bx bx-trash-alt"></i></button>
                </li>`;
            });
        }else{
            reminders_list.innerHTML += `       
            <li class="completed">
            <div class="task-title">
                <div>
                    <p>No Reminders Yet</p>
                    <p>Click On The Plus Sign To Add a Reminder</p>
                </div>
            </div>
            </li>`;
        }
    }
}
reminderDetails();



const recentApptTbody = document.getElementById('recentApptTbody');
const apptDisplay = document.getElementById('apptDisplay');

const filterAppointmentsByDate = (appointments, days) => {
    const currentDate = new Date();
    const startDate = new Date(currentDate);
    let endDate = new Date(currentDate);

    switch (days) {
        case 0: // Today
            startDate.setHours(0, 0, 0, 0);
            endDate.setHours(23, 59, 59, 999);
            break;
        case 1: // Tomorrow
            startDate.setDate(currentDate.getDate() + 1);
            startDate.setHours(0, 0, 0, 0);
            endDate.setDate(currentDate.getDate() + 1);
            endDate.setHours(23, 59, 59, 999);
            break;
        case 7: // Last 7 Days
            startDate.setDate(currentDate.getDate() - 6);
            startDate.setHours(0, 0, 0, 0);
            endDate.setHours(23, 59, 59, 999);
            break;
        case 8: // Next 7 Days
            startDate.setDate(currentDate.getDate() + 1);
            startDate.setHours(0, 0, 0, 0);
            endDate.setDate(currentDate.getDate() + 7);
            endDate.setHours(23, 59, 59, 999);
            break;
        case 30: // All Appointments (for example, consider 30 days for all appointments)
            startDate.setFullYear(2000); // Some arbitrary date in the past
            endDate.setFullYear(3000);   // Some arbitrary date in the future
            break;
        default:
            // For other values, assume it's the number of days to look ahead
            endDate.setDate(currentDate.getDate() + days);
            endDate.setHours(23, 59, 59, 999);
            break;
    }

    return appointments.filter(appointment => {
        const appointmentDate = new Date(appointment.date);
        return appointmentDate >= startDate && appointmentDate <= endDate;
    });
};

const updateAppointmentTable = async () => {
    if (recentApptTbody && apptDisplay) {
        const res = await fetch('functions/displayRecentAppt.php');
        const received_data = await res.json();
        recentApptTbody.innerHTML = '';

        if (received_data !== 'empty') {
            const filterDays = parseInt(apptDisplay.value);
            const filteredAppointments = filterAppointmentsByDate(received_data, filterDays);

            if (filteredAppointments.length > 0) {
                filteredAppointments.forEach(rm => {
                    const formattedTime = formatTimeToAMPM(`${rm.time}`);
                    recentApptTbody.innerHTML += `
                        <tr>
                            <td>
                                <a href="view-patient.php"><p class="name">${rm.PatientName}</p></a>
                            </td>
                            <td class="date">${rm.date}</td>
                            <td>${formattedTime}</td>
                            <td><span class="status ${rm.status}">${rm.status}</span></td>
                        </tr>`;
                });
            } else {
                recentApptTbody.innerHTML = `<tr><td colspan='4'>No appointments found based on the selected filter</td></tr>`;
            }
        } else {
            recentApptTbody.innerHTML = `<tr><td colspan='4'>No appointments found</td></tr>`;
        }
    }
};

updateAppointmentTable();

apptDisplay?.addEventListener('change', () => {
    updateAppointmentTable();
});


let clincTbody = document.getElementById('clincTbody');
const clinicDetails = async() => {
    if(clincTbody){
        const res = await fetch('functions/displayClinics.php');
        const received_data = await res.json();
        clincTbody.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(c => {
               clincTbody.innerHTML += `                        
                <tr>
                <td class="ClinicNameRow"><p class="name">${c.name}</p></td>
                <td class="ClinicImgRow">
                    <a href="../uploads/${c.photo}" class="imageLB"> 
                        <img src="../uploads/${c.photo}" alt="category Image">
                    </a>
                </td>
                <td class="ClinicIconRow">
                    <a href="../uploads/${c.icon}" class="imageLB"> 
                        <img src="../uploads/${c.icon}" alt="category Image">
                    </a>
                </td>
                <td class="action_center">
                    <input  class="desc" type="hidden" value="${c.description}">
                    <button class="btn-edit editClinic" id="edit" value="${c.clinicId}"><i class="bx bx-edit"></i><span>Edit</span></button>
                    <button class="btn-delete deleteClinicBtn" onclick="delClinic(${c.clinicId})"><i class="bx bx-trash-alt"></i><span>Delete</span></button>
                </td>
             </tr>`;
            });

            $('.imageLB').magnificPopup({
                type: 'image',
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                }
            });
        }else{
            clincTbody.innerHTML = `<tr><td colspan ='3'>no clinics found</td></tr>`;
        }
    }
}
clinicDetails();

let doctorClinic_list = document.getElementById('doctorClinic');
let editDoctorClinic_list = document.getElementById('editDoctorClinic');
const clinicsSelectDisplay = async() => {
    if(doctorClinic_list || editDoctorClinic_list){
        const res = await fetch('functions/displayClinics.php');
        const received_data = await res.json();

        if(doctorClinic_list){
            doctorClinic_list.innerHTML = '<option value="clinic">Choose Profession</option>';
            console.log(received_data);
            if(received_data != 'empty'){
                received_data.forEach(clinic => {
                    doctorClinic_list.innerHTML += `       
                    <option value="${clinic.clinicId}">
                    ${clinic.name}
                    </option>   `;
                });
            }
        }else if(editDoctorClinic_list){
            editDoctorClinic_list.innerHTML = '<option value="clinic">Choose Profession</option>';
            console.log(received_data);
            if(received_data != 'empty'){
                received_data.forEach(clinic => {
                    editDoctorClinic_list.innerHTML += `       
                    <option value="${clinic.clinicId}">
                    ${clinic.name}
                    </option>   `;
                });
            }
        }
       
    }
}
clinicsSelectDisplay();

let donorsTbody = document.getElementById('donorsTbody');
const donorDetails = async() => {
    if(donorsTbody){
        const res = await fetch('functions/displayDonors.php');
        const received_data = await res.json();
        donorsTbody.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(dn => {
                let contact= "";
                if(dn.email != null){
                    contact = dn.email;
                }else if(dn.phoneNumber != null){
                    contact = dn.phoneNumber;
                }
               donorsTbody.innerHTML += `              
                <tr>
                <td>
                    <p class="info">${contact}</p>
                </td>
                <td class="bloodtype">${dn.bloodType}</td>
                <td><button class="btn-delete deleteDonorBtn" onclick="delDonor(${dn.donorId})"><i class="bx bx-trash-alt"></i><span>Delete</span></button></td>
                </tr>`;
            });
        }else{
            donorsTbody.innerHTML = `<tr><td colspan ='3'>no donors found</td></tr>`;
        }
    }
}
donorDetails();

let doctorsTbody = document.getElementById('doctorsTbody');
const doctorDetails = async() => {
    if(doctorsTbody){
        
        const data = {
            filterBy: doctorDisplay.value
        };
        const res = await fetch('functions/displayDoctors.php', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        const received_data = await res.json();
        doctorsTbody.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(d => {
                let content = "";
                let profilePic = "docImgPlaceholder.jpg";
                if(d.profilePic != null){
                    profilePic = d.profilePic;
                }
                let clinicName = "undefined";
                if(d.clinicName != null){
                    clinicName = d.clinicName;
                }
               content += `                          
                <tr>
                    <td class="DocProfTD">
                    <a href="../uploads/${profilePic}" class="imageLB"> 
                        <img src="../uploads/${profilePic}" alt="doctor Image">
                    </a>`;

                    if(d.deleted == 0){
                        content += `<a href="edit-doctor.php?doctorId=${d.doctorId}"><p class="doctor">${d.docName}</p></a>`;
                    }else if(d.deleted == 1){
                        content += `<p class="doctor">${d.docName}</p>`;
                    }

                    content += `
                    </td>
                    <td class="clinic">${clinicName}</td>
                    <td>`;

                    if(d.deleted == 0){
                        content += ` <button class="btn-delete deleteDocBtn" onclick="delDoctor(${d.doctorId},${d.userId})"><i class="bx bx-trash-alt"></i><span>Delete</span></button>`;
                    }else if(d.deleted == 1){
                        content += `<button class="btn-delete restoreDocBtn" onclick="resDoctor(${d.doctorId},${d.userId})"><i class="bx bx-refresh"></i><span>Restore</span></button>`;
                    }

                content += `
                </td>
                </tr>`;

                doctorsTbody.innerHTML += content;
            });

            $('.imageLB').magnificPopup({
                type: 'image',
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                }
            });
        }else{
            doctorsTbody.innerHTML = `<tr><td colspan ='3'>no doctors found</td></tr>`;
        }
    }
}
doctorDetails();

doctorDisplay = document.getElementById('doctorDisplay');
doctorDisplay?.addEventListener("change", () => {
    doctorDetails();
});


let exceptionTbody = document.getElementById('exceptionTbody');
const exceptionDetails = async() => {
    if(exceptionTbody){
        let drId = document.getElementById('editDrpageId').value;
        console.log(drId);
        const data = {
            doctorId: drId
        };
        const res = await fetch('functions/displayExceptions.php', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        const received_data = await res.json();
        exceptionTbody.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(ex => {
               let fromHour="00:00:00";
               let toHour = '00:00:00';
                if(ex.fromHour != '00:00:00'){
                   fromHour = formatTimeToAMPM(ex.fromHour);
                }
                if(ex.toHour != '00:00:00'){
                   toHour = formatTimeToAMPM(ex.toHour);
                }
                let content ="";
                content += `          
                <tr>
                <td>${ex.date}</td>
                <td>${fromHour}</td>
                <td>${toHour}</td>
                <td>
                    <label class="check-container" id="check_display"><i class="bx bx-check"></i> `;
                    if(ex.available == 1){
                        content += `<input disabled type="checkbox" name="av" checked>`;
                    }else{
                        content += `<input disabled type="checkbox" name="av">`;
                    }
                    content += ` 
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>
                    <button class="btn-delete deleteWExceptionBtn" onclick='delException("${ex.date}",${drId})'><i class="bx bx-trash-alt"></i><span>Delete</span></button>
                </td>
                </tr>`;

                exceptionTbody.innerHTML += content;
            });
        }else{
            exceptionTbody.innerHTML = `<tr><td colspan ='5'>no exceptions found</td></tr>`;
        }
    }
}
exceptionDetails();

let editDoctorForm = document.getElementById('editDoctorForm');
const specificDrDetails = async() => {
    if(editDoctorForm){
        let drId = document.getElementById('editDrpageId').value;
        console.log(drId);
        const data = {
            doctorId: drId
        };
        const res = await fetch('functions/displayDrInfo.php', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        const received_data = await res.json();
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(dr => {
                document.getElementById("editDoctorFormId").value = drId;
                document.getElementById("editUserId").value = dr.userId;
                document.getElementById('specDocNameDisplay').innerHTML = "dr. " +dr.Fname +" " +dr.Lname;
                editDoctorFNInput.value = dr.Fname;
                editDoctorLNInput.value = dr.Lname;
                editDoctorEmailInput.value = dr.email;
                editDoctorPhoneInput.value = dr.phoneNumber;
                editDoctorClinicInput.value = dr.clinicId;
            });
        }
    }
}
specificDrDetails();

patientsTbody = document.getElementById('patientsTbody');
const patientDetails = async() => {
    if(patientsTbody){
        const data = {
            filterBy: patientDisplay.value
        };
        const res = await fetch('functions/displayPatients.php', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        const received_data = await res.json();
        patientsTbody.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(p => {
                var formattedDate = formatJsDate(`${p.registrationDate}`);
                let content = "";
               content += `                          
               <tr>
               <td>
                   <a href="view-patient.php?userId=${p.userId}">
                       <p class="name">${p.patientName}</p>
                   </a>
               </td>
               <td class="date">${formattedDate}</td>`;


                if(p.restricted == 0){

                    content += `<td><button onclick="delPatient(${p.userId})" class="btn-delete restrictUserBtn"><i class="bx bx-block"></i><span>Restrict</span></button></td>`;

                }else if(p.restricted == 1){

                    content += `<td><button onclick="resPatient(${p.userId})" class="btn-delete restoreUserBtn"><i class="bx bx-refresh"></i><span>Restore</span></button></td>`;

                }

                content += `</tr>`;

                patientsTbody.innerHTML += content;
            });
        }else{
            patientsTbody.innerHTML = `<tr><td colspan ='3'>no patients found</td></tr>`;
        }
    }
}
patientDetails();

patientDisplay = document.getElementById('patientDisplay');
patientDisplay?.addEventListener("change", () => {
    patientDetails();
});

let specificPatientTbody = document.getElementById('specificPatientTbody');
const specificPatientDetails = async() => {
    if(specificPatientTbody){
        let userId = document.getElementById('PuserId').value;
        console.log("userId:" +userId);
        const data = {
            userId: userId
        };
        const res = await fetch('functions/displayPatientInfo.php', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        const received_data = await res.json();
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(p => {
                document.getElementById('specPatientName').innerHTML = p.Pname;
                document.getElementById('specPatientId').value = p.patientId;
                specificPatientTbody.innerHTML += `
            <tr>
                <td style="font-weight: bold;">Name</td>
                <td>${p.Pname}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Email</td>
                <td>${p.email}</td>      
            </tr>
            <tr>
                <td style="font-weight: bold;">Phone</td>
                <td>${p.phoneNumber}</td>      
            </tr>
            <tr>
                <td style="font-weight: bold;">Gender</td>
                <td>${p.gender}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Blood Type</td>
                <td>${p.bloodType}</td>                     
            </tr>
            <tr>
                <td style="font-weight: bold;">Date Of Birth</td>
                <td>${p.dateOfBirth}</td>                             
            </tr>`;
            });
            specificPatientApptDetails();
        }else{
            specificPatientTbody.innerHTML = `<tr><td>no patient selected </td></tr>`;
        }
    }
}
specificPatientDetails();

let specPApptTbody = document.getElementById('specPApptTbody');
const specificPatientApptDetails = async() => {
    if(specPApptTbody){
        let patientId = document.getElementById('specPatientId').value;
        console.log("patientId:" +patientId);
        const data = {
            patientId: patientId
        };
        const res = await fetch('functions/displayPatientAppt.php', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        const received_data = await res.json();
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(appt => {

                let profilePic = "docImgPlaceholder.jpg";
                if(appt.profilePic != null){
                    profilePic = appt.profilePic;
                }
                let time = formatTimeToAMPM(appt.time);

                specPApptTbody.innerHTML += `
                <tr>
                <td class="DocProfTD">
                    <a href="../uploads/${profilePic}" class="imageLB"> 
                        <img src="../uploads/${profilePic}" alt="doctor Image">
                    </a>
                    <a href="edit-doctor.php?doctorId=${appt.doctorId}"><p class="name">${appt.docName}</p></a>
                </td>
                <td class="date">${appt.date}</td>
                <td>${time}</td>
                <td><span class="status ${appt.status}">${appt.status}</span></td>
                </tr>`;
            });
        }else{
            specPApptTbody.innerHTML = `<tr><td colspan ='4'>no appointments found</td></tr>`;
        }
    }
}
/* specificPatientApptDetails(); */

let adminForms = document.getElementById('adminForms');
const adminDetails = async() => {
    if(adminForms){
        const res = await fetch('functions/displayAdminInfo.php');
        const received_data = await res.json();
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(admin => {
                adminNameInput.value = admin.name;
                adminEmailInput.value = admin.email;

            });
        }
    }
}
adminDetails();

let centerWHTbody = document.getElementById('centerWHTbody');
/* let wDaysTh = document.getElementById('workingDaysTH'); */
const centerWHDetails = async() => {
    if(centerWHTbody){
        const res = await fetch('functions/displayCenterWH.php');
        const received_data = await res.json();
        centerWHTbody.innerHTML = '';
        /* wDaysTh.innerHTML = "Doctors"; */
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(wh => {
                let fromHour="00:00:00";
                let toHour = '00:00:00';
                if(wh.fromHour != '00:00:00' && wh.fromHour != ""){
                    fromHour = formatTimeToAMPM(`${wh.fromHour}`);
                }
                if(wh.toHour != '00:00:00' &&  wh.toHour != ""){
                    toHour = formatTimeToAMPM(`${wh.toHour}`);
                }
                let content ="";
               content += `            
               <tr>
               <td class="day">${wh.day}</td>
               <td class="from">${fromHour}</td>
               <td class="to">${toHour}</td>
               <td>
                   <label class="check-container" id="check_display">Closed`;
                   if(wh.closed == 1){
                    content += `<input type="checkbox" disabled checked>`;
                   }else{
                    content += `<input type="checkbox" disabled>`;
                   }
                    content += `
                       <span class="checkmark"></span>
                   </label>
               </td>
               <td><button class="btn-delete deleteMedHoursBtn" onclick='delCenterWH("${wh.day}")'><i class="bx bx-trash-alt"></i><span>Delete</span></button></td>
            </tr>`;

            centerWHTbody.innerHTML += content;

           
            });
        }else{
            centerWHTbody.innerHTML = `<tr><td colspan ='5'>no working days found</td></tr>`;
        }
    }
}
centerWHDetails();

let DWHDay_list = document.getElementById('DWHDay');
const centerWHSelectDisplay = async() => {
    if(DWHDay_list){
        const res = await fetch('functions/displayCenterWH.php');
        const received_data = await res.json();
        DWHDay_list.innerHTML = '<option value="WHDay">Day</option>';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(wh => {
                if(wh.closed == 0){
                    DWHDay_list.innerHTML += `  
                    <option value="${wh.day}">
                    ${wh.day}
                    </option> `;
                }
            });
        }
    }
}
centerWHSelectDisplay();

let doctorsWHTbody = document.getElementById('doctorsWHTbody');
let wDaysTh = document.getElementById('workingDaysTH');
const doctorsWHDetails = async() => {
    if(doctorsWHTbody){
        const res = await fetch('functions/displayDoctorsWH.php');
        const received_data = await res.json();
        doctorsWHTbody.innerHTML = '';
        wDaysTh.innerHTML = "";
        if (received_data !== 'empty') {
            // Extract unique working days from all doctors
            const uniqueWorkingDays = Array.from(
                new Set(
                    received_data.reduce((acc, doctor) => acc.concat(doctor.workingDays.map(day => day.day)), [])
                )
            );
        
            // Generate the table header
            const tableHeader = `
                <tr>
                    <th>Doctors</th>
                    ${uniqueWorkingDays.map(day => `<th>${day}</th>`).join('')}
                </tr>`;
                wDaysTh.innerHTML += tableHeader;
        
            // Populate the table body
            received_data.forEach(doctor => {
                let content = '';

                let profilePic = "docImgPlaceholder.jpg";
                if(doctor.profilePic != null){
                    profilePic = doctor.profilePic;
                }
        
                // Display doctor's name and profile picture in the first cell
                content += `
                    <tr>
                        <td class="DocProfTD">
                            <a href="../uploads/${profilePic}" class="imageLB"> 
                                <img src="../uploads/${profilePic}" alt="doctor Image">
                            </a>
                            <a href="edit-doctor.php?doctorId=${doctor.doctorId}">
                                <p class="name">${doctor.docName}</p>
                            </a>
                        </td>`;
        
                // Populate cells for each working day
                uniqueWorkingDays.forEach(day => {
                    const workingDay = doctor.workingDays.find(wh => wh.day === day);
        
                    if (workingDay) {
                        let fromHour = "00:00:00";
                        let toHour = '00:00:00';
        
                        if (workingDay.fromHour !== '00:00:00' && workingDay.fromHour !== "") {
                            fromHour = formatTimeToAMPM(`${workingDay.fromHour}`);
                        }
        
                        if (workingDay.toHour !== '00:00:00' && workingDay.toHour !== "") {
                            toHour = formatTimeToAMPM(`${workingDay.toHour}`);
                        }
        
                        content += `
                            <td>
                                <label class="check-container" id="check_display">
                                    <div class="col">
                                        <span>${fromHour}</span>
                                        <span>${toHour}</span>
                                    </div>`;
        
                        if (workingDay.available == 1) {
                            content += `<input type="checkbox" disabled checked>`;
                        } else {
                            content += `<input type="checkbox" disabled>`;
                        }
        
                        content += `<span class="checkmark"></span>
                                    </label>
                                </td>`;
                    } else {
                        // No working day for this doctor on the current day
                        content += '<td></td>';
                    }
                });
        
                content += '</tr>';
                doctorsWHTbody.innerHTML += content;
            });
        }else{
            doctorsWHTbody.innerHTML = `<tr><td colspan ='5'>no working days found</td></tr>`;
        }
    }
}
doctorsWHDetails();

let feedbacksTbody = document.getElementById('feedbacksTbody');
const feedbackDetails = async() => {
    if(feedbacksTbody){
        const res = await fetch('functions/displayFeedabcks.php');
        const received_data = await res.json();
        feedbacksTbody.innerHTML = '';
        console.log(received_data);
        if(received_data != 'empty'){
            received_data.forEach(f => {
                var formattedDate = formatJsDate(`${f.date}`);
                let content = "";
                content += `
                <tr>
                <td class="doctor">${f.docName}</td>
                <td class="patient">${f.patientName}</td>
                <td style="max-width: 400px;">${f.feedback}</td>
                <td class="date">${formattedDate}</td>
                <td>
                <label class="check-container" id="check_display">published`;
                    if(f.published == 1){
                        content += `<input type="checkbox" name="publish" id="publish" checked onchange="publishFeed(${f.feedbackId},0)">`;
                    }else{
                        content += `<input type="checkbox" name="publish" id="publish" onchange="publishFeed(${f.feedbackId},1)">`;
                    }
                    content += ` 
                        <span class="checkmark"></span>
                </label>
                </td>
                <td>
                    <button class="btn-delete deleteFeedback" onclick="delFeedback(${f.feedbackId})"><i class="bx bx-trash-alt"></i><span>Delete</span></button>
                </td>
                </tr>`;

                feedbacksTbody.innerHTML += content;
            });
        }else{
            feedbacksTbody.innerHTML = `<tr><td colspan ='4'>no Feedbacks found</td></tr>`;
        }
    }
}
feedbackDetails();


//delete functions
function delUrgentBT(id) {

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delUrgentBT.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                console.log(res);
                bloodDetails();
                swal("Success!", "Urgent BloodType deleted Successfully!", "success");
            }).catch(error => {
                console.log(error);
            });

        }
      });
}


function delReminder(id) {

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delReminder.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    reminderDetails();
                    swal("Success!", "Reminder deleted Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}


function delClinic(id) {

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delClinic.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    clinicDetails();
                    swal("Success!", "Clinic deleted Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}

function delDonor(id) {

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delDonor.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    donorDetails();
                    swal("Success!", "Donor deleted Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}

function delDoctor(did,uid) {

    swal({
        title: "Are you sure?",
        text: "Once deleted, doctor account will be deactivated",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delDoctor.php', {
                method: 'POST',
                body: JSON.stringify({
                    did: did,
                    uid: uid
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    doctorDetails();
                    swal("Success!", "Doctor Account has been deactivated Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}

function resDoctor(did,uid) {

    swal({
        title: "Are you sure?",
        text: "Doctor account will be restored",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/resDoctor.php', {
                method: 'POST',
                body: JSON.stringify({
                    did: did,
                    uid: uid
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'restored'){
                    console.log(res);
                    doctorDetails();
                    swal("Success!", "Doctor Account has been restored Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}

function delException(date,id) {
console.log(date +" " +id);
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delException.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id,
                    date: date
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    exceptionDetails();
                    swal("Success!", "Exception deleted Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}

function delPatient(id) {

    swal({
        title: "Are you sure?",
        text: "User will be restricted from logging in.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delPatient.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    patientDetails();
                    swal("Success!", "User Account Restricted Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}

function resPatient(id) {

    swal({
        title: "Are you sure?",
        text: "User Account will be restored.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

            fetch('functions/resPatient.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'restored'){
                    console.log(res);
                    patientDetails();
                    swal("Success!", "User Account Restored Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
      });
}

function delCenterWH(day) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delCenterWH.php', {
                method: 'POST',
                body: JSON.stringify({
                    day: day
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    centerWHDetails();
                    swal("Success!", "Center Working Hours deleted Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
    });
}

function delFeedback(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {

            fetch('functions/delFeedback.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'deleted'){
                    console.log(res);
                    feedbackDetails();
                    swal("Success!", "Feedback deleted Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }
    });
}

function publishFeed(id,published) {
    swal({
        title: "Are you sure?",
        text: "Feedback visibility will be changed",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {

            fetch('functions/publishFeed.php', {
                method: 'POST',
                body: JSON.stringify({
                    id: id,
                    published: published
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            }).then((response) => response.json() )
            .then((res) => {
                if(res == 'updated'){
                    console.log(res);
                    feedbackDetails();
                    swal("Success!", "Feedback visibility updated Successfully!", "success");
                }else{
                    swal("Error!", "Something Went Wrong!", "error");
                }

            }).catch(error => {
                console.log(error);
            });

        }else{
            let publishCheck = document.getElementById('publish');
            if(publishCheck.checked){
                publishCheck.checked = false;
            }else{
                publishCheck.checked = true;
            }
        }
    });
}

//other functions
function formatJsDate(originalDate) {
    // Parse the original date string
    var dateTime = new Date(originalDate);

    // Format the date in 'YYYY-MM-DD HH:mm' format
    var formattedDate = dateTime.getFullYear() + '-' +
                        ('0' + (dateTime.getMonth() + 1)).slice(-2) + '-' +
                        ('0' + dateTime.getDate()).slice(-2) + ' ' +
                        ('0' + dateTime.getHours()).slice(-2) + ':' +
                        ('0' + dateTime.getMinutes()).slice(-2);

    return formattedDate;
}

function formatTimeToAMPM(originalTime) {
    // Parse the original time string
    var timeComponents = originalTime.split(':');
    var hours = parseInt(timeComponents[0], 10);
    var minutes = parseInt(timeComponents[1], 10);

    // Format the time in 'h:mm A' format
    var formattedTime = ((hours % 12) || 12) + ':' + ('0' + minutes).slice(-2) + ' ' + (hours >= 12 ? 'PM' : 'AM');

    return formattedTime;
}


// alert
/* if( $('.alert').hasClass("showAlert")){
setTimeout(function(){
$('.alert').removeClass("show");
$('.alert').addClass("hide");
},5000);
}

$('.close-btn').click(function(){
$('.alert').removeClass("show");
$('.alert').addClass("hide");
}); */
