<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

$database = new Database();
$db = $database->connect();

$product_id = $_GET['id'];

$product = new Product($db);

$result = $product->read_single($product_id);

$product_count = $result->rowCount();

if($product_count > 0){
    $product_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $product_item = array(
            'id'=>$product_id,
            'name'=>$name,
            'description'=>$description,
            'count'=>$count,
            'sold_by'=>$seller_id,
            'department'=>$department,
            'current_price'=>$current_price,
            'previous_price'=>$previous_price,
            'img_url' => $img_url
        );

        array_push($product_arr,$product_item);
    }

    echo json_encode($product_arr);
}

else{
    echo json_encode(
        array('message'=>'No product found')
    );
}
