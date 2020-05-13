<?php


include_once '../auth/Authenticate.php';
include_once '../config/Database.php';

$db = new Database();

$auth = new Authenticate($db);

$email = $_POST['email'];
$pwd = $_POST['pwd'];

$authIntent = $auth->login_seller($email ,hash('sha256',$pwd) );

var_dump($authIntent);

if( $authIntent['status'] == 1){
    session_start();
    $_SESSION['seller_id'] = $authIntent['seller_id'];
    $_SESSION['first'] = $authIntent['firstname'];
    $_SESSION['last'] = $authIntent['lastname'];
    $_SESSION['email'] = $authIntent['email'];
    
    header('Location: portal.php');
}
else{
    header('Location: index.php');
}