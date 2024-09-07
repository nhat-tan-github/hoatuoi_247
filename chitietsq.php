<?php 
require "inc/init.php";
$conn = require("inc/db.php");
require "inc/header.php";
$_SESSION['trang_chi_tiet_gio_hang'] = "co";
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Thực hiện truy vấn
$sql = "SELECT * FROM flowers WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
echo '<div class="content">';
// Kiểm tra xem sản phẩm có tồn tại không
if ($product) {
    echo "<table>";
    echo "<tr>";
    echo "<td width='250px' align='center' >";
    echo "<img src='uploads/{$product['imagefile']}' width='150px' >"; // Sửa đường dẫn ảnh ở đây
    echo "</td>";
    echo "<td valign='top' >";
    echo "<a href='#'>";
    echo $product['name'];
    echo "</a>";
    echo "<br>";
    echo "<br>";
    echo $product['description'];
    echo "<br>";
    echo "<br>";
    echo $product['price'] .' '.'VND';
    echo "<br>";
    echo "<br>";
    echo "<form method='POST' action='giohang.php' style='display: inline-block;'>"; // Sửa action để gửi đến giohang.php
    echo "<input type='hidden' name='thamso' value='gio_hang' > ";
    echo "<input type='hidden' name='id' value='".htmlspecialchars($product['id'])."' > "; // Sử dụng htmlspecialchars để tránh mã hóa HTML
    echo "<input type='text' name='so_luong' value='1' style='width:50px' > ";
    echo "<input class='butn' type='submit' value='Thêm vào giỏ hàng'  > ";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "Không tìm thấy sản phẩm.";
}
echo '</div>';
?>
<?php require "inc/footer.php"; ?>

