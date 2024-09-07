<?php
    require "inc/init.php";
    require "dialog.php";
    //Auth::requireLogin(); //bat buoc phi dang nhap
    //validation data
    $usernameError = "";
    $passwordError = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $username_pattern = "/^[A-Za-z]*$/";
        if(!preg_match($username_pattern, $username)){
            $usernameError = "Chỉ cho phép ký tự";
        }
        $password = $_POST['password'];
        $password_pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if(!preg_match($password_pattern, $password)){
            $passwordError = "Có độ dài tối thiểu 8 ký tự, Ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số, 1 chữ cái đặc biệt";
        }

        if($usernameError == "" && $passwordError == ""){
            $conn = require "INC/db.php";
            // Tao moi user
            $user = new User();
            $user->username = $username;
            $user->password = $password;
            // Thực hiện xác thực
            if(User::isUsernameExists($conn, $user->username)) {
                Dialog::show("Tồn tại tài khoản!");
            } else {
                try {
                    if($user->addUser($conn)) {
                        Dialog::show("Đăng ký thành công!");
                        header("Location: login.php"); 
                    } else {
                        Dialog::show("Không thể đăng ký!");
                    }
                } catch(PDOException $e) {
                    Dialog::show($e->getMessage());
                }
            }
        }
        else{
            Dialog::show("Error !!!");
            
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
  <style>
    .agree-checkbox {
        margin-top: 45px;
    }
  </style>
</head>
<body>
<!-- Tạo form  -->
<div class="wrapper">
    <form method="post" action="" id="frmREGISTER">

    <h1>Register</h1>
            <div class="input-box">
                <label for="username">Tên đăng nhập :</label>
                <input name="username" id="username" type="text" placeholder="Nhập vào  "/>
                <? echo "<span class='error'> $usernameError </span>"?>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <label for="password">Mật khẩu:</label>
                <input name="password" id="password" type="password" placeholder="Nhập vào"/>
                <? echo "<span class='error'> $passwordError </span>"?>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <input type="checkbox" name="agree" value="1" class="form-check-input agree-checkbox"> 
            <label for="agree">Tôi đã đọc và đồng ý với <a href="termsandcondition.php" style="color: aqua;"><b>Điều khoản & Điều kiện</b></a></label> 
            
            <div >
            

            <button type="submit" class="btn">Đăng ký</button> 
            <button type="reset" class="btn">Xóa</button>
            </div>
            
        
    </form>
    <div class="register-link">
    <p>Trở về <a href="login.php"> Đăng nhập</a></p>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("frmREGISTER");
        const agreeCheckbox = document.querySelector('input[name="agree"]');
        form.addEventListener("submit", function(event) {
            if (!agreeCheckbox.checked) {
                event.preventDefault(); // Ngăn form được submit
                alert("Bạn cần phải đồng ý với Điều khoản & Điều kiện để đăng ký.");
            }
        });
    });
</script>

</body>
</html>
