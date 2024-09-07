<? 
   require (__DIR__."/../classes/user.php");
   require (__DIR__."/../classes/auth.php");
   $user = new User;
?>
<!DOCTYPE html>
<html>
<head>
<title>My Flowers Store</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style_form.css" />
    <link rel="stylesheet" href="css/home.css" />
    <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/script.js"></script>

    <link rel="stylesheet" href="vendors/font-awesome-4.7.0/css/font-awesome.min.css" />
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="multi-columns">
                <div class="left col-2">
                    <div class="brand">
                        <i class="icon"></i>
                        <h1 class="name">HOA</h1>
                    </div>
                </div>
                <div class="right col-6">
                <nav>
                    <ul class="sidebar">
                        <li class="sidebar-item" onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
                        <li class="sidebar-item"><a href="index.php" class="text">Trang chủ</a></li>
                        <li class="sidebar-item"><a href="products.php" class="text">Sản phẩm</a></li> 
                        <li class="sidebar-item"><a href="search.php" class="text">Tìm kiếm</a></li>          
                        <li class="sidebar-item"><a href="giohang.php" class="text">Giỏ hàng</a></li>    
                        
                                            
                        <?php if(Auth::isLoggedIn()): ?>
                            <?php if($user->checkuser($conn, $_SESSION['name'])): ?>
                                <li class="sidebar-item"><a href="ordermanagement.php" class="text">Quản lý đơn hàng</a></li>   
                                <li class="sidebar-item"><a href="usermanagement.php" class="text">Quản lý người dùng</a></li>
                                <li class="sidebar-item"><a href="addproduct.php" class="text">Thêm sản phẩm</a></li>
                            <?php endif; ?>
                            <li class="sidebar-item"><a href="order.php" class="text">Đơn Hàng</a></li>
                            <li class="sidebar-item"><a href="logout.php" class="text">Đăng xuất</a></li>
                        <?php else: ?>
                            <li class="sidebar-item"><a href="login.php" class="text">Đăng nhập</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

                    <ul class="main-nav">
                        <li class="item"><a href="index.php" class="text">Trang chủ</a></li>
                        <li class="item"><a href="products.php" class="text">Sản phẩm</a></li>      
                        <li class="item"><a href="search.php" class="text">Tìm kiếm</a></li>
                        <li class="item"><a href="giohang.php" class="text">Giỏ hàng</a></li>
                                                                              
                        <? if(Auth::isLoggedIn()): ?>

                            <!--Kiểm tra xem tài khoản có phải là admin -->
                            <?if($user->checkuser($conn, $_SESSION['name'])==1):?>
                                <li class="item"><a href="ordermanagement.php" class="text">Quản lý đơn hàng</a></li>        
                            <?endif;?>
                            <li class="item"><a href="order.php" class="text">Đơn hàng</a></li>

                            <li class="item"><a href="logout.php" class="text">Đăng xuất</a></li>
                            
                        <? else: ?>
                            <li class="item"><a href="login.php" class="text">Đăng nhập</a></li>
                        <? endif; ?>
                        <li onclick="showSidebar()"><a href="#" ><svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
                    </ul>
                    <script>
                        function showSidebar(){
                            const sidebar =document.querySelector('.sidebar')
                            sidebar.style.display = 'flex'
                        }
                    </script>
                    <script>
                        function hideSidebar(){
                            const sidebar =document.querySelector('.sidebar')
                            sidebar.style.display = 'none'
                        }
                    </script>
                </div>
            </div>
        </div>


        