<? 
require "inc/init.php";
 require "dialog.php";
 $conn = require("inc/db.php");
if($_SERVER['REQUEST_METHOD']== 'POST'){
    
    try{
        $fullname = Uploadfile::process();
        if(!empty($fullname)){
            $name = $_POST['name'];
            $description= $_POST['description'];
            $price = $_POST['price'];
            
            $flower = new Flower($name, $description, $price, $fullname);
            //gọi hàm thêm
            if($flower->add($conn)){
                header("Location: index.php");//2.1
            }else{
                unlink("uploads/$fullname");//2.2
            }
        }
    }
    catch(PDOException $e){
        //throw new Exception($e->getMessage());
        Dialog::show($e->getMessage());
    }
}

?>

<? require "inc/header.php";?>
<!-- Tao form nhap  -->
<div class="content">
    <form name="frmADDFLOWER" method="post" id="frmADDFLOWER" enctype="multipart/form-data">
        <fieldset>
            <legend>Product Information</legend>
            <div class="row">
                <label for="name">Tên sản phẩm:</label>
                <span class="error">*</span>
                <input name="name" id="name" type="text" placeholder="Tên sản phẩm"/>
            </div>

            <div class="row">
                <label for="description">Mô tả:</label>
                <span class="error">*</span>
                <input name="description" id="description" type="text" placeholder="Mô tả sản phẩm"/>
            </div>

            <div class="row">
                <label for="price">Giá:</label>
                <span class="error">*</span>
                <input name="price" id="price" type="text" placeholder="Giá sản phẩm"/>
            </div>

            <div class="row">
                <label for="file">Tệp hình ảnh:</label>
                <input name="file" id="file" type="file"/>
            </div>

            <div class=row>
                <input class="btn" type="submit" value="Thêm">
                <input class="btn" type="reset" value="Xóa">
            </div>
        </fieldset>
    </form>
</div>
<? require "inc/footer.php"?>