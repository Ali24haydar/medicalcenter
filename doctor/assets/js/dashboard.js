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
    var currentDayElement = document.getElementById("currentDay");
    
    // Get the current date
    var currentDate = new Date();
    
    // Format the date as you desire
    var doptions = {weekday: 'long'}
    var options = { year: 'numeric', month: 'short', day: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);
    var formattedDay = currentDate.toLocaleDateString('en-US', doptions);

    formattedDate = formattedDate.replace(/,/g, '');
    
    // Set the formatted date inside the HTML element
    if(currentDateElement){
        currentDateElement.textContent = formattedDate;
    }
    if(currentDayElement){
        currentDayElement.textContent = formattedDay;
    }
    
});

var filterInput = document.getElementById('searchInput');
        var rows = document.querySelectorAll('.p-row');

        filterInput.addEventListener('input', function() {
        var filterValue = filterInput.value.toLowerCase();

        rows.forEach(function(row) {
        var name = row.querySelector('#name').textContent.toLowerCase();
        var phone = row.querySelector('#phone').textContent.toLowerCase();
        var email = row.querySelector('#email').textContent.toLowerCase();
        var shouldShow = false;

        if (name.includes(filterValue) || phone.includes(filterValue) || email.includes(filterValue)) {
            shouldShow = true;
        }

        row.style.display = shouldShow ? 'table-row' : 'none';
    });
    });