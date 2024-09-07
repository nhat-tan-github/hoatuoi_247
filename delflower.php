<?php
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
} else {
    Dialog::show('Flower ID is not provided');
    return;
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $flower->id = $_GET['id'];
    $oldimage= $flower->imagefile;
    if($flower->deleteByID($conn)){
        if($oldimage && file_exists("Uploadfile/$oldimage")){
            unlink("Uploadfile/$oldimage");
        }
        
        header("Location: index.php");
        return;
    }
}

?>
<?php require_once "inc/header.php"; ?>

<div class="content">
    
<form method="post" id="frmDELFlower" action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $_GET['id']); ?>">

        <fieldset>
            <legend>Delete FLower</legend>
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
            <?php if($flower->imagefile):?>
                <br>
                <img  src="uploads/<?php echo $flower->imagefile?>"
                    width="100" >
            <?php else:?>
                <img src="images/noimage.png"
                width="100" >
            <?php endif;?>
            <div class="row">
                <input class="btn" type="submit" value="Delete">
                <input class="btn" type="reset" value="Cancel"
                onclick="parent.location='index.php'"/>

            </div>
        </fieldset>


    </form>
</div>
<?php require_once "inc/footer.php"; ?>

<script>
    $(document)
        .ready(function() {
        $('#frmDELFlower')
                .submit(function(e){
            e.preventDefault();
            if(confirm("Are you sure you want to delete ?")){
                var frm = $('<form>');
                        frm.attr('method', 'post');
                        frm.attr('action', $(this).attr('action')); 
                        frm.appendTo('body');
                        frm.submit();
            }
        
    });
})
</script>
