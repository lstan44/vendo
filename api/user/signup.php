<?php
include_once '../../config/Database.php';
include_once '../../models/User.php';

if(isset($_POST["signup"])){

$database = new Database();
$db = $database->connect();

$user = new User($db);

$first = $_POST["firstname"];
$last = $_POST["lastname"];
$email = $_POST["email"];
$password = hash('sha256',$_POST["password"]);
$acct = '12909874';

$userSignupIntent = json_decode($user->create($first, $last, $email, $password, $acct), true);

if($userSignupIntent['code'] == 400){
    echo "<script> alert('account exists already'); </script>";
}
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class= "container">
      <div class="col-sm-6">
        <form class="" action="signup.php" method="post">
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" class="form-control">
          </div>
          <div class="form-group">
            <label for="firstname">Last Name</label>
            <input type="text" name="lastname" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <input class="btn btn-primary" type="submit" name="signup" value="Signup">
        </form>
      </div>
    </div>
  </body>
</html>
