<?php

session_start();
//$_SESSION['pid'] = array();
if(isset($_SESSION['id'])){
    include 'views/header2.php';
}
else{
    include 'views/header1.php';
}
$action;
if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if( !empty($action) && $action == 'add'){
    if(!in_array($_GET['pid'], $_SESSION['pid'])){
        array_push($_SESSION['pid'], $_GET['pid']);
    }
}

if(!empty($action) && $action == 'remove'){
    if(!empty($_GET['id']) && in_array($_GET['id'], $_SESSION['pid'])){
        $key = array_search($_GET['id'], $_SESSION['pid']);
        unset($_SESSION['pid'][$key]);
    }
}

include_once 'config/Database.php';
include_once 'models/Product.php';

$db = new Database();
$product = new Product($db->connect());
$product_list = array();

foreach($_SESSION['pid'] as $id){
    $prod = $product->read_single($id);

    while($row = $prod->fetch(PDO::FETCH_ASSOC ) ){
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
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 80%;
  
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<form action="pay.php" method="post" id="payment-form">
<table>
<tr>
    <th>Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Remove</th>
</tr>


<?php
$total = 0;
foreach($product_list as $item): 

    $total += $item['current_price'];
?>

<tr>
    <td style="text-align:left;"><?= $item['name']; ?></td>
    <td><input type="number" name="quantity" min="1" max="5" ></td>
    <td><?= $item['current_price']; ?></td>
    <td style="text-align:center;">
    <a href="cart.php?action=remove&id=<?php echo $item["product_id"]; ?>" class="btnRemoveAction">
    <img src="images/delete.png" alt="Remove Item" width="30" height="30" />
        </a>
    </td>
    
</tr>
<?php
endforeach;
?>

<tr>
    <td>Total</td>
    <td></td>
    <td><?php echo $total; ?></td>
    <td></td>
</tr>

</table>

<div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display Element errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <button>Submit Payment</button>
<!-- <button type="submit"> PLace Order Now </button> -->

</form>


<script>
    // Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
var stripe = Stripe('pk_test_jLHV36Sv5rW0SzDoaNI0W1EI00XXr6wZg5');
var elements = stripe.elements();


var style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '16px',
    color: '#32325d',
  },
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');


var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the customer that there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});


function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}



</script>

<?php include 'footer.php'; ?>