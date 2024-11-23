document.addEventListener("DOMContentLoaded",function(){  //la jib current date
    let date = document.getElementById('date');
    let currentDate = new Date();
    let options = { year: 'numeric', month: 'short', day: 'numeric' };
    let formattedDate = currentDate.toLocaleDateString('en-US',options);
    formattedDate = formattedDate.replace(/,/g, '');
    date.textContent = formattedDate;
})