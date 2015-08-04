<?php
require 'controller/galleryController.php';
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <a onclick="readMore()"><button class="admin_edit_btn" style="float: right;">Upload to Gallery</button></a>
    <h3>Gallery Management</h3>
    <div style="border-top: 1px solid #aaa;">
        <?php
        if (!empty($errorMsg)) {
            echo $errorMsg;
        }
        if (!empty($imageNames)) {
            if (count($imageNames) > 10) {
                $footerName = 'dynamic';
            }
            for ($i = 0; $i < count($imageNames); $i++) {
                ?>
                <a href="<?php echo baseUrl; ?>admin/deleteGallery/<?php echo $imageNames[$i]; ?>/" onclick="return confirm('Delete this image?')">
                    <div class="sliderPreview" style="background-image:url('<?php echo baseUrl . 'images/gallery/' . $imageNames[$i]; ?>');"></div>
                </a>
                <?php
            }
        }
        ?>
    </div>
</div>
<div class="popupBackground" id="readMoreBack">
    <div class="popup" id="readMoreCont">
        <div class="headings">Upload Picture<a href="javascript:void();" id="readMoreClose" class="close_btn">X</a></div>
        <div class="popupContent" style="padding: 10px;">
            <div class="pnl_heading" style="border-bottom: 1px solid #ff6600;"><h3>Choose Picture</h3></div>
            <div class="input-group">
                <form method="POST" action="<?php echo baseUrl; ?>admin/uploadGallery/" enctype="multipart/form-data" onsubmit="return checkImage();">
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
