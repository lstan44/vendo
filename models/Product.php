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
    
    //method to real all available products
    public function read(){
        $query = 'SELECT product_id,seller_id,name,description,count,current_price,previous_price,department from products';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //method to add a product
    public function add($name, $desc, $price, $img_url, $dept, $count, $seller_id){

        $product_query = "INSERT INTO products(name,description,department,current_price,seller_id)
                          VALUES('".$name."','".$desc."','".$dept."','".$price."','".$seller_id."')";
        $stmt = $this->conn->prepare($product_query);
        $stmt->execute();

        $p_id;
        $sql = "SELECT product_id from products where(name='".$name."')";
        $s = $this->conn->prepare($sql);
        $s->execute();
        while( $row = $s->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $p_id = $product_id;
        }

        $img_query = "INSERT INTO images(img_url, product_id, uploaded_by)
                      VALUES('".$img_url."','".$p_id."','".$seller_id."')";

        $img_stmt = $this->conn->prepare($img_query);
        $img_stmt->execute();
    }

    //method to read a single product given its id
    function read_single($id){
        $query = "SELECT * from products as p join images on images.product_id = p.product_id WHERE p.product_id='".$id."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}

?>
