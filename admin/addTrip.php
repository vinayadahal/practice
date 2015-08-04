<?php
require '../init.php';
require 'controller/tripController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Add Trip</h3>
    <a href="<?php echo baseUrl ?>admin/tripManagement/1/" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="<?php echo baseUrl ?>admin/insertTrip/" enctype="multipart/form-data" onsubmit="return validate(['title', 'category', 'area', 'duration'])">
        <label for="title"><h5>Trip Name:</h5></label> <input id="title" type="text" class="form-control admin_editBox_override" name="title"/>
        <label for="desc"><h5>Trip Type:</h5></label>
        <select class="form-control selectOverride" name="category" id="category">
            <?php
            if (!empty($data)) {
                foreach ($data as $type) {
                    ?>
                    <option value="<?php echo ucfirst($type['category']); ?>"><?php echo ucfirst($type['category']); ?></option>
                    <?php
                }
            }
            if (!empty($trekking)) {
                foreach ($trekking as $trek) {
                    ?>
                    <option value="<?php echo ucfirst($trek['type']); ?>"><?php echo ucfirst($trek['type']); ?></option>
                    <?php
                }
            }
            if (!empty($expedition)) {
                foreach ($expedition as $exp) {
                    ?>
                    <option value="<?php echo ucfirst($exp['type']); ?>"><?php echo ucfirst($exp['type']); ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <label for="desc"><h5>Description:</h5></label> <textarea id="desc" name="desc"></textarea>
        <label for="img"><h5>Image:</h5> </label><img id='imgLocation' class='productImg' style="margin-bottom: 10px;">
        <div class="input-group">
            <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile" id='img' ></span>
        </div>
        <label for="area"><h5>Area:</h5></label> <input id="area" type="text" class="form-control admin_editBox_override" name="area"/>
        <label for="duration"><h5>Duration:</h5></label> <input id="duration" type="text" class="form-control admin_editBox_override" name="duration" />
        <label for="featured"><h5>Featured:</h5></label>
        <select class="form-control selectOverride" name="featured" id="selectFeatured">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
        </select>
        <label for="offer" id="lblOffer" style="display: none;"><h5>Offer:</h5></label> <input id="offer" type="text" class="form-control admin_editBox_override" name="offer" style="display: none;" />
        <label for="recommended"><h5>Recommended:</h5></label>
        <select class="form-control selectOverride" name="recommended" id="recommended">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
        </select>
        <input type="submit" value="Add" class="admin_edit_btn" />
    </form>
    <a href="<?php echo baseUrl ?>admin/tripManagement/1/"><button class="admin_edit_btn">Cancel</button></a>
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
