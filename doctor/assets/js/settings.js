var oldpass=document.getElementById('cpass');
var newpass=document.getElementById('npass');
var renewpass=document.getElementById('rnpass');
var demail=document.getElementById('demail');
var dphnum=document.getElementById('dphnum');
var forpass1=document.getElementById('forpass1');
var forpass2=document.getElementById('forpass2');
var divpass2=document.getElementById('div2');
var divpass3=document.getElementById('div3');
var forpass3=document.getElementById('forpass3');
var errorDisplayed=false;
var errorDisplayed2=false;
var errorDisplayed3=false;
var suc1=false;
var suc2=false;
var suc3=false;
var sub1=false;
var sub2=false;
var sub3=false;


const validatePassword = (password) => {
    return password.match(
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_=+{};:'",<.>\/?\\[\]`~])(.{8,})$/
    );
};
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
//validation for new password
newpass.addEventListener('focusout', () => {
    if (newpass.value==="" && !errorDisplayed) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'newpass-error';
        errorDiv.style.color = 'red';
        errorDiv.className='error';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forpass2.appendChild(errorDiv);
        errorDisplayed = true;
    }
    else if (!validatePassword(newpass.value) && !errorDisplayed) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'newpass-error';
        errorDiv.style.color = 'red';
        errorDiv.className='error';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        icon.style.marginRight='8px';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += 'Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one digit.';
        
        forpass2.appendChild(errorDiv);
        errorDisplayed = true;
    }
    
});

newpass.addEventListener('input', () => {
    if (errorDisplayed) {
        const errorDiv = document.getElementById('newpass-error');
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
    const errorDiv2 = document.getElementById('newpass-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub1=false;
    }
    if (validatePassword(newpass.value) && !suc1) {
        const icon = document.createElement('i');
        icon.className = 'fa-regular fa-circle-check';
        icon.id='suc1';
        icon.style.color = '#049f0e';
        icon.style.marginLeft='-33px';
        icon.style.paddingBottom='0px';
        icon.style.paddingTop='7px';
        divpass2.appendChild(icon);
        suc1=true;
    }

   
});
newpass.addEventListener('focus', () => {

    const errorDiv2 = document.getElementById('newpass-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub1=false;
    }
    

   
});
//validation for re-type new password
renewpass.addEventListener('focusout', () => {
    if (renewpass.value==="" && !errorDisplayed2 ) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'renewpass-error';
        errorDiv.className='error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forpass3.appendChild(errorDiv);
        errorDisplayed2 = true;
    }
    else if (renewpass.value!==newpass.value && !errorDisplayed2) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'renewpass-error';
        errorDiv.style.color = 'red';
        errorDiv.className='error';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        icon.style.marginRight='8px';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += 'Password confirmation is incorrect';
        
        forpass3.appendChild(errorDiv);
        errorDisplayed2 = true;
    }
    
});

renewpass.addEventListener('input', () => {
    if (errorDisplayed2) {
        const errorDiv = document.getElementById('renewpass-error');
        if (errorDiv) {
            errorDiv.remove();
            errorDisplayed2 = false;
        }
    }
    if(suc2)
    {
        const suc = document.getElementById('suc2');
        if (suc) {
            suc.remove();
            suc2 = false;
        }   
    }
    const errorDiv2 = document.getElementById('renewpass-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub2=false;
    }
    if (renewpass.value!=="" && renewpass.value===newpass.value && validatePassword(newpass.value)&& !suc2) {
        const icon = document.createElement('i');
        icon.className = 'fa-regular fa-circle-check';
        icon.id='suc2';
        icon.style.color = '#049f0e';
        icon.style.marginLeft='-33px';
        icon.style.paddingBottom='0px';
        icon.style.paddingTop='7px';
        divpass3.appendChild(icon);
        suc2=true;
    }

   
});
renewpass.addEventListener('focus', () => {

    const errorDiv3 = document.getElementById('renewpass-error2');
    if(errorDiv3)
    {
        errorDiv3.remove();
        sub2=false;
    }
    

   
});
//validation for old password
oldpass.addEventListener('focusout', () => {
    if (oldpass.value==="" && !errorDisplayed3) {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'oldpass-error';
        errorDiv.className='error';
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forpass1.appendChild(errorDiv);
        errorDisplayed3 = true;
    }
});
oldpass.addEventListener('input', () => {
    if (errorDisplayed3) {
        const errorDiv = document.getElementById('oldpass-error');
        if (errorDiv) {
            errorDiv.remove();
            errorDisplayed3 = false;
        }
    }
    const errorDiv2 = document.getElementById('oldpass-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub3=false;
    }

   
});

