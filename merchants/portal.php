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
</body>
</html>