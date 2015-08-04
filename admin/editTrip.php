<?php
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <h3>Edit Product Information</h3>
    <a href="<?php echo baseUrl ?>admin/tripManagement/1" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="<?php echo baseUrl ?>admin/updateTrip/" enctype="multipart/form-data" onsubmit="return validate(['title', 'category', 'area', 'duration'])">
        <input type="hidden" name="contentId" value="<?php echo $editData['id']; ?>">
        <label for="title"><h5>Title:</h5></label> <input id="title" type="text" class="form-control admin_editBox_override" name="title" value="<?php echo $editData['title']; ?>">
        <label for="desc"><h5>Category:</h5></label>
        <select class="form-control selectOverride" name="category" id="category">
            <?php
            if (!empty($allCate)) {
                foreach ($allCate as $type) {
                    if (ucfirst($editData['category']) == ucfirst($type['category'])) {
                        ?>
                        <option selected="selected" value="<?php echo ucfirst($type['category']); ?>"><?php echo ucfirst($type['category']); ?></option>
                        <?php
                        continue;
                    } else {
                        ?>
                        <option value="<?php echo ucfirst($type['category']); ?>"><?php echo ucfirst($type['category']); ?></option>
                        <?php
                    }
                }
            }
            if (!empty($trekking)) {
                foreach ($trekking as $trek) {
                    if (ucfirst($editData['category']) == ucfirst($trek['type'])) {
                        ?>
                        <option selected="selected" value="<?php echo ucfirst($trek['type']); ?>"><?php echo ucfirst($trek['type']); ?></option>
                        <?php
                        continue;
                    } else {
                        ?>
                        <option value="<?php echo ucfirst($trek['type']); ?>"><?php echo ucfirst($trek['type']); ?></option>
                        <?php
                    }
                }
            }
            if (!empty($expedition)) {
                foreach ($expedition as $exp) {
                    if (ucfirst($editData['category']) == ucfirst($exp['type'])) {
                        ?>
                        <option selected="selected" value="<?php echo ucfirst($exp['type']); ?>"><?php echo ucfirst($exp['type']); ?></option>
                        <?php
                        continue;
                    } else {
                        ?>
                        <option value="<?php echo ucfirst($exp['type']); ?>"><?php echo ucfirst($exp['type']); ?></option>
                        <?php
                    }
                }
            }
            ?>
        </select>
        <label for="imgPreview"><h5>Preview:</h5></label> <br />Delete Image: <input type="checkbox" id="deleteImage" name="imgDelete" value="Yes"><img src="<?php echo baseUrl . 'images/thumb/' . basename($editData['imgPath']); ?>" class="productImg" id="imgPreview"/>
        <div id="browseBtn" >
            <label for="imgLocation"><h5>New Preview:</h5> </label><img id='imgLocation' class='productImg' style="margin-bottom: 10px;">
            <div class="input-group" >
                <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile" id='img'></span>
            </div>
        </div>
        <label for="bodyContact"><h5>Description:</h5></label> <textarea id="bodyContact" name="desc"><?php echo $editData['desc']; ?></textarea>
        <input type="hidden" name="imgPath" value="<?php echo $editData['imgPath']; ?>">
        <label for="area"><h5>Area:</h5></label> <input id="area" type="text" class="form-control admin_editBox_override" name="area" value="<?php echo $editData['area']; ?>">
        <label for="duration"><h5>Duration:</h5></label> <input id="duration" type="text" class="form-control admin_editBox_override" name="duration" value="<?php echo $editData['duration']; ?>">
        <label for="featured"><h5>Featured:</h5></label>
        <select class="form-control selectOverride" name="featured" id="selectFeatured">
            <?php if ($editData['featured'] == 'Yes') { ?>
                <option selected="selected" value = "Yes">Yes</option>
                <option value = "No">No</option>
            </select>
            <label for="offer" id="lblOffer"><h5>Offer:</h5></label>
            <input id="offer" type="text" class="form-control admin_editBox_override" name="offer"/>
        <?php } else { ?>
            <option selected="selected" value = "No">No</option>
            <option value = "Yes">Yes</option>
            </select>
            <label for="offer" id="lblOffer" style="display: none;"><h5>Offer:</h5></label>
            <input id="offer" type="text" class="form-control admin_editBox_override" name="offer" style="display: none;"/>
        <?php } ?>
        <label for="recommneded"><h5>Recommended:</h5></label>
        <select class="form-control selectOverride" name="recommended" id="recommended">
            <?php
            if ($editData['recommended'] == 'Yes') {
                ?>
                <option selected = "selected" value = "<?php echo ucfirst($editData['recommended']); ?>"><?php echo ucfirst($editData['recommended']); ?></option>
                <option value="No">No</option>
                <?php
            } else {
                ?>
                <option selected = "selected" value = "<?php echo ucfirst($editData['recommended']); ?>"><?php echo ucfirst($editData['recommended']); ?></option>
                <option value="Yes">Yes</option>
                <?php
            }
            ?>
        </select>
        <input type="submit" value="Update" class="admin_edit_btn" />
    </form>
    <a href="<?php echo baseUrl ?>admin/tripManagement/1/"><button class="admin_edit_btn">Cancel</button></a>
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
