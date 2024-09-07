<?php
require "inc/init.php";
$conn = require("inc/db.php");
require "inc/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["orderId"]) && isset($_POST["Status"])) {
        $orderId = $_POST["orderId"];
        $Status = $_POST["Status"];

        $sql = "UPDATE orders SET Status = :Status WHERE order_id = :order_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":order_id", $orderId, PDO::PARAM_INT);
        $stmt->bindParam(":Status", $Status, PDO::PARAM_INT);
        $stmt->execute();
    }
}

// Lấy ID của người dùng hiện tại
$currentUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Kiểm tra xem người dùng là admin hay không
$is_admin = $user->checkuser($conn, $_SESSION['name']);

if ($is_admin) {
    $sql = "SELECT orders.*, users.username FROM orders INNER JOIN users ON orders.user_id = users.id";
    $stmt = $conn->query($sql);
} else {
    $sql = "SELECT orders.*, users.username FROM orders INNER JOIN users ON orders.user_id = users.id WHERE orders.user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user_id", $currentUserId, PDO::PARAM_INT);
}

echo "<div class='content'>";
if (!$stmt) {
    echo "Lỗi: " . $conn->errorInfo()[2];
} else {
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Ngày tạo</th>
                        <th>Tổng tiền</th>
                        <th>Đã giao</th>
                        <th>Chi tiết</th>
                    </tr>";

            // In dữ liệu từ bảng `orders`
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>" . $row["order_id"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["date_create"] . "</td>
                        <td>" . $row["total"] . "</td>
                        <td><input type='checkbox' onchange='markAsStatus(this, " . $row['order_id'] . ")' " . ($row['Status'] ? 'checked' : '') . "></td>
                        <td><button class='butn' onclick='viewOrderDetails(" . $row['order_id'] . ")'>Chi tiết</button></td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "Không có dữ liệu trong bảng `orders`";
        }
    } else {
        echo "Có lỗi xảy ra khi thực hiện truy vấn.";
    }
}
echo "</div>";
// Đóng kết nối
$conn = null;
?>

<script>
    function markAsStatus(checkbox, orderId) {
        var Status = checkbox.checked ? 1 : 0; // 1 nếu đã giao, 0 nếu chưa giao
        if (confirm("Bạn có chắc chắn muốn đánh dấu đơn hàng này là đã giao?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert("Đã đánh dấu đơn hàng đã giao!");
                    } else {
                        alert("Đã xảy ra lỗi khi đánh dấu đơn hàng đã giao!");
                        checkbox.checked = !checkbox.checked; // Đảo ngược trạng thái checkbox
                    }
                }
            };
            xhr.open("POST", "ordermanagement.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("orderId=" + orderId + "&Status=" + Status); // Gửi trạng thái đã giao
        }
    }

    function viewOrderDetails(orderId) {
        window.location.href = `order_detail.php?order_id=${orderId}`;
    }
</script>

<?php require "inc/footer.php"; ?>

