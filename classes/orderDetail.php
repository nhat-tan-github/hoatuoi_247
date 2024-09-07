<?php
class OrderDetail {
    public $id;
    public $user_id;
    public $order_id;
    public $product_id;
    public $product_name;
    public $quantity;
    public $recipient;
    public $phone_number;
    public $address;
    public $note;
    public $total_amount;

    public function __construct($user_id = null, $order_id = null, $product_id = null, $product_name = null, $quantity = null, $recipient = null, $phone_number = null, $address = null, $note = null, $total_amount = null) {
        $this->user_id = $user_id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->quantity = $quantity;
        $this->recipient = $recipient;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->note = $note;
        $this->total_amount = $total_amount;
    }
    public static function calTotalByOrderID($conn, $order_id) {
        try {
            $sql = "SELECT SUM(total_amount) AS total FROM order_detail WHERE order_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$order_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public static function addOrderDetail($conn, $user_id, $order_id, $product_id, $product_name, $recipient, $phone_number, $address, $note, $total_amount, $quantity) {
        try {
            $query = "INSERT INTO order_detail (user_id, order_id, product_id, product_name, recipient, phone_number, address, note, total_amount, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$user_id, $order_id, $product_id, $product_name, $recipient, $phone_number, $address, $note, $total_amount, $quantity]);
            
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public static function getByOrderId($conn, $order_id) {
        try {
            $sql = "SELECT * FROM order_detail WHERE order_id = :order_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'OrderDetail');
            if($stmt->execute()) {
                $orderDetails = $stmt->fetchAll();
                return $orderDetails;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    
}
?>
