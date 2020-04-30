<?php
session_start();

if(!isset($_SESSION['id'])){
    include 'views/header1.php'; //
}
else{
    include 'views/header2.php';
}