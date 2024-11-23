<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthHub Admin Panel</title>

    <link rel="icon" href="/images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/checkbox.css">
    <link rel="stylesheet" href="assets/css/seachBox.css">
    <link rel="stylesheet" href="assets/css/expandSearchBox.css">
    <link rel="stylesheet" href="assets/css/animatedLogin.css">
    <link rel="stylesheet" href="assets/css/autocomplete.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

</head>

<body class="content-hidden">

<?php
    include('includes/sidebar.php');
?>

    <div class="alert hide showAlert">
        <span class="bx bx-message-square-error"></span>
        <span id="alertMsg" class="msg">!</span>
        <div class="close-btn">
            <span class="bx bx-x"></span>
        </div>
    </div>

<!-- Main Content -->
<div class="content">
    <?php
        include('includes/navbar.php');
    ?>
