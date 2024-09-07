<?php
class Order {
    public $order_id;
    public $user_id;
    public $date_create;
    public $status;
    public $isPayed;
    public $total;

    public function __construct($user_id = null, $date_create = null, $status = null, $isPayed = null, $total = null) {
        $this->user_id = $user_id;
        $this->date_create = $date_create;
        $this->status = $status;
        $this->isPayed = $isPayed;
        $this->total = $total;
    }

    public static function count($conn) {
        try {
            $sql = "SELECT COUNT(order_id) FROM orders";
            return $conn->query($sql)->fetchColumn();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    public static function getAll($conn) {
        try {
            $sql = "SELECT * FROM orders ORDER BY date_create DESC";
            $stmt = $conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Order');
            if($stmt->execute()) {
                $orders = $stmt->fetchAll();
                return $orders;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public static function getByID($conn, $order_id) {
        try {
            $sql = "SELECT * FROM orders WHERE order_id = :order_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Order');
            if($stmt->execute()) {
                $order = $stmt->fetch();
                return $order;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function deleteByID($conn) {
        try {
            $sql = "DELETE FROM orders WHERE order_id = :order_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':order_id', $this->order_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
   
    public static function getByUserID($conn, $user_id) {
        try {
            $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY date_create DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Order');
            if($stmt->execute()) {
                $orders = $stmt->fetchAll();
                return $orders;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    public static function NewOrder($conn) {

        try {$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            if ($user_id !== null){
            $query = "INSERT INTO orders (user_id, date_create) VALUES (:user_id, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
    
            $lastOrderId = $conn->lastInsertId();
    
            return $lastOrderId;}
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public static function updateIsPayed($conn, $order_id, $isPayed) {
        try {
            $sql = "UPDATE orders SET isPayed = :isPayed WHERE order_id = :order_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':isPayed', $isPayed, PDO::PARAM_INT);
            $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Trả về true nếu cập nhật thành công
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }
}
?>

 
