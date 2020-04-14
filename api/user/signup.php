<?php
include_once '../../config/Database.php';
include_once '../../models/User.php';


$database = new Database();
$db = $database->connect();

$user = new User($db);

$first = 'FirstSignup';
$last = 'LastSignup';
$email = 'signup@gmail.com';
$password = hash('sha256','mypassword');
$acct = '12909873';

$userSignupIntent = json_decode($user->create($first, $last, $email, $password, $acct), true);

if($userSignupIntent['code'] == 400){
    echo "<script> alert('account exists already'); </script>";
}