//when submit the form

document.getElementById('formsubmit').addEventListener('submit',(e)=>
{ 
    if (suc1 && suc2 && oldpass.value !== "") {
        e.preventDefault();
        var formData =new FormData(document.getElementById('formsubmit'));
        formData.append('submit2','submit2');
            $.ajax({
            method:"POST",
            url:"queryFunctions/forSettings.php",
            processData: false,
            contentType: false, 
            cache: false,
            data:formData,
            success:function(response){
                console.log(formData);
                document.getElementById('errcurrentpass').innerText=response;
            }
            }) }
    e.preventDefault();

 if(!errorDisplayed && !errorDisplayed2 && !errorDisplayed3)
    {
    if(newpass.value==="" && !sub1)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'newpass-error2';
        errorDiv.className="error";
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forpass2.appendChild(errorDiv);
        sub1=true;
    }
    if(renewpass.value==="" && !sub2)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'renewpass-error2';
        errorDiv.className="error";
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forpass3.appendChild(errorDiv);
        sub2=true;
    }
    if(oldpass.value==="" && !sub3)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'oldpass-error2';
        errorDiv.className="error";
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forpass1.appendChild(errorDiv);
        sub3=true;
    }
   

}
});
//for email and phone number validations
document.getElementById('forminfo').addEventListener('submit',(e)=>
{ 
    if(!validateEmail(demail.value) && !validatePhone(dphnum.value))
    {
        e.preventDefault();
        document.getElementById('emailerror').innerHTML = "<i class='fa-solid fa-triangle-exclamation'></i> Enter a valid email";
        document.getElementById('emailerror').style.display="block";
        document.getElementById('phoneerror').innerHTML = "<i class='fa-solid fa-triangle-exclamation'></i> Enter a valid phone number";
        document.getElementById('phoneerror').style.display="block";
    }
    else if(!validateEmail(demail.value))
    {
        e.preventDefault();
        document.getElementById('emailerror').innerHTML = "<i class='fa-solid fa-triangle-exclamation'></i> Enter a valid email";
        document.getElementById('emailerror').style.display="block";
    }
    else if(!validatePhone(dphnum.value))
    {
        e.preventDefault();
        document.getElementById('phoneerror').innerHTML = "<i class='fa-solid fa-triangle-exclamation'></i> Enter a valid phone error";
        document.getElementById('phoneerror').style.display="block";
    }
    else
    {
        e.preventDefault();
        var formData = new FormData(document.getElementById('forminfo'));
        formData.append("submitinfo", "submitinfo");

        $.ajax({
            method: "POST",
            url: "queryFunctions/forSettings.php",
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success: function (response) {
                if(response.includes('Phone') && response.includes('Email'))
                {
                    const icon = document.createElement('i');
                    icon.className = 'fa-solid fa-triangle-exclamation';
                    document.getElementById('phoneerror').innerHTML = `<i class='fa-solid fa-triangle-exclamation'></i> ${response} `;
                    document.getElementById('phoneerror').style.display="block";
                }
                else if(response.includes('Phone'))  
                {
                    const icon = document.createElement('i');
                    icon.className = 'fa-solid fa-triangle-exclamation';
                    document.getElementById('phoneerror').appendChild(icon);
                    document.getElementById('phoneerror').innerHTML = `<i class='fa-solid fa-triangle-exclamation'></i> ${response} `;
                    document.getElementById('emailerror').innerHTML = `<i class='fa-solid fa-triangle-exclamation'></i> ${response} `;
                    document.getElementById('phoneerror').style.display="block";
                }
                else if(response.includes('Email'))  
                {
                    const icon = document.createElement('i');
                    icon.className = 'fa-solid fa-triangle-exclamation';
                    document.getElementById('emailerror').innerHTML = `<i class='fa-solid fa-triangle-exclamation'></i> ${response} `;
                    document.getElementById('emailerror').style.display="block";
                }
                else
                {
                    location.reload();
                }
            }
        
        });
}
});
