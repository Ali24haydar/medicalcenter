// Form variable
const donateForm   = document.getElementById('donateform');

// Form Input variable
const emailText    = document.getElementById('email');
const errorDisplay = document.getElementById('errorInput');
const bloodType    = document.getElementById('mySelect');

// Form Button variable
const btn_donate   = document.getElementById('click_donate');

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
const checkEmailOrPhone = () => {
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
const validateEmailOrPhone = () => {
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

// Add event listeners to input fields
emailText?.addEventListener('focusout', checkEmailOrPhone);
emailText?.addEventListener('input', validateEmailOrPhone);
bloodType?.addEventListener('change', validateSelect);

// Click button
btn_donate?.addEventListener("click", function(event) {
    if (event.target.type === 'submit') {
        event.preventDefault();
        alert("stop submit");
    }else{
        if(!validateSelect() || !checkEmailOrPhone() || !validateEmailOrPhone()){
            validateSelect();
            checkEmailOrPhone();
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