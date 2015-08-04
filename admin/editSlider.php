<?php
require 'includes/header.php';
?>
<div class="admin_edit_center">
    <div style="border: 1px solid black;width: 702px; float: left; display: table-cell; margin-right: 20px;"><img src="<?php echo baseUrl . $editData['uploadUrl']; ?>" id="cropbox" style="width: 700px;" /></div>
    <h4>Tips:</h4>
    <ol>
        <li>Click on the image.</li>
        <li>Adjust the selection box UP or DOWN.</li>
        <li>Click on <b>Crop & Save</b>.</li>
    </ol>
    <h4>Trouble cropping?</h4>
    Try resizing image before uploading.
    <form action="<?php echo baseUrl ?>admin/cropImage/" method="post" onsubmit="return checkCoords();">
        <input type="hidden" name="imgPath" value="<?php echo $_SESSION['rootDir'] . '/' . $editData['uploadUrl']; ?>" />
        <input type="hidden" name="imgId" value="<?php echo $editData['id']; ?>"/>
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />
        <label for="caption"><h5>Caption:</h5></label><input type="text" id="caption" name="caption" value="<?php echo $editData['caption']; ?>" class="form-control admin_editBox_override" style="width: 250px;"/>
        <input type="submit" value="Crop & Save" class="admin_edit_btn" />
    </form>
    <a href="<?php echo baseUrl; ?>admin/deleteImage/<?php echo $editData['id']; ?>/" onclick="return confirm('Are you sure?')"><button class="admin_edit_btn">Delete Image</button></a>
</div>
<?php
require 'includes/footer.php';
?>
<script type="text/javascript">
    $(function () {
        $('#cropbox').Jcrop({
            aspectRatio: 0,
            onSelect: updateCoords,
            minSize: [700, 350],
            maxSize: [700, 350]
        });
        imageSize();
    });
    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }
    function checkCoords() {
        if (parseInt($('#w').val()))
            return true;
        alert('Please select a crop region then press submit.');
        return false;
    }
    function imageSize() {
        var height = $('#cropbox').height();
        if (height >= 500) {
            $('#footerAdmin').attr('class', 'footerNormal');
        } else {
            $('#footerAdmin').attr('class', 'navbar navbar-default navbar-fixed-bottom');
        }
    }
</script>
