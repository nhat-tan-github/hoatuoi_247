<?php
require "inc/init.php";
$conn = require "inc/db.php";
require "inc/header.php";

// Kiểm tra nếu user_id được truyền vào
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Lấy danh sách đơn hàng của người dùng từ cơ sở dữ liệu
    $query = "SELECT * FROM orders WHERE user_id = ?";
    $stmt = $db->getConn()->prepare($query);
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Hiển thị thông tin người dùng
    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $db->getConn()->prepare($query);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

    <div class="content">
        <h1>Quản lý đơn hàng của <?= $user['username'] ?></h1>
        <ul class="order-list">
            <?php foreach ($orders as $order) : ?>
                <li>
                    <a href="edit_order.php?order_id=<?= $order['order_id'] ?>">
                        Đơn hàng #<?= $order['order_id'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php
} else {
    // Nếu không có user_id, chuyển hướng người dùng đến trang quản lý người dùng
    header("Location: manage_users.php");
    exit();
}

require "inc/footer.php";
?>
