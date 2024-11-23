const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.sidebar .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

document.addEventListener("DOMContentLoaded", function() {
    var currentDateElement = document.getElementById("currentDate");
    if(currentDateElement){
    // Get the current date
    var currentDate = new Date();
        
    // Format the date as you desire
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);

    formattedDate = formattedDate.replace(/,/g, '');
    
    // Set the formatted date inside the HTML element
    currentDateElement.textContent = formattedDate;
    }
});