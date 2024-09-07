<?php

require "inc/init.php";
require "dialog.php";
$conn = require("inc/db.php");
 require "inc/header.php";
 
 auth::requireLogin();
$query = "SELECT * FROM orders WHERE user_id IN (SELECT id FROM users WHERE usertype = 0) ORDER BY order_id DESC";
$stmt = $db->getConn()->prepare($query);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của tôi</title>
</head>

<body>
    <h1>Đơn hàng của tôi</h1>
    <?php if ($orders) : ?>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày tạo</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['date_create']; ?></td>
                        <td><?php echo $order['total']; ?></td>
                        <td><?php echo ($order['delivered'] == 1) ? 'Đã giao hàng' : 'Chưa giao hàng'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Không có đơn hàng nào.</p>
    <?php endif; ?>
</body>

</html>
<?php require_once "inc/footer.php"; ?>

