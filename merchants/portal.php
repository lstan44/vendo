<?php
session_start();
if(! isset($_SESSION['seller_id'])){
    header('Location: index.php');
}
//echo $_SESSION['seller_id'];

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

<!doctype html>
<html>
    <head>

    <title>Welcome <?php echo $_SESSION['first']; ?></title>
  

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<?php include 'sidebar.php'; ?>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Your Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
                           <h2><?php echo $_SESSION['first']; ?></h2> 
                           <h2><?php echo $_SESSION['last']; ?></h2>
                           <h3><?php echo $_SESSION['email']; ?></h3>

		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
</div>
</body>