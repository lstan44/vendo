<?php

include_once './auth/Authenticate.php';


$authIntent = new Authenticate();

$authIntent->login('stanleylalanne94@gmail.com','mypass');