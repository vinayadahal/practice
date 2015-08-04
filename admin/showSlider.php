<?php
require 'controller/sliderController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <?php if (count($filePath) < 10) { ?> <a onclick="readMore()"><button class="admin_edit_btn" style="float: right;">Upload Slider Image</button></a><?php } ?>
    <h3>Slider Management</h3>
    <div style="border-top: 1px solid #aaa;">
        <?php foreach ($filePath as $path) { ?>
            <a href="<?php echo baseUrl; ?>admin/editSlider/<?php echo $path['id']; ?>/">
                <div class="sliderPreview" style="background-image:url('<?php echo baseUrl . $path['uploadUrl']; ?>');">
                    <div class="captionImg"><?php echo $path['caption'] ?></div>
                </div>
            </a>
        <?php } ?>
    </div>
    <div style="padding: 30px 0px;"><b>Note:</b> Every pictures must be edited by cropping before showing it on user side.</div>
</div>
<div class="popupBackground" id="readMoreBack">
    <div class="popup" id="readMoreCont">
        <div class="headings">Upload Picture<a href="javascript:void();" id="readMoreClose" class="close_btn">X</a></div>
        <div class="popupContent" style="padding: 10px;">
            <div class="pnl_heading" style="border-bottom: 1px solid #ff6600;"><h3>Choose Picture</h3></div>
            <div class="input-group">
                <form method="POST" action="<?php echo baseUrl; ?>admin/uploadImage/" enctype="multipart/form-data" onsubmit="return checkImage();">
                    <label for="caption"><h5>Caption:</h5></label> <input id="caption" type="text" class="form-control admin_editBox_override" name="caption"/>
                    <span class="admin_edit_btn btn-file">Browse Image <input type="file" name="imgFile" id='img'></span>
                    <input type="submit" class="admin_edit_btn" value="Upload Image" style="float: right;">
                </form>
            </div>
            <label><h5>Preview:</h5> </label><img id='imgLocation' class='productImg' style="width: 700px;margin-bottom: 10px;">
        </div>
    </div>
</div>
<script>
    function checkImage() {
        if ($('#img').val() === '') {
            alert('Browse and select a picture.');
            return false;
        } else {
            return true;
        }
    }
</script>
<?php
require 'includes/footer.php';
