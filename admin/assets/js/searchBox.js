// Function to toggle the visibility of the search box
function toggleSearchBox() {
    var searchBox = document.getElementById('searchBox');
    searchBox.style.display = (searchBox.style.display === 'block') ? 'none' : 'block';
}

function toggleSearchBox2() {
    var searchBox2 = document.getElementById('searchBox2');
    searchBox2.style.display = (searchBox2.style.display === 'block') ? 'none' : 'block';
}

function toggleReminderBox() {
    var reminderBox = document.getElementById('reminderBox');
    reminderBox.style.display = (reminderBox.style.display === 'block') ? 'none' : 'block';
}

// Placeholder function for performing the search (replace with your actual search logic)
function performSearch() {
    var searchTerm = document.getElementById('searchInput').value;
    alert('Performing search for: ' + searchTerm);
}