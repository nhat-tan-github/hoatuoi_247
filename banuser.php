<?php 
$conn = require "inc/db.php";
require "inc/init.php";
require "inc/header.php";
function reloadPage() {
    echo '<script>window.location.href = window.location.href;</script>';
    exit();
}
?>

<div class="content"> 
    <form name="frmBan" method="post">
        <fieldset> 
            <legend>Cấm/Gỡ cấm User</legend>
            Username:<br>
            <input type="text" name="username" placeholder="Nhập tên người dùng (username):"required><br>
            
            
            <input class="btn" type="submit" name="action" value="Cấm">
            
            
            <input class="btn" type="submit" name="action" value="Gỡ">
            
            
            <input class="btn" type="reset" value="Xóa">
        </fieldset>
    </form>

    <?php
    $query = "SELECT `id`, `username` FROM `users` WHERE 1";
    $result = $conn->query($query);
    echo "Users List :  <br>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "username: " . $row['username'] ;
        $user= new User();
        $act = $user->active($conn, $row['username']);   
        if(!$act == 0){
            echo "<span style='margin-left: 20px; color:red'>Bị Cấm</span><br>";
            
        } else {
            echo "<span style='margin-left: 20px; color: green'>Hoạt Động</span><br>";
        } 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        
        if (!$conn) {
            die("Kết nối thất bại: " . $conn->errorInfo()[2]);
        }
        
        $action = $_POST['action']; 

        switch($action) {
            case 'Ban':
                $user = new User();
                $rs = $user->banUser($conn, $username);
                if ($rs) {
                    echo "Ban successfully ! <br>";
                    reloadPage();
                } else {
                    header("Location: 404.php");
                }
                break;
                
            case 'Unban':
                $user = new User();
                $rs = $user->unbanUser($conn, $username);
                if($rs) {
                    echo "Unban successfully ! <br>";
                    reloadPage();
                } else {
                    header("Location: 404.php");
                }
                break;
                
                
            default:
                
                break;
        }
       
    }
        ?>
</div>

<?php require "inc/footer.php"; ?>
