<?php

class Product{

    private $product_id;
    private $seller_id;
    private $name;
    private $description;
    private $count;
    private $current_price;
    private $previous_price;
    private $department;

    private $conn;
    private $table = 'products';


    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT product_id,seller_id,name,description,count,current_price,previous_price,department from products';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}