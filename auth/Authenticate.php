<?php

class Authenticate{
    private $conn;

    function __construct($db){
        $this->conn = $db->connect();
    }

    public function login($email, $pwd_){
        
        $res = array();

        $query = "SELECT pwd from users where email ='".$email ."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $count = $stmt->rowCount();

        echo "row from first query: ". $count . PHP_EOL;  ///////////// 

        if($count <= 0){
            $res =  array(
                'status' => 0,
                'message' => 'no user found.'
            );
            return $res;
            var_dump($res);  /////////////////
        }

        if($count > 0){
            $pass;

            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $pass = $pwd;

            echo "Pwd: ". $pass . PHP_EOL;  ///////////////////////
            }

            $sql = "SELECT user_id, account_number, firstname, lastname from users where pwd='".$pwd_."' ";
            $stmt2 = $this->conn->prepare($sql);
            $stmt2->execute();
            echo "row from first second: ". $stmt2->rowCount() . PHP_EOL;  ///////////// 

            if($stmt2->rowCount() <= 0){
                
                $res =  array(
                    'status' => 0,
                    'message' => 'Password incorrect'
                );
            }

           while( $result = $stmt2->fetch(PDO::FETCH_ASSOC) ){
            extract($result);

            $res =  array(
                'status'=> 1,
                'message'=> 'logged in successfully',
                'user_id'=> $user_id,
                'account_number'=> $account_number,
                'firstname' => $firstname,
                'lastname' => $lastname
            );

            //var_dump($res);
        }
    }

   return $res;
}

} 