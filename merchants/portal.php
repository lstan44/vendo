<?php
session_start();
if(! isset($_SESSION['seller_id'])){
    header('Location: index.php');
}
echo $_SESSION['seller_id'];

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

            <button id="add_product"> Add New Product </button>

            <div id="product_modal" class="modal">
            <div class="product_modal_content">
                <span class="close">&times; </span>

                <form method="post" action="add_product.php">
                    Product Name: <input type="text" name="name" /> </br>
                    Description: <textarea name="description" rows="5" cols="50"> </textarea> </br>
                    Product Images: <input type="file" name="images" accept="image/*,video/*" multiple></br>
                    How many in stock?: <input type="number" name="count" /></br>
                    Department: <input type="text" name="department" /></br>
                    Price: <input type="number" name="price" step="0.01"/></br>
                    <button type="submit">Add product </button></br>
                </form>
            </div>
            </div>
     </div>
</body>
</html>