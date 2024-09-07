<?php
require "inc/init.php";
$conn = require "inc/db.php";
/* Gọi tập tin header */
require "inc/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    
</head>
<body>
<div class="content">
<div class="search-container">
    <form name="frmSEARCH" method="post">
        <fieldset>
            <legend style="color: black;">Tìm kiếm sản phẩm</legend>
            <div class=row>
        
                <input type="text" name="name" placeholder="Bạn muốn tìm sản phẩm gì">
            </div>
            <div class=row>
                <input class="btn" type="submit" value="Tìm">
                <input class="btn" type="reset" value="Xóa">
            </div>
        </fieldset>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        // Kiểm tra xem kết nối có thành công không
        if (!$conn) {
            die("Kết nối thất bại: " . $conn->errorInfo()[2]);
        }
        // Thực hiện xác thực
        $query = "SELECT `id`, `name`, `description`, `price`, `imagefile` FROM `flowers` WHERE name LIKE :searchTerm";
        $stmt = $conn->prepare($query);
        $searchTerm = '%' . $name . '%';
        $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        // Kiểm tra xem có kết quả trả về không
        if ($stmt->rowCount() > 0) {
            ?>
            <section class="products" id="products">
                <div class="box-container">
                    <?php
                    // Lặp qua kết quả và hiển thị
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="box">
                            <span class="discount">-10%</span>
                            <div class="image">
                                <img src="uploads/<?php echo htmlspecialchars($row['imagefile']); ?>" alt="">
                                <div class="icons">
                                    <a href="chitietsq.php?id=<?php echo htmlspecialchars($row['id']); ?>"
                                       class="cart-btn">Đặt Hàng</a>
                                </div>
                            </div>
                            <div class="content">
                                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                                <?php 
                                    if (is_numeric(htmlspecialchars($row['price']))) {
                                        $discounted_price = htmlspecialchars($row['price']) + htmlspecialchars($row['price']) * 0.1; 
                                ?><span class="discount">-10%</span>
                                <div class="price"><span><?php echo number_format($discounted_price, 0, ',', '.') ?></span><br><?php echo number_format(htmlspecialchars($row['price']), 0, ',', '.'); ?> VNĐ</div>
                                <?php } else {
                                    echo '<div class="price">' . htmlspecialchars($row['price']) .'VNĐ'.'</div>';
                                }?>        
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        <?php } else {
            echo "Product not found!";
        }
    }
    ?>
</div>
</div>
</body>
</html>

<?php require "inc/footer.php"; ?>
