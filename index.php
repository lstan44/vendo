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

<div data-vide-bg="#" id="searchbg">
    <div class="container">
		<div class="banner-info">
			<h3>Search for anything: clothes, outdoors accessories, etc.</h3>	
			<div class="search-form">
				<form action="search.php" method="post">
					<input type="text" placeholder="Search..." name="search_box">
					<input type="submit" value=" " >
				</form>
			</div>		
		</div>	
    </div>
</div>

    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
    <script src="js/jquery.vide.min.js"></script>



<!--content-->
<div class="content-mid">
	<div class="container">
		
		<div class="col-md-4 m-w3ls">
			<div class="col-md1 ">
				<a href="search.php?s=outdoors">
					<img src="images/outdoors.jpg" class="img-responsive img" alt="">
					<div class="big-sa">
						<h6>New Collections</h6>
						<h3>Out<span>doors </span></h3>
						<p>Shop from our outdoors category </p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-4 m-w3ls1">
			<div class="col-md ">
				<a href="search.php?s=electronics">
					<img src="images/electronics.jpg" class="img-responsive img" alt="">
					<div class="big-sale">
						<div class="big-sale1">
							<h3>Big <span>Sale</span></h3>
							<p>We are having a huge sale on electronics </p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-4 m-w3ls">
			<div class="col-md2 ">
				<a href="search.php?s=furnitures">
					<img src="images/furnitures.jpg" class="img-responsive img1" alt="">
					<div class="big-sale2">
						<h3>Home<span>Furnitures</span></h3>
						<p>Get furnitures delivered to your living room!</p>		
					</div>
				</a>
			</div>
			<div class="col-md3 ">
				<a href="search.php?s=fashion">
					<img src="images/fashion.jpg" class="img-responsive img1" alt="">
					<div class="big-sale3">
						<h3>Fash<span>ion</span></h3>
						<p>Get the latest in fashion here.</p>
					</div>
				</a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--content-->


<!--content-->
	<div class="product">
		<div class="container">
			<div class="spec ">
				<h3>Our Newest Products</h3>
				<div class="ser-t">
					<b></b>
					<span><i></i></span>
					<b class="line"></b>
				</div>
			</div>
				<div class=" con-w3l">


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

						
		</div>
	</div>

	<?php

	include 'footer.php';

	?>