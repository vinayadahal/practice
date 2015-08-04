<?php
require 'init.php';
require 'controller/galController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont" style="width: 945px;">
            <h2 style="padding: 10px 0px;border-bottom: 1px solid #ccc;">Gallery</h2>
            <div class="gallery">
                <?php
                if (!empty($imageNames)) {
                    for ($i = 0; $i < count($imageNames); $i++) {
                        ?>
                        <div class="gallery_icon" style="background-image:url('<?php echo baseUrl; ?>images/gallery/<?php echo $imageNames[$i]; ?>');" onclick="loadImage('<?php echo baseUrl . 'images/gallery/' . $imageNames[$i]; ?>')">
                            <!--<img src="<?php echo baseUrl; ?>images/gallery/<?php echo $imageNames[$i]; ?>" class="gallery_preview"/>-->
                        </div> 
                        <?php
                    }
                } else {
                    echo 'No images are uploaded yet.';
                }
                ?>
            </div>
            <div class="fullImageWrap" id="fullImageWrap">
                <div class="fullImage" >
                    <a href="javascript:void(0)"><span class="closeImage" id="closeImage"></span></a>
                    <img src="" class="fullImageCtrl" id="imageFull" alt=""/>
                </div>
            </div>
            <div class="popupBackground" id="background"></div>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php';
