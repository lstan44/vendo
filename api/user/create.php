<?php
include_once '../../auth/Authenticate.php';
include_once '../../config/Database.php';

$db = new Database();

$conn = $db->connect();


$first = $_POST['firstname'];
$last = $_POST['lastname'];
$email = $_POST['email'];
$pwd =  hash('sha256',$_POST['pwd']);
$act = substr (str_replace(' ','',microtime(false)), 2, strlen(str_replace(' ','',microtime(false)))); //generate account number


//check to see if email is taken

$query = "SELECT * FROM users WHERE email='".$email. "'";
$stmt = $conn->prepare($query);
$stmt->execute();

if($stmt->rowCount() > 0){
    //email is already taken

    print<<<EOF
        <script> alert('email already taken. choose another one') </script>
    EOF;

    header('Location: index.php');
}

$sql = "INSERT INTO users(account_number, firstname, lastname, email, pwd)
        VALUES('".$act."', '".$first."', '".$last."','".$email ."','".$pwd."' )  ";

$smt2 = $conn->prepare($sql);

$e = $smt2->execute();

if(! $e){
    print<<<EOF
        <p id="error"></p>
        <script>
        window.onload = ()=> {
            document.getElementById("error").innerHTML="Could not sign you up... try again.";
        }
        </script>
    EOF;
}

else{
    $auth = new Authenticate($db);
    $authIntent = $auth->login($email ,$pwd);

    if( $authIntent['status'] == 1){
    session_start();
    $_SESSION['user_id'] = $authIntent['user_id'];
    
    header('Location: /vendo');
}

}
