<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

\Cloudinary::config(array( 
    "cloud_name" => "vendo", 
    "api_key" => $_ENV["API_KEY"], 
    "api_secret" => $_ENV["API_SECRET"], 
    "secure" => true
  ));

 $up = \Cloudinary\Uploader::upload("images/img3.jpg", array("public_id" => 'img2',
                                                            "categorization" => "aws_rek_tagging",
                                                            "moderation" => "aws_rek"
                                                                                                ));

 var_dump($up);
