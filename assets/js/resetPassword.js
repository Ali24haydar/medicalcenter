const password = document.getElementById('pass1');
const confirmPassword = document.getElementById('pass2');
const message1 = document.getElementById('msg1');
const message2 = document.getElementById('msg2');


function isPasswordEmpty(pwdInput,pwdMsg){
    const pwd = pwdInput.value;
    if(pwd === ""){
        pwdMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> This field is required';
        return false;
    }else{
        return true;
    }
}

password.addEventListener('focusout',function(){
    isPasswordEmpty(password,message1);
});

confirmPassword.addEventListener('focusout',function(){
    isPasswordEmpty(confirmPassword,message2);
});

function validatePwd(pwdInput,pwdMsg){
    const pwd = pwdInput.value;
    if(!pwd.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)){
        pwdMsg.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one digit.';
        return false;
    }
    pwdMsg.innerHTML = '';
    return true;
}

password.addEventListener('input',function(){
    validatePwd(password,message1);
});

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

confirmPassword.addEventListener('input',function(){
    comparePasswords(password,confirmPassword,message2);
});