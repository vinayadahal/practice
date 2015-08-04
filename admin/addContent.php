<?php
require '../init.php';
require 'controller/contentController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Add Information</h3>
    <a href="<?php echo baseUrl?>admin/contentManagement/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="<?php echo baseUrl?>admin/insertContent/">
        <input type="hidden" name="token" value="add" />
        <label for="heading"><h5>Title:</h5></label>
        <input id="heading" type="text" class="form-control admin_editBox_override" name="title" />
        <label for="bodyContact"><h5>Content:</h5></label>
        <textarea id="bodyContact" name="content"></textarea>
        <label for="desc"><h5>Description:</h5></label>
        <input id="desc" type="text" class="form-control admin_editBox_override" name="desc" />
        <label for="key"><h5>Keyword:</h5></label>
        <input id="key" type="text" class="form-control admin_editBox_override" name="keyword" />
        <input type="submit" value="Add" class="admin_edit_btn"/>
    </form>
    <a href="<?php echo baseUrl?>admin/contentManagement/"><button class="admin_edit_btn">Cancel</button></a>
</div>
<script type="text/javascript">
    var editor = CKEDITOR.replace('bodyContact', {
        filebrowserBrowseUrl: '<?php echo baseUrl; ?>ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo baseUrl; ?>ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: '<?php echo baseUrl; ?>ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: '<?php echo baseUrl; ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo baseUrl; ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo baseUrl; ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    CKFinder.setupCKEditor(editor, '<?php echo baseUrl; ?>ckfinder/');
</script>
<?php
require 'includes/footer.php';
