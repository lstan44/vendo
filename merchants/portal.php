<?php
session_start();
if(! isset($_SESSION['seller_id'])){
    header('Location: index.php');
}
echo $_SESSION['seller_id'];

include_once '../config/Database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->connect();
$product = new Product($db);
$product_list = array();

$p_query = "SELECT * from products as p,images as i where(p.product_id = i.product_id AND p.seller_id=".$_SESSION['seller_id'].")";

$stmt = $db->prepare($p_query);
$stmt->execute();
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
        'img_url'=> $img_url
    );
    array_push($product_list, $temp_arr);
}


?>

<html>
<head>
<title>Welcome to your Merchant portal</title>

</head>

<body>
    <header>
        <nav>
        <form action="logout.php" method="post">
        <button type="submit">Logout</button>
        </form>
        </nav>
     </header>
     

     <div id="main"> 
            <h2>Welcome to your Merchant Portal </h2>
            <h3> Below you can see your products, add new products, and remove your products from the store </h3>

           

            <div id="product_modal" class="modal">
            <div class="product_modal_content">
                

                <form method="post" action="add_product.php" enctype="multipart/form-data">
                    Product Name: <input type="text" name="name" /> </br>
                    Description: <textarea name="description" rows="5" cols="50"> </textarea> </br>
                    Product Images: <input type="file" name="images" accept="image/*,video/*" multiple></br>
                    How many in stock?: <input type="number" name="count" /></br>
                    Department: <input type="text" name="department" /></br>
                    Price: <input type="number" name="price" step="0.01"/></br>
                    <button type="submit" name="submit">Add product </button></br>
                </form>
            </div>
            </div>
     </div>


     <div id="current_products">

    <?php 
    if(empty($product_list) ){
        print<<<EOF
            <div id="product_box">
                <h2> You currently do not have any item listed in the store. </h2>
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
    <h3>amount left in stock: <?= $product["count"]; ?></h3>
    <h3>price: $<?= $product["current_price"]; ?></h3>
    <h3>department: <?= $product["department"]; ?></h3>

    <button>Remove from Store</button></br>
    <button>Update Listing </button> </br>
    </div>

<?php endforeach; }?>
     </div>
</body>
</html>