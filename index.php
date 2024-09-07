<?php
require "inc/init.php";
$conn = require "inc/db.php";
$total = Flower::count($conn);
$limit = 12;
$currentPage = $_GET['page'] ?? 1;

$config = [
    'total' => $total,
    'limit' => $limit,
    'full' => false,
];
$flowers = Flower::getPaging($conn, $limit, ($currentPage - 1) * $limit);
require "inc/header.php";

?>
<section class="home" id="home">
<div class="text">
<h3>Hoa tươi</h3>
<span> thay lời yêu thương </span>
</div>



</section>
<div class="content">
    <section class="about" id="about">
    <h1 class="heading"> <span> Về trang web của </span> Chúng Tôi </h1>
    <div class="row">
    <div class="video-container">
    <video src="images/about-vid.mp4" loop autoplay muted></video>
    <h3>Trang Web Tốt Nhất</h3>
    </div>
    <div class="content">
    <h3>Lý do bạn nên chọn chúng tôi ?</h3>
    <p> Shop Hoa Tươi 247 là một trong những tiệm hoa tươi uy tín nhất tại TP HCM, Việt Nam.</p>
    <p>Cam kết mang đến cho bạn những sản phẩm hoa tươi chất lượng cao, với mức giá tốt nhất và dịch chuyên nghiệp nhất khi sử dụng dịch vụ đặt hoa tươi online giao tận nơi</p>
    </div>
    </div>
    </section>
<section class="icons-container">

    <div class="icons">
    <img src="images/icon-1.png" alt="">
    <div class="info">
    <h3>Miễn phí vận chuyển</h3>
    <span>với đơn hàng từ 1.000.000 VND</span>
    </div>
    </div>

    <div class="icons">
    <img src="images/icon-2.png" alt="">
    <div class="info">
    <h3>10 ngày hoàn trả</h3>
    <span>cam kết hoàn tiền</span>
    </div>
    </div>

    

    <div class="icons">
    <img src="images/icon-4.png" alt="">
    <div class="info">
    <h3>Sản phẩm chất lượng</h3>
    <span>hàng mới mỗi ngày</span>
    </div>
    </div>

</section>
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