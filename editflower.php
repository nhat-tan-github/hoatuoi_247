<?
require "inc/init.php";
//Auth::requireLogin()
require "dialog.php";

if(isset($_GET['id'])){
    $conn = require("inc/db.php");
    $flower = Flower::getByID($conn,$_GET['id']);
    if(!$flower){
        Dialog::show('Flower not found');
        return;
    }
}

///////////////////// Xử lý cập nhật  /////////////////////
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //lấy thông tin (chỉnh sửa)
    $flower->id = $_GET['id'];
    $flower->name = $_POST['name'];
    $flower->description = $_POST['description'];
    $flower->price = $_POST['price'];
    if($flower->update($conn)){
        header("Location: index.php");
        return;
    }
}
?>
<?require_once "inc/header.php";?>

<div class="content">
    
    <form method="post" id="frmEDITFLOWER">
        <fieldset>
            <legend>Edit Flower</legend>
            <div class="row">
                <label for="name">Name:</label>
                <span class="error">*</span>
                <input name="name" id="name" type="text" value="<?=htmlspecialchars($flower->name)?>"/>
            </div>

            <div class="row">
                <label for="description">Description:</label>
                <span class="error">*</span>
                <input name="description" id="description" type="text" value="<?=htmlspecialchars($flower->description)?>"/>
            </div>

            <div class="row">
                <label for="price">Price:</label>
                <span class="error">*</span>
                <input name="price" id="price" type="text" value="<?=htmlspecialchars($flower->price)?>"/>
            </div>
            <div class="row">
                <input class="btn" type="submit" value="Update">
                <input class="btn" type="reset" value="Cancel"
                onclick="parent.location='index.php'"/>

            </div>
        </fieldset>


    </form>
</div>
<? require_once "inc/footer.php"?>
