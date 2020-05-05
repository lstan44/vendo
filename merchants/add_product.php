<?php
session_start();
require "../vendor/autoload.php";

include_once '../config/Database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->connect();
$product = new Product($db);

$name = $_POST['name'];
$desc = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['count'];
$department = $_POST['department'];
$img_tmp = $_FILES['images']['tmp_name'];
$img_name = $_FILES['images']['name'];

move_uploaded_file($img_tmp,"images/".$img_name);



$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

\Cloudinary::config(array( 
    "cloud_name" => "vendo", 
    "api_key" => $_ENV["API_KEY"], 
    "api_secret" => $_ENV["API_SECRET"], 
    "secure" => true
  ));

 $up = \Cloudinary\Uploader::upload("images/".$img_name, array(
                                                            "categorization" => "aws_rek_tagging",
                                                            "moderation" => "aws_rek"
                                                                                                ));

$img_url = "https://res.cloudinary.com/vendo/image/upload/".$up['public_id'];

unlink('images/'.$img_name);

$product->add($name,$desc,$price,$img_url,$department,$stock,$_SESSION['seller_id']);

header('Location: portal.php');
