const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');//3m 7aded side bar kelo m 3ad logout

sideLinks.forEach(item => {
    const li = item.parentElement;
    item?.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active'); //bs e3ml click 3a ay 3nsor mtl clincs bsir active w be2e kelon in active la fut 3le
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar'); //kbst menu 3m 7adedla enu heye ms2ule 3n tskir aw fth sidebar

menuBar?.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button'); //bs ekbos 3a klmet search  iza knt sheshi az8ar mn 576
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx'); //btsbdal b kbst search b bs ishrt el search
const searchForm = document.querySelector('.content nav form');

searchBtn?.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

if (window.innerWidth < 800) { //iza as8ar mn 800 bskr sidebar
    sideBar.classList.add('close');
}

window.addEventListener('resize', () => {
    if (window.innerWidth < 800) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');  //dark mode

toggler?.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
        toggleDarkMode();
    } else {
        document.body.classList.remove('dark');
        toggleDarkMode();
    }
});

function toggleDarkMode() {
    const body = document.body;
    const isDarkMode = body.classList.contains('dark');
    localStorage.setItem('darkMode', isDarkMode);
}

function loadDarkModePreference() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    const body = document.body;

    if (isDarkMode) {
        body.classList.add('dark');
        toggler.checked = true;
    } else {
        body.classList.remove('dark');
        toggler.checked = false;
    }

    // Show the content after dark mode preference is loaded
    document.body.classList.remove('content-hidden');
}

window.addEventListener('load', loadDarkModePreference);

const account = document.getElementById('account');
const reqs = document.getElementsByClassName('req');
account?.addEventListener('change', function () {
    if (this.checked) {
        for (var i = 0; i < reqs.length; i++) {
            reqs[i].required = true;
        }
    } else {
        for (var i = 0; i < reqs.length; i++) {
            reqs[i].required = false;
        }
    }
});


var firstInput = document.getElementById('firstInput');
var secondInput = document.getElementById('secondInput');

firstInput?.addEventListener('input', function() {

    if (firstInput.value.trim() === '' && secondInput.value.trim() === '') {
        firstInput.required = true;
        secondInput.required = true;
    } else if (firstInput.value.trim() != '' && secondInput.value.trim() === '') {
        secondInput.required = false;
    }

});

secondInput?.addEventListener('input', function() {

    if (firstInput.value.trim() === '' && secondInput.value.trim() === '') {
        firstInput.required = true;
        secondInput.required = true;
    } else if (firstInput.value.trim() === '' && secondInput.value.trim() != '') {
        firstInput.required = false;
    }

});