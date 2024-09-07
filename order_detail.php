<?php
// Kết nối đến cơ sở dữ liệu
require "inc/init.php";
require "dialog.php";
$conn = require("inc/db.php");
require "inc/header.php";

// Lấy order_id từ tham số truyền vào
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} else {
    header("Location: orders.php");
    exit();
}

// Lấy chi tiết đơn hàng từ cơ sở dữ liệu
$query = "SELECT od.*, f.price FROM order_detail od INNER JOIN flowers f ON od.product_id = f.id WHERE od.order_id = ?";
$stmt = $db->getConn()->prepare($query);
$stmt->execute([$order_id]);
$order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT *, users.username FROM orders INNER JOIN users on users.id= orders.user_id WHERE order_id = ?";
$stmt = $db->getConn()->prepare($query);
$stmt->execute([$order_id]);
$order_info = $stmt->fetch(PDO::FETCH_ASSOC);


$paymentStatus = $order_info['isPayed'] == 1 ? 'Đã thanh toán' : 'Chưa thanh toán';
$DeliverStatus = $order_info['Status'] == 1 ? 'Đã Giao' : 'Chưa giao';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
</head>

<body>
    <div class="content">
    <h1>Chi tiết đơn hàng #<?= $order_id ?></h1>
    <p>Tên khách hàng: <?= $order_info['username'] ?></p>

    <p>Ngày tạo: <?= $order_info['date_create'] ?></p>
    <p>Tổng tiền: <?= $order_info['total'] ?></p>
    <p>Trạng thái thanh toán: <?= $paymentStatus ?></p>
    <p>Trạng thái giao hàng: <?= $DeliverStatus ?></p>


    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_details as $order_detail) : ?>
                <tr>
                    <td><?= $order_detail['product_name'] ?></td>
                    <td><?= $order_detail['quantity'] ?></td>
                    <td><?= $order_detail['price'] ?></td>
                    <td><?= $order_detail['total_amount'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>

</html>
<? require "inc/footer.php"; ?>
