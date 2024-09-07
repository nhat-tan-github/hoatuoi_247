<?php
require "inc/init.php";
$conn = require "inc/db.php";
require "inc/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['usertype'] != 1) {
    header("Location: index.php"); 
    exit();
}

$query = "SELECT * FROM users WHERE usertype = 0";
$stmt = $db->getConn()->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="content">
    <ul class="nav-list">
        <li class="item" style="display: inline-block; margin-right: 20px;"><a href="adduser.php" class="btn">Thêm người dùng</a></li>
        <li class="item" style="display: inline-block; margin-right: 20px;"><a href="banuser.php" class="btn">Cấm người dùng</a></li>
    </ul>

    <h2>Danh sách người dùng (khách hàng)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Trạng thái họat động</th>
                <th>Đơn hàng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['active'] == 1 ? 'Bị Ban' : 'Kích Hoạt' ?></td>
                    <td>
                        <a href="order_admin.php?user_id=<?= $user['id'] ?>">Xem đơn hàng</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require "inc/footer.php"; ?>
