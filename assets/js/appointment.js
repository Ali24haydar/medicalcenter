/* var email = document.getElementById('email');
var phone = document.getElementById('phnum');
var firstname=document.getElementById('fname');
var lastname=document.getElementById('lname');
var foremail = document.getElementById('foremail');
var forphone = document.getElementById('forphone');
var forfirstname = document.getElementById('forfirstname');
var forlastname = document.getElementById('forlastname');
var errorDisplayed = false;
var errorphoneDisplayed=false;
var errorDisplayed3=false;
var errorDisplayed4=false; 
var suc1=false;
var suc2=false;
var suc3=false;
var suc4=false;
var sub1=false;
var sub2=false;
var sub3=false;
var sub4=false;

const validateEmail = (email) => {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

const validatePhone = (phone) => {
    return phone.match(
        /^(76|03|71|70)\d{6}$/
    );
};


const validateName=(name)=>{
    return name.match(
        /^[a-zA-Z]{3,}$/
    );
};

//validate the email
email.addEventListener('focusout', () => {
    if (email.value==="" && !errorDisplayed) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'email-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        foremail.insertAdjacentElement('afterend', errorDiv);
        errorDisplayed = true;
    }
    else if (!validateEmail(email.value) && !errorDisplayed) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'email-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' Enter a valid email';
        
        foremail.insertAdjacentElement('afterend', errorDiv);
        errorDisplayed = true;
    }
    
});

email.addEventListener('input', () => {
    if (errorDisplayed) {
        const errorDiv = document.getElementById('email-error');
        if (errorDiv) {
            errorDiv.remove();
            errorDisplayed = false;
        }
    }
    if(suc1)
    {
        const suc = document.getElementById('suc1');
        if (suc) {
            suc.remove();
            suc1 = false;
        }   
    }
    if (validateEmail(email.value) && !suc1) {
        const icon = document.createElement('i');
        icon.className = 'fa-regular fa-circle-check';
        icon.id='suc1';
        icon.style.color = '#049f0e';
        icon.style.marginLeft='-40px';
        icon.style.paddingBottom='14px';
        foremail.appendChild(icon);
        suc1=true;
    }

   
});
//validate the first name
firstname.addEventListener('focusout', () => {
    if (firstname.value==="" && !errorDisplayed3) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'fname-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += 'This field is required';
        
        forfirstname.insertAdjacentElement('afterend', errorDiv);
        errorDisplayed3 = true;
    }
    else if (!validateName(firstname.value) && !errorDisplayed3) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'fname-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' your name should not contain numbers and at least 3 character';
        
        forfirstname.insertAdjacentElement('afterend', errorDiv);
        errorDisplayed3 = true;
    }
    
    
});

firstname.addEventListener('input', () => {
    if (errorDisplayed3) {
        const errorDiv = document.getElementById('fname-error');
        if (errorDiv) {
            errorDiv.remove();
            errorDisplayed3 = false;
        }
    }
    if(suc3)
    {
        const suc = document.getElementById('suc3');
        if (suc) {
            suc.remove();
            suc3 = false;
        }   
    }
    if (validateName(firstname.value) && !suc3) {
        const icon = document.createElement('i');
        icon.className = 'fa-regular fa-circle-check';
        icon.id='suc3';
        icon.style.color = '#049f0e';
        icon.style.marginLeft='-40px';
        icon.style.paddingBottom='14px';
        forfirstname.appendChild(icon);
        suc3=true;
    }
   
});
//validate the last name
lastname.addEventListener('focusout', () => {
    if (lastname.value==="" && !errorDisplayed4) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'lname-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forlastname.insertAdjacentElement('afterend', errorDiv);
        errorDisplayed4 = true;
    }
     else if(!validateName(lastname.value) && !errorDisplayed4)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'lname-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += 'your last name should not contain numbers and at least 3 character';
        
        forlastname.insertAdjacentElement('afterend', errorDiv);
        errorDisplayed4 = true;
    }
    
    
});

lastname.addEventListener('input', () => {
    if (errorDisplayed4) {
        const errorDiv = document.getElementById('lname-error');
        if (errorDiv) {
            errorDiv.remove();
            errorDisplayed4 = false;
        }
    }
    if(suc4)
    {
        const suc = document.getElementById('suc4');
        if (suc) {
            suc.remove();
            suc4 = false;
        }   
    }
    if (validateName(lastname.value) && !suc4) {
        const icon = document.createElement('i');
        icon.className = 'fa-regular fa-circle-check';
        icon.id='suc4';
        icon.style.color = '#049f0e';
        icon.style.marginLeft='-40px';
        icon.style.paddingBottom='14px';
        forlastname.appendChild(icon);
        suc4=true;
    }
   
});

//validate the phone number

phone.addEventListener('focusout', () => {
    if (phone.value==="" && !errorphoneDisplayed) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'phone-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += 'This field is required';
        
        forphone.insertAdjacentElement('afterend', errorDiv);
        errorphoneDisplayed = true;
    }
    else if (!validatePhone(phone.value) && !errorphoneDisplayed) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'phone-error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' Enter a valid phone number';
        
        forphone.insertAdjacentElement('afterend', errorDiv);
        errorphoneDisplayed = true;
    }
   
});
//test when submit the form
document.getElementById('btn').addEventListener('click',(e)=>
{ 
    e.preventDefault();
    if(!errorDisplayed3 && !errorDisplayed4)
    { 
    if(phone.value==="" && !sub1)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'phone-error2';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forphone.insertAdjacentElement('afterend', errorDiv);
        sub1=true;
    }
    if(email.value==="" && !sub2)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'email-error2';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        foremail.insertAdjacentElement('afterend', errorDiv);
        sub2=true;
    }
    if(lastname.value==="" && !sub3)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'l-error2';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forlastname.insertAdjacentElement('afterend', errorDiv);
        sub3=true;
    }
     if(firstname.value==="" && !sub4)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'f-error2';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forfirstname.insertAdjacentElement('afterend', errorDiv);
        sub4=true;
    }
    if(suc3 && suc4)
    {
        document.getElementById('form').submit();
    }
}
});
phone.addEventListener('input', () => {
    if (errorphoneDisplayed) {
        const errorDiv = document.getElementById('phone-error');
        if (errorDiv) {
            errorDiv.remove();
            errorphoneDisplayed = false;
        }
    }
    const errorDiv2 = document.getElementById('phone-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub1=false;
    }
    if(suc2)
    {
        const suc = document.getElementById('suc2');
        if (suc) {
            suc.remove();
            suc2 = false;
        }   
    }
    if (validatePhone(phone.value) && !suc2) {
        const icon = document.createElement('i');
        icon.className = 'fa-regular fa-circle-check';
        icon.id='suc2';
        icon.style.color = '#049f0e';
        icon.style.marginLeft='-40px';
        icon.style.paddingBottom='14px';
        forphone.appendChild(icon);
        suc2=true;
    }
});
phone.addEventListener('focus', () => {
    
    const errorDiv2 = document.getElementById('phone-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub1=false;
    }
});
email.addEventListener('focus', () => {
    
    const errorDiv2 = document.getElementById('email-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub2=false;
    }
});
firstname.addEventListener('focus', () => {
    
    const errorDiv2 = document.getElementById('f-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub4=false;
    }
});
lastname.addEventListener('focus', () => {
    
    const errorDiv2 = document.getElementById('l-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub3=false;
    }
});
 */
