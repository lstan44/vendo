<?php

require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey("sk_test_fKPV19iOVxsERVNuxYSYtFha00SfvAppks");

\Stripe\Stripe::setApiKey("sk_test_fKPV19iOVxsERVNuxYSYtFha00SfvAppks");

 $res = \Stripe\Charge::retrieve([
  'id' => 'ch_1GckbQDrIIMTFAaKUGJ8DtqX',
  'expand' => ['customer', 'invoice.subscription'],
]);

//var_dump($res);


$ch = \Stripe\Charge::create([
    "amount" => 2000,
    "currency" => "usd",
    "source" => "tok_visa", // obtained with Stripe.js
    "metadata" => ["order_id" => "6735"]
  ]);

var_dump($ch);