<?php
require "inc/init.php";
$conn = require "inc/db.php";
require "inc/header.php";

ob_start();

function thong_bao_html_roi_chuyen_trang($message, $redirect_url) {
    echo "<p>$message</p>";
    echo "<script>setTimeout(function() { window.location.href = '$redirect_url'; }, 3000);</script>";
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

if (isset($_POST['delete_item'])) {
    $delete_id = $_POST['delete_item'];
    unset($_SESSION["cart"][$delete_id]);
    echo "<div ><p style='text-align: center;'>Sản phẩm đã được xóa khỏi giỏ hàng.</p>";
}

if (isset($_POST['delete_all']) && $_POST['delete_all'] === 'true') {
    unset($_SESSION["cart"]);
    echo "<div ><p style='text-align: center;'>Tất cả sản phẩm đã được xóa khỏi giỏ hàng.</p>";
}

if (isset($_POST['update_click'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        if ($quantity > 0) {
            $_SESSION["cart"][$product_id] = $quantity;
        } else {
            unset($_SESSION["cart"][$product_id]);
        }
    }
    echo "<p style='text-align: center;'>Số lượng sản phẩm đã được cập nhật.</p>";
}

if (isset($_POST['thamso']) && $_POST['thamso'] === 'gio_hang') {
    $product_id = $_POST['id'];
    $quantity = $_POST['so_luong'];

    if (isset($_SESSION["cart"][$product_id])) {
        $_SESSION["cart"][$product_id] += $quantity;
    } else {
        $_SESSION["cart"][$product_id] = $quantity;
    }

    echo "<p style='text-align: center;'>Sản phẩm đã được thêm vào giỏ hàng.</p>";
}

if (!empty($_SESSION["cart"])) {
    $productIds = implode(",", array_keys($_SESSION["cart"]));
    $query = "SELECT * FROM `flowers` WHERE `id` IN ($productIds)";
    $stmt = $db->getConn()->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPrice = 0;
    foreach ($products as $row) {
        $subtotal = floatval($row['price']) * intval($_SESSION["cart"][$row['id']]);
        $totalPrice += $subtotal;
    }
}

if (isset($_POST['order_click'])) {
    $recipient = isset($_POST['name']) ? $_POST['name'] : '';
    $phoneNumber = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $note = isset($_POST['note']) ? $_POST['note'] : '';
    $totalOrderAmount = 0;

    if (!empty($recipient) && !empty($phoneNumber) && !empty($address)) {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if ($userId !== null) {
            $orderId = Order::NewOrder($conn);

            foreach ($_SESSION["cart"] as $productId => $quantity) {
                $query = "SELECT * FROM flowers WHERE id = ?";
                $stmt = $db->getConn()->prepare($query);
                $stmt->execute([$productId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $productName = $row['name'];
                    $unitPrice = $row['price'];
                    $totalAmount = $unitPrice * $quantity;

                    Flower::addBought($conn, $productId, $quantity);

                    $query = "INSERT INTO order_detail ( user_id, order_id, product_id, product_name, recipient, phone_number, address, note, total_amount, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $db->getConn()->prepare($query);
                    $stmt->execute([$userId, $orderId, $productId, $productName, $recipient, $phoneNumber, $address, $note, $totalAmount, $quantity]);
                }
            }

            $totalOrderAmount = OrderDetail::calTotalByOrderID($conn, $orderId); 

            $query = "UPDATE orders SET total = ? WHERE order_id = ?";
            $stmt = $db->getConn()->prepare($query);
            $stmt->execute([$totalOrderAmount, $orderId]);

            unset($_SESSION["cart"]);

            thong_bao_html_roi_chuyen_trang("Cảm ơn bạn đã mua hàng tại website chúng tôi", "index.php");
        } else {
            echo "<p style='text-align: center;'>Vui lòng đăng nhập để đặt hàng.</p>";
        }
    } else {
        echo "<p style='text-align: center;'>Vui lòng nhập đầy đủ thông tin (Tên người nhận, Số điện thoại, Địa chỉ) để đặt hàng.</p>";
    }
}





?>
<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        
        .center-image {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if (!empty($products)) {
        ?>
        <form id="cart-form" action="giohang.php?action=submit" method="POST">
            <table>
                <tr>
                    <th class="product-number">STT</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="product-img">Ảnh sản phẩm</th>
                    <th class="product-price">Đơn giá</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="total-money">Thành tiền</th>
                    <th class="product-delete">Xóa</th>
                </tr>
                <?php
                $num = 1;
                foreach ($products as $row) {
                    ?>
                    <tr>
                        <td class="product-number"><?= $num++; ?></td>
                        <td class="product-name"><?= $row['name'] ?></td>
                        <td class="product-img center-image"><img src="uploads/<?= $row['imagefile'] ?>" width="100" /></td>
                        <td class="product-price"><?= $row['price'] ?></td>
                        <td class="product-quantity"><input type="text" value="<?= $_SESSION["cart"][$row['id']] ?>"
                                                             name="quantity[<?= $row['id'] ?>]" /></td>
                        <?php
                        $subtotal = floatval($row['price']) * intval($_SESSION["cart"][$row['id']]);
                        ?>
                        <td class="total-money"><?= number_format($subtotal, 0, '', '') ?></td>
                        <td class="product-delete">
                            <button class="butn" style='margin-right:70px' type="submit" name="delete_item" value="<?= $row['id'] ?>">Xóa</button>
                        </td>
                    </tr>
                    <?php
                } ?>
                <tr id="row-total">
                    <td class="product-number">&nbsp;</td>
                    <td class="product-name">Tổng tiền</td>
                    <td class="product-img">&nbsp;</td>
                    <td class="product-price">&nbsp;</td>
                    <td class="product-quantity">&nbsp;</td>
                    <td class="total-money"><?= number_format($totalPrice, 0, '', '') ?></td> <!-- Hiển thị tổng tiền -->
                    <td class="product-delete">
                        <form action="giohang.php" method="POST">
                            <button class="butn" style='margin-right:55px' type="submit" name="delete_all" value="true">Xóa tất cả</button>
                        </form>
                    </td>
                </tr>
            </table>
            <div id="form-button">
                <input class="butn" style='margin-right:63px' type="submit" name="update_click" value="Cập nhật"/>
            </div>
            <hr>
            <form action="giohang.php" method="POST">
                <div><label>Người nhận: </label><input type="text" value="" name="name"/></div>
                <div><label>Điện thoại: </label><input type="text" value="" name="phone"/></div>
                <div><label>Địa chỉ: </label><input type="text" value="" name="address"/></div>
                <div><label>Ghi chú: </label><textarea name="note" cols="50" rows="7"></textarea></div>
                <input class="butn" type="submit" name="order_click" value="Đặt hàng"/>
            </form>
        </form>
        <?php
    } else {
        echo "<p style='text-align: center;'>Không có sản phẩm nào trong giỏ hàng.</p>";
    }
    ?>

</div>
</body>
</html>

<?php require "inc/footer.php"; ?>

<?php
ob_end_flush(); 
?>

