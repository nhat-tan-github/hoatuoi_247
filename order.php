<?php
// Kết nối đến cơ sở dữ liệu
require "inc/init.php";
require "dialog.php";
$conn = require("inc/db.php");
 require "inc/header.php";


auth::requireLogin();

$query = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_id DESC";
$stmt = $db->getConn()->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của bạn</title>
    <link rel="stylesheet" href="css/order.css"> 
</head>
<body>
    <div class="container">
        <h1>Đơn hàng của bạn</h1>
        <div id="orders-list">
    
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="js/order.js"></script>
</body>
</html>
<?php require "inc/footer.php"; ?>