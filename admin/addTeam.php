<?php
require '../init.php';
require 'controller/teamController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Add Team Member</h3>
    <a href="<?php echo baseUrl ?>admin/manageTeam/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="<?php echo baseUrl ?>admin/insertTeam/" enctype="multipart/form-data" onsubmit="return validate(['fullname', 'gender', 'post'])">
        <label for="fullname"><h5>Name:</h5></label> 
        <input id="fullname" type="text" class="form-control admin_editBox_override" name="name"/>
        <label for="gender"><h5>Gender:</h5></label>
        <select class="form-control selectOverride" name="gender" id="gender">
            <option selected="selected" value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <label for="post"><h5>Designation:</h5></label> 
        <input id="post" type="text" class="form-control admin_editBox_override" name="post"/>
        <label for="img"><h5>Photo:</h5> </label><img id='imgLocation' class='productImg' style="margin-bottom: 10px;">
        <div class="input-group">
            <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile" id='img' ></span>
        </div>
        <label for="desc"><h5>Description:</h5></label> 
        <textarea id="desc" name="desc"></textarea>
        <input type="submit" value="Add" class="admin_edit_btn" />
    </form>
    <a href="<?php echo baseUrl ?>admin/manageTeam/"><button class="admin_edit_btn">Cancel</button></a>
</div>

<script type="text/javascript">
    var editor = CKEDITOR.replace('desc', {
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

