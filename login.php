<?php

include_once 'auth/Authenticate.php';
include_once 'config/Database.php';

$db = new Database();

$auth = new Authenticate($db);

$email = $_POST['email'];
$pwd = $_POST['pwd'];

$authIntent = $auth->login($email ,$pwd);

if( $authIntent['status'] == 1){
    session_start();
    $_SESSION['id'] = $authIntent['user_id'];
    
    header('Location: index.php');
}