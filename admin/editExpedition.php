<?php
require 'includes/header.php';
?>
<div class = "admin_edit_center">
    <h3>Edit Expedition</h3>
    <a href = "<?php echo baseUrl ?>admin/expedition/1/" style = "outline: 0px;" title = "Back"><i class = "glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method = "POST" action = "<?php echo baseUrl ?>admin/updateExpedition/" onsubmit="return validate(['category', 'description'])">
        <input type="hidden" value="<?php echo $editData['type']; ?>" name="oldData" />
        <input type="hidden" value="<?php echo $editData['id']; ?>" name="cateId">
        <label for = "category"><h5>Expedition Type:</h5></label> <input id = "category" type = "text" class = "form-control admin_editBox_override" name = "category" value="<?php echo $editData['type']; ?>"/>
        <label for = "description"><h5>Description:</h5></label> <input id = "description" type = "text" class = "form-control admin_editBox_override" name = "description" value="<?php echo $editData['description']; ?>"/>
        <input type = "submit" value = "Update" class = "admin_edit_btn" />
    </form>
    <a href = "<?php echo baseUrl ?>admin/expedition/1/"><button class = "admin_edit_btn">Cancel</button></a>
</div>
<?php
require 'includes/footer.php';
