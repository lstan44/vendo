<!doctype html>

<html>


<?php

include_once 'config/Database.php';

$db = new Database();
$conn = $db->connect();

$search_term = $_POST['search_box'];

$query = "SELECT * from products where ( description LIKE '%" . $search_term . "%' OR name LIKE '%".$search_term."%')";

$stmt = $conn->prepare($query);

$stmt->execute();

$product_list = array();

// private $product_id;
// private $seller_id;
// private $name;
// private $description;
// private $count;
// private $current_price;
// private $previous_price;
// private $department;

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
        'department' => $department
    );
    array_push($product_list, $temp_arr);

}

 }
?>

<head>
<title>Results for <?php echo $search_term; ?></title>
</head>

<body>

<?php 
    if(!isset($_SESSION['id'])){
        include 'views/header1.php'; //
    }
    else{
        include 'views/header2.php';
    }
?>
<?php foreach($product_list as $product): ?>
    
    <div id="product_box">
    <h2> <?= $product["name"]; ?></h2>
    <p><?= $product["description"]; ?></p>
    <h3>Sold by: <?= $product["seller_id"]; ?></h3>
    <h3>amount left in stock: <?= $product["count"]; ?></h3>
    <h3>price: $<?= $product["current_price"]; ?></h3>
    <h3>department: <?= $product["department"]; ?></h3>

    <button>add to cart</button>
    </div>

<?php endforeach; ?>
</body>



