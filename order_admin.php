<?php
require "inc/init.php";
$conn = require "inc/db.php";
require "inc/header.php";

if (!isset($_SESSION['user_id']) || $_SESSION['usertype'] != 1) {
    header("Location: 404.php"); 
    exit();
}


$userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
if ($userId === null) {
    echo "User ID is missing";
    exit();
}

$user=User::findUsernameById($conn, $userId);
$orders = Order::getByUserID($conn, $userId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng của người dùng</title>
    <link rel="stylesheet" href="ff.css">
</head>

<body>
    <h1>Quản lý đơn hàng của người dùng <?= $user['username'] ?></h1>
    <table>
        <thead>
            <tr>
                <th>ID Đơn hàng</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Hóa đơn</th>
                <th>Thanh toán</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order->order_id ?></td>
                    <td><?= $order->date_create ?></td>
                    <td><?= $order->Status == 1 ? 'Đã giao' : 'Chưa giao' ?></td>
                    <td><?= $order->total ?></td>
                    <td>
                        <input type="checkbox" onchange="markAsStatus(this, <?= $order->order_id ?>)" <?= $order->isPayed == 1 ? 'checked' : '' ?>>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function markAsStatus(checkbox, orderId) {
            var isPayed = checkbox.checked ? 1 : 0; // 1 nếu đã thanh toán, 0 nếu chưa thanh toán
            var currentStatus = checkbox.checked ? 'đã thanh toán' : 'chưa thanh toán';
            var newStatus = checkbox.checked ? 'chưa thanh toán' : 'đã thanh toán';
            if (confirm("Bạn có chắc chắn muốn đánh dấu đơn hàng này là " + newStatus + "?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            alert("Đã đánh dấu đơn hàng " + currentStatus);
                        } else {
                            alert("Đã xảy ra lỗi khi đánh dấu đơn hàng " + newStatus);
                            checkbox.checked = !checkbox.checked; // Đảo ngược trạng thái checkbox
                        }
                    }
                };
                xhr.open("POST", "order_admin.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("order_id=" + orderId + "&is_payed=" + isPayed); 
            } else {
                checkbox.checked = !checkbox.checked; 
            }
        }
    </script>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "inc/init.php";
    $conn = require "inc/db.php";

    $order_id = isset($_POST["order_id"]) ? $_POST["order_id"] : null;
    $is_payed = isset($_POST["is_payed"]) ? $_POST["is_payed"] : null;

    if ($order_id !== null && $is_payed !== null) {
        $query = "UPDATE orders SET isPayed = :is_payed WHERE order_id = :order_id";
        $stmt = $conn->prepare($query);

        // Bind các giá trị vào câu lệnh SQL và thực thi nó
        $stmt->bindValue(':is_payed', $is_payed, PDO::PARAM_INT);
        $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    } else {
        http_response_code(400);
    }
} else {
    http_response_code(405);
}
?>
