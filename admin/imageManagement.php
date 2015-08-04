<?php
require '../init.php';
require 'controller/imageController.php';
require 'includes/header.php';
?>
<div class="admin_site_center">
    <div class="panel pane_overide">
        <div class="panel das_icon"><a href="<?php echo baseUrl ?>admin/gallery/"><img src="<?php echo baseUrl; ?>images/adminIcons/gallery.png" width="128" height="128" />Gallery Management</a></div>
        <div class="panel das_icon"><a href="<?php echo baseUrl ?>admin/showSlider/"><img src="<?php echo baseUrl; ?>images/adminIcons/slider.png" width="128" height="128" />Slider Management</a></div>
    </div>
</div>
<?php
require 'includes/footer.php';
