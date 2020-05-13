<?php
session_start();

if(isset($_SESSION['id']) ){
    include 'views/header2.php';
}
else{
    include 'views/header1.php';
}

echo '<h2> Thank you for your orders </h2>';