<?php
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Edit Team Member</h3>
    <a href="<?php echo baseUrl ?>admin/manageTeam/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="<?php echo baseUrl ?>admin/updateTeam/" enctype="multipart/form-data" onsubmit="return validate(['fullname', 'gender', 'post'])">
        <input type="hidden" name="contentId" value="<?php echo $editData['id']; ?>">
        <label for="fullname"><h5>Name:</h5></label> 
        <input id="fullname" type="text" class="form-control admin_editBox_override" name="name" value="<?php echo $editData['name']; ?>"/>
        <label for="gender"><h5>Gender:</h5></label>
        <select class="form-control selectOverride" name="gender" id="gender">
            <?php if ($editData['gender'] == 'Male' || $editData['gender'] == 'male') { ?>
                <option selected="selected" value="<?php echo $editData['gender']; ?>"><?php echo $editData['gender']; ?></option>
                <option value="Female">Female</option>
            <?php } else { ?>
                <option selected="selected" value="<?php echo $editData['gender']; ?>"><?php echo $editData['gender']; ?></option>
                <option value="Male">Male</option>
            <?php } ?>
        </select>
        <label for="post"><h5>Designation:</h5></label> 
        <input id="post" type="text" class="form-control admin_editBox_override" name="post" value="<?php echo $editData['designation']; ?>"/>
        <?php
        if ($editData['photo'] == '') {
            if ($editData['gender'] == 'Male' || $editData['gender'] == 'male') {
                $imagePath = baseUrl . 'images/team/blankMale.jpg';
            } else {
                $imagePath = baseUrl . 'images/team/blankFemale.jpg';
            }
            ?>
            <input type = "hidden" name = "imgPath" value = "">
            <?php
        } else {
            $imagePath = baseUrl . 'images/team/thumb/' . basename($editData['photo']);
            ?>
            <input type = "hidden" name = "imgPath" value = "<?php echo $editData['photo']; ?>">
            <?php
        }
        ?>
        <label for="imgPreview"><h5>Preview:</h5></label> 
        <br />Delete Image: <input type="checkbox" id="deleteImage" name="imgDelete" value="Yes">
        <img src="<?php echo $imagePath; ?>" class="productImg" id="imgPreview"/>
        <div id="browseBtn" >
            <label for="imgLocation"><h5>New Preview:</h5> </label><img id='imgLocation' class='productImg' style="margin-bottom: 10px;">
            <div class="input-group" >
                <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile" id='img'></span>
            </div>
        </div>
        <label for="desc"><h5>Description:</h5></label> 
        <textarea id="desc" name="desc"><?php echo $editData['description']; ?></textarea>
        <input type="submit" value="Update" class="admin_edit_btn" />
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

