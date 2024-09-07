<?php
require "inc/init.php";
$conn = require "inc/db.php";
$total = Flower::count($conn);
$limit = 4;
$currentPage = $_GET['page'] ?? 1;

$config = [
    'total' => $total,
    'limit' => $limit,
    'full' => false,
];
$flowers = Flower::getPaging($conn, $limit, ($currentPage - 1) * $limit);
require "inc/header.php";
?>
<link rel="stylesheet" href="css/home.css">

<div class="content">
<section class="products" id="products">
    <h1 class="heading"> Sản phẩm <span>Mới Nhất</span> </h1>
    <div class="box-container">
        <?php foreach ($flowers as $b): ?>
            <div class="box">
                
                
                <div class="image">
                    <img src="uploads/<?php echo htmlspecialchars($b->imagefile); ?>"  alt="">
                    <div class="icons"> 
                    <? if(Auth::isLoggedIn()):?>
                            <? if($user->checkuser($conn, $_SESSION['name'])):?>
                            <a href="editflower.php?id=<?php echo htmlspecialchars($b->id) ?>" class="cart-btn">Sửa</a>                         
                            <?endif;?>
                        <?endif;?>      
                        <a href="chitietsq.php?id=<?php echo htmlspecialchars($b->id) ?>" class="cart-btn">Đặt Hàng</a>
                        <? if(Auth::isLoggedIn()):?>
                            <? if($user->checkuser($conn, $_SESSION['name'])):?>
                            <a href="delflower.php?id=<?php echo htmlspecialchars($b->id) ?>" class="cart-btn">Xóa</a>
                            <a href="editimage.php?id=<?php echo htmlspecialchars($b->id) ?>" class="cart-btn">Ảnh</a>                            
                            <?endif;?>
                        <?endif;?>
                    </div>                    
                </div>
                <div class="content">
                <h3><?php echo $b->name ?></h3>
                <?php 
            if (is_numeric($b->price)) {
                $discounted_price = $b->price + $b->price * 0.1; 
        ?><span class="discount">-10%</span>
        <div class="price"><span><?php echo number_format($discounted_price, 0, ',', '.') ?></span><br><?php echo number_format($b->price, 0, ',', '.') ?> VNĐ</div>
        <?php } else {
            echo '<div class="price">' . $b->price .'VNĐ'.'</div>';
        }?>
        </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
</div>

<div class="content">
<div class="pagination-wrapper">
    <?php
    // Khởi tạo thanh chuyển trang với tham số config
    $page = new Pagination($config);
    // Hiển thị thanh chuyển trang
    echo $page->getPagination();
    ?>
</div>
</div>
<?php require "inc/footer.php"; ?>
