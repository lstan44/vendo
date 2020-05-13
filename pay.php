<?php
session_start();
require 'vendor/autoload.php';


\Stripe\Stripe::setApiKey("sk_test_fKPV19iOVxsERVNuxYSYtFha00SfvAppks");

$token = $_POST['stripeToken'];
$charge = \Stripe\Charge::create([
  'amount' => 100,
  'currency' => 'usd',
  'description' => 'New test charge',
  'source' => $token,
]);

if($charge["amount_refunded"] == 0){
    $_SESSION['pid'] = array();
    header('Location: orders.php?order='.$charge['id']);
}