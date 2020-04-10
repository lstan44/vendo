<?php

header('Access-Control-Allow_Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';


$database = new Database();
$db = $database->connect();

$user = new User($db);

$result = $user->readall();
$user_count = $result->rowCount();

if($user_count >0){
    $user_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user_item = array(
            'user_id'=>$user_id,
            'account_number'=> $account_number,
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'email' => $email
        );

        array_push($user_arr,$user_item);
    }
    echo json_encode($user_arr);
}
else{
    echo json_encode(
        array('message' => 'No user was found')
    );
}
