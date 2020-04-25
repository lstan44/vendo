<?

include_once '../../config/Database.php';

class Authenticate{

    private $conn = new Database()->connect();

    public function login($email, $pwd){
        $query = 'SELECT password from users where email = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $count = $stmt->rowCount();

        if($count <= 0){
            return array(
                'status' => 0,
                'message' => 'no user found.'
            );
        }

        if($count > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $pass = $password;

            $sql = "SELECT user_id, account_number, firstname, lastname from users where password ='" .$pass."'";
            $stmt2 = $this->conn->prepare($sql);
            $stmt2->execute();
            
            if($stmt2->rowCount() < 0){
                return array(
                    'status' => 0,
                    'message' => 'Password incorrect'
                );
            }

            $result = $stmt2->fetch(PDO::FETCH_ASSOC);
            extract($result);

            return array(
                'status'=> 1,
                'message'=> 'logged in successfully',
                'user_id'=> $user_id,
                'account_number'=> $account_number,
                'firstname' => $firstname,
                'lastname' => $lastname
            );
    }
}




} //class ends here