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
}