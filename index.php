<?php
session_start();

$_SESSION['id'] = 1;

if(!isset($_SESSION['id'])){
    header('Location: login.php');
}