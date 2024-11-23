<?php
require_once('../../config/dbcon.php');//3ytet la database

function redirect($url, $message){
    $_SESSION['message']= $message;
    header('Location: ' .$url);
    exit();
}

function test_input($data){ //bdi et7a2a2 mn data le mfaweta user
    $data = trim($data);   //bl8e fara8at
    $data = stripslashes($data); //bshil back slashes krml m ykun htin dhi virus
    $data = htmlspecialchars($data); //bhawel a7rof mwjude 3nde la rmz htmk la emn3 tnfiz ay shifra dara
    return $data; //brj3 b3id nas
}

// Function to validate name enu esm ma fi ar2am bs ahrof
function validateName($name) {
    $nameRegex = '/^[a-zA-Z]+$/'; //variable bs by2bal a7rof kbiri w z8iri el english 
    return preg_match($nameRegex, $name); //return trun iza sah
}

// Function to validate desc
function validateDesc($desc) { //hay la et7a2a2 mn description
    $descRegex = '/^[a-zA-Z\s]+$/';
    return preg_match($descRegex, $desc);
}

// Function to validate email
function validateEmail($email) {
    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/'; //bt2kd eno 3nde nas byrj3 ishrt@ byrj3 . byrj3 nas
    return preg_match($emailRegex, $email); 
}

// Function to validate password
function validatePass($pass) {
    $passRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    return preg_match($passRegex, $pass); // lzm y7twe 3a 7rf z8ir 3a akal w hrf kbir 3a akal whd w e2m whd w mmnu3 y2l 3n 8 a7rof 
}

// Function to validate phone
function validatePhone($phone) {
    $lebanesePhoneRegex = '/^\d{8}$/'; //eno lzm ykun 3nde mn 8 a7rof r2m
    return preg_match($lebanesePhoneRegex, $phone);
}

?>