<?php

class User{
    private $conn;
    private $table = 'users';

    public $user_id;
    public $account_number;
    public $firstname;
    public $lastname;
    public $email;

    public function __construct($db){
        $this->conn = $db;
    }

    public function readall(){
        $query = 'SELECT user_id,account_number, firstname,lastname,email from users';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($first, $last, $email, $pass, $acct){
        $query = "INSERT into users(firstname,lastname,email,password,account_number)
                                VALUES( '". $first . "','". $last. "','".$email ."','". $pass."','". $acct ."')";
        // $query = "INSERT INTO users(firstname,lastname,email,password,account_number)
        // //                     VALUES('testfirst','testlast','testemail@gmail.com','testpwd','1111009')";
        try{                        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        }
        catch(PDOException $e){
           if($e->getCode() == 23000){
               return json_encode(array(
                   'message'=> 'account already exists',
                   'code' => 400
               ));
           }
           return $stmt;
        }

    }
}