
var patientname=document.getElementById('pname');
var newappdate=document.getElementById('nappdate');
var timeapp=document.getElementById('tapp');
var forpatientname=document.getElementById('forpatient');
var fornewappdate=document.getElementById('fornewapp');
var fortime=document.getElementById('fortime');
var sub1=false;
var sub2=false;
var sub3=false;

//current date
// const currentDate = () => {
//     const date = new Date();
//     const day = date.getDate();
//     const month = date.getMonth() + 1;
//     const year = date.getFullYear();
    
//     const formattedDate = `${year}-${day.toString().padStart(2, '0')}-${month.toString().padStart(2, '0')}`;
    
//     return formattedDate;
// };
// lastappdate.value = currentDate();


//on submit
document.getElementById('form').addEventListener('submit',(e)=>{
    if(patientname.value!=="" && newappdate.value!=="" && timeapp.value!=="")
    {
                e.preventDefault();
                var formData = new FormData(document.getElementById("form"));
                if(e.submitter.id === 'add'){
             $.ajax({
              method:"POST",
              url:"queryFunctions/addPatientDb.php",
              processData: false,
               contentType: false, 
               cache: false,
               enctype: 'multipart/form-data',
              data:formData,
              success:function(){
                location.reload();
              }
             })
            }
            else if(e.submitter.id === 'edit')
            {
                $.ajax({
                    method:"POST",
                    url:"queryFunctions/editPatientDb.php",
                    processData: false,
                     contentType: false, 
                     cache: false,
                     enctype: 'multipart/form-data',
                    data:formData,
                    success:function(){
                      location.reload();
                    }
                   })
            }
          
    }
    e.preventDefault();
    if(patientname.value==="" && !sub1)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'patient-error2';
        errorDiv.className="error";
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        forpatientname.appendChild(errorDiv);
        sub1=true;
    }
    if(newappdate.value==="" && !sub2)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'newapp-error2';
        errorDiv.className="error";
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        fornewappdate.appendChild(errorDiv);
        sub2=true;
    }
    if(timeapp.value==="" && !sub3)
    {
        const errorDiv = document.createElement('div');
        errorDiv.id = 'time-error2';
        errorDiv.className="error";
        errorDiv.style.color = 'red';
        
        
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-triangle-exclamation';
        errorDiv.appendChild(icon);

        errorDiv.innerHTML += ' This field is required';
        
        fortime.appendChild(errorDiv);
        sub3=true;
    }
    
});
//patient name
patientname.addEventListener('focus', () => {

    const errorDiv2 = document.getElementById('patient-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub1=false;
    }
});
//date
newappdate.addEventListener('change', () => {

    const errorDiv2 = document.getElementById('newapp-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub2=false;
    }
});
//time
timeapp.addEventListener('change', () => {

    const errorDiv2 = document.getElementById('time-error2');
    if(errorDiv2)
    {
        errorDiv2.remove();
        sub3=false;
    }
});
//on editing
document.getElementById('stable').addEventListener('click', function (event) {
   
   
        if (event.target.classList.contains('edit')) {
            var foredit = event.target.closest('tr');
           console.log(foredit)
        }

});
