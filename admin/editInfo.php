<?php
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Edit Information</h3>
    <a href="<?php echo baseUrl; ?>admin/contentManagement/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="<?php echo baseUrl . 'admin/'; ?>editContent/">
        <input type="hidden" name="contentId" value="<?php echo $data['id']; ?>">
        <label for="heading"><h5>Heading:</h5></label> <input id="heading" type="text" class="form-control admin_editBox_override" name="heading" value="<?php echo $data['title']; ?>">
        <label for="bodyContact"><h5>Content:</h5></label> <textarea id="bodyContact" name="bodyContent"><?php echo $data['content']; ?></textarea>
        <input type="submit" value="Update" class="admin_edit_btn" />
    </form>
    <a href="<?php echo baseUrl ?>admin/contentManagement/"><button class="admin_edit_btn">Cancel</button></a>
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
