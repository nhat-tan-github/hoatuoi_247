<?
require "inc/init.php";

require "dialog.php";
$conn = require("inc/db.php");
$flower = Flower::getByID($conn,$_GET['id']);

if(!isset($_GET['id'])){ // Sửa thành !isset để kiểm tra nếu id không tồn tại
    Dialog::show('Input ID, please');
    return;
}


if(!$flower){
    Dialog::show('Flower not found');
    return;
}

//////////// xử lý cập nhật image ///////////////////
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try{
        //upload file lên server
        $fullname = Uploadfile::process();
        if(!empty($fullname)){
            //lấy tên file hình củ 
            $oldimage = $flower->imagefile;
            //gans ten file moi 
            $flower->imagefile = $fullname;
            $flower->id = $_GET['id'];
            if($flower->updateImage($conn)){
                if($oldimage){
                    unlink("uploads/$oldimage");
                }
                header("Location: index.php");
            }
        }
    }catch(PDOException $e){
        //throw new Exception
        Dialog::show($e->getMessage());
    }
}
?>

<?require_once "inc/header.php";?>


<div class="content">
    
    <form method="post" id="frmEDITIMAGE" enctype="multipart/form-data">
        <fieldset>
            <legend>Edit Image</legend>
            <? if($flower->imagefile):?>
                <div class="row">
                    <img src="uploads/<?=$flower->imagefile?>" width="180" height="180"/>
                </div>
            <? else : ?>
                <img src="images/noimage.png" width="180" height="180"/>
            <?endif;?>
            <div class="row">
                <label for="file">File hình ảnh</label>
                <input class="file" type="file"id="file" name="file" /> 
            </div>
            <div class="row">
                <input class="btn" type="submit" value="Update">
                <input class="btn" type="reset" value="Cancel"
                onclick="parent.location='index.php'"/>

            </div>
        </fieldset>
    </form>
<? require_once "inc/footer.php"?>
