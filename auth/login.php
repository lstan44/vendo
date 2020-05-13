<?php

include_once 'Authenticate.php';
include_once '../config/Database.php';

$db = new Database();

$auth = new Authenticate($db);
$email = $_POST['Email'];
$pwd = hash('sha256',$_POST['Password'] );

$authIntent = $auth->login($email ,$pwd);

if( $authIntent['status'] == 1){
    session_start();
    $_SESSION['id'] = $authIntent['user_id'];
    
    header('Location: /vendo');
}
else{
    header('Location: /vendo/login.php');
}
?>
