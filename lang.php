<?php
    // Check if session start
    if(!isset($_SESSION['lang'])){
        $_SESSION['lang'] = 'en'; // Set the default language to English
    }

    // Check if the lang parameter is in the URL
    if(isset($_GET['lang']) && !empty($_GET['lang'])){
        if($_GET['lang'] == 'ar')
            $_SESSION['lang'] = 'ar';
        else if($_GET['lang'] == 'en')
            $_SESSION['lang'] = 'en';
    }
?>