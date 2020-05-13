<!doctype html>

<html>


<?php
session_start();
include_once 'config/Database.php';

$db = new Database();
$conn = $db->connect();
$search_term;
if(isset($_POST['search_box'])){
    $search_term = $_POST['search_box'];
}
else if(isset($_GET['s'])){
    $search_term = $_GET['s'];
}

else{
    $search_term = "fashion";
}


$query = "SELECT * from products as p, images as i where ( (description LIKE '%" . $search_term . "%' OR name LIKE '%".$search_term."%') AND (p.product_id = i.product_id) )";

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
        'status'=> 0
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
?>
<?php 
    if(!isset($_SESSION['id'])){
        include 'views/header1.php'; //
    }
    else{
        include 'views/header2.php';
    }
?>
<?php

if(empty($product_list['status'] = 0)){
    echo '<h2> No item found for the search term </h2>';
}
else{
foreach($product_list as $product): ?>
                            <div class="col-md-3 pro-1">
								<div class="col-m">
								<a href="single.php?id=<?= $product['product_id']; ?>" class="offer-img">
										<img src="<?= $product["img_url"]; ?>" class="img-responsive" alt="">
									</a>
									<div class="mid-1">
										<div class="women">
											<h6><a href="single.php?id=<?= $product['product_id']; ?>"><?= $product["name"]; ?></a></h6>							
										</div>
										<div class="mid-2">
											<p ><label>$7.00</label><em class="item_price">$<?= $product["current_price"]; ?></em></p>
											  <div class="block">
												<div class="starbox small ghosting"> </div>
											</div>
											<div class="clearfix"></div>
										</div>
											<div class="add">
												<form method="post" action="cart.php?action=add&pid=<?= $product['product_id']; ?>" >
										   <button type="submit" class="btn btn-danger my-cart-btn my-cart-b">Add to Cart</button>
												</form>
										</div>
									</div>
								</div>
							</div>

<?php endforeach; }?>


<?php include 'footer.php'; ?>
