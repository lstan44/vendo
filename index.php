<?php
session_start();


include_once 'config/Database.php';

$db = new Database();
$conn = $db->connect();

$query = "SELECT * from products as p, images as i where (p.product_id = i.product_id)";

$stmt = $conn->prepare($query);

$stmt->execute();

$product_list = array();

if($stmt->rowCount() <=0 ){
    $product_list = array(
        'message'=> 'no products found.'
    );

}
 else{
    while( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    
    $temp_arr = array(
        'name' => $name,
        'description' => $description,
        'product_id' => $product_id,
        'seller_id' => $seller_id,
        'count' => $count,
        'current_price' => $current_price,
        'previous_price' => $previous_price,
        'department' => $department,
        'img_url' => $img_url
    );
    array_push($product_list, $temp_arr);

}
 }

if(!isset($_SESSION['id'])){
    include 'views/header1.php'; //
}
else{
    include 'views/header2.php';
}
?>

<body>
    <div id="product_list">
    
    <?php 
    if(empty($product_list) ){
        print<<<EOF
            <div id="product_box">
                <h2> Our store is currently empty</h2>
            </div>
        EOF;
    }
    else{
    
    foreach($product_list as $product): ?>
    
    <div id="product_box">
    <h2> <?= $product["name"]; ?></h2>
    <img src="<?= $product["img_url"]; ?>" />
    <p><?= $product["description"]; ?></p>
    <h3>Sold by: <?= $product["seller_id"]; ?></h3>
    <!--<h3>amount left in stock: <?= $product["count"]; ?></h3> -->
    <h3>price: $<?= $product["current_price"]; ?></h3>
    <h3>department: <?= $product["department"]; ?></h3>

    <button>Add to Cart</button></br>
    </div>

<?php endforeach; }?>
    
    </div>
</body>