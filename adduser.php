<?
    require "inc/init.php";
    require "dialog.php";
    $conn = require("inc/db.php");
     require "inc/header.php";

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
           
            // tao moi user
            $user = new User();
            $user->username = $username;
            $user->password = $password;
            if(User::isUsernameExists($conn, $user->username)) {
                Dialog::show("Tài khoản đã tồn tại!");
            }else {
            try{
                if($user->addUser($conn)){
                    Dialog::show("Thêm người dùng thành công!");
                }else{
                    Dialog::show("Không thể thêm người dùng");
                }
            }
            catch(PDOException $e){
                Dialog::show($e->getMessage());
               // header("Location: 404.php");
            }
            }
        }else{
            Dialog::show("Error !!!");
            //header("Location: 404.php");
        }
    }


?>

<!-- Tao form nhap user -->
<div class="content">
    <form name="frmADDUSER" method="post" id="frmADDUSER">
        <fieldset>
            <legend>User Information</legend>
            <div class="row">
                <label for="username">Tên đăng nhập:</label>
                <span class="error">*</span>
                <input name="username" id="username" type="text" placeholder="Tên người dùng"/>
                <? echo "<span class='error'> $usernameError </span>"?>
            </div>

            <div class="row">
                <label for="password">Mật khẩu:</label>
                <span class="error">*</span>
                <input name="password" id="password" type="password" placeholder="Mật khẩu"/>
                <? echo "<span class='error'> $passwordError </span>"?>
            </div>

            <div class=row>
                <input class="btn" type="submit" value="Save">
                <input class="btn" type="reset" value="Cancel">
            </div>
        </fieldset>
    </form>
</div>
<? require "inc/footer.php"?>