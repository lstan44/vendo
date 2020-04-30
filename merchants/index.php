<?php

session_start();
if(isset($_SESSION['seller_id']) ){
    header('Location: portal.php');
}
?>

<html>
<head>
<title>Welcome to Vendo Merchants</title>
</head>

<body>

<header>
<nav>

<form action="login.php" method="post">
<input type="email" name="email" placeholder="email" />
<input type="password" name="pwd" placeholder="password"/>
<button type="submit"> Login </button>
</form>
</nav>

 </header>

    <h2>Don't have an account yet? Sign up</h2> </br>

    <div>
    <form action="signup.php" method="post">
    
   First Name: <input type="text" name="firstname" />
   Last Name: <input type="text" name="lastname" />
   Email: <input type="email" name="email" />
   Password: <input type="password" name="pwd" />
   <button type="submit">Sign Up</button>
    </form>
    </div>

</body>

</html>