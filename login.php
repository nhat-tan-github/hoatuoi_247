<?php
    session_start();
    require "inc/init.php";
    require "dialog.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = require "inc/db.php";
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(User::authenticate($conn, $username, $password)){
            $user= new User();
            $act = $user->active($conn, $username);
            if(!$act == 0){
                Dialog::show('Tài khoản này đã bị cấm!');
            }else{
                //Đăng nhập đồng thời lưu $username vào $_SESSION
                Auth::login($username);
                $user_id = $user->getUserId($conn, $username);
                $usertype = $user->getUsertype($conn, $username);

            // Lưu user_id vào session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['usertype'] = $usertype;



                header("Location: index.php"); 
            }          
        }else{
            Dialog::show('Sai tên đăng nhập hoặc mật khẩu!');
        }
   }  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Flowers Store </title>
  <link rel="stylesheet" href="css/style_login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<!-- Tạo form đăng nhập -->
<div class="wrapper">
    <form method="post" action="" id="frmLOGIN">
        
    <h1>Đăng nhập</h1>
            <div class="input-box">
                <label for="username">Tên đăng nhập :</label>
                <input name="username" id="username" type="text" placeholder="Nhập vào "/>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <label for="password">Mật khẩu:</label>
                <input name="password" id="password" type="password" placeholder="Nhập vào "/>
                <i  class='bx bxs-lock-alt' ></i>
            </div>
           
            <div >
            <button type="submit" class="btn">Đăng nhập</button>
            <button type="reset" class="btn">Xóa</button>
            </div>
            
    <div class="register-link">
        <p>Bạn là người dùng mới ? <a href="register.php">Đăng ký</a></p>
      </div>
    </form>
</div>
</body>
</html>
