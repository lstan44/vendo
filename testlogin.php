<?php

include_once 'auth/Authenticate.php';
include_once 'config/Database.php';

$db = new Database();

$auth = new Authenticate($db);

$authIntent = $auth->login('stanleylalanne94@gmail.com','password123');

var_dump($authIntent);