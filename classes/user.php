<?php
    class User{
        // Delcare Propertys of DB
        public $id;
        public $username;
        public $password;

        
        // Authentication User
        public static function authenticate($connection, $username, $password)
        {
            $sql = "select * from users where username=:username";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':username',$username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $stmt->execute();
            $user = $stmt->fetch();
            if($user)
            {
                $hash = password_hash( $user->password,PASSWORD_DEFAULT);
                // Check password input with password Hash
                return password_verify($password, $hash);
            }
            // Return false if the user not found 
            return false;
        }
    
            /*
                Kiểm tra thông tin nhập
            */
            private function validate(){
                return $this->username != '' &&
                       $this->password != '';
            }
        /*
            Thêm mới user
        */
        public function addUser($conn){
               if($this->validate()){
                $sql = "insert into `users`( `username`, `password`) values (:username, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':username',$this->username, PDO::PARAM_STR);
                $hash = password_hash( $this->password,PASSWORD_DEFAULT);
                $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
                return $stmt->execute();
               }else{
                    return false;
               }
        }
        public function banUser($conn, $username){
            $sql = "UPDATE `users` SET `active` = 1 WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            return $stmt->execute(); 
        }
        public function unbanUser($conn, $username){
            $sql = "UPDATE `users` SET `active` = 0 WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            return $stmt->execute(); 
        }
        
        public function checkuser($conn, $username){
            $sql = "SELECT * FROM users WHERE username=:username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute(); 
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            if (!empty($rs)) {
                return $rs[0]['usertype'];
            } else {
                return null;
            }
        }
        
        
        public function active($conn, $username){
            $sql = "select * from users where username='".$username."'";
            $stmt = $conn->prepare($sql);
            $stmt->execute(); 
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $rs = $stmt->fetchAll(); 
            return $rs[0]['active'];           
        }

        public static function isUsernameExists($connection, $username){
        $sql = "SELECT COUNT(*) as count FROM users WHERE username = :username";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;

}
public function getUserId($conn, $username) {
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return $row['id']; // Trả về user_id nếu tìm thấy
    } else {
        return null; // Trả về null nếu không tìm thấy
    }
}
public function getUsertype($conn, $username) {
    $query = "SELECT usertype FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return $row['usertype']; // Trả về user_id nếu tìm thấy
    } else {
        return null; // Trả về null nếu không tìm thấy
    }
}

public static function findUsernameById($conn, $user_id) {
    try {
        $sql = "SELECT username FROM users WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
}



?>