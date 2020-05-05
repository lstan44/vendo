<?php

include_once 'auth/Authenticate.php';
include_once 'config/Database.php';
?>

<!doctype html>
<html>
<head>
<title>Sign Up</title>
</head>

<body>
    <form action="api/user/create.php" method="post">
    Firstname: <input type="text" name="firstname" />
    Lastname: <input type="text" name="lastname" />
    Email: <input type="email" name="email" />
    Password: <input type="password" name="pwd" />
    <button type="submit" name="submit"> Sign Up </button>

    </form>
</body>
</html>