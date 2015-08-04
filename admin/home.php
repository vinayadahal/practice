<?php
require '../init.php';
require 'includes/header.php';
?>
<div class="admin_site_center">
    <div class="panel pane_overide">
        <div class="panel das_icon"><a href="<?php echo baseUrl?>admin/contentManagement/"><img src="<?php echo baseUrl; ?>images/adminIcons/content.png" width="128" height="128" />Content Management</a></div>
        <div class="panel das_icon"><a href="<?php echo baseUrl?>admin/tripManagement/1/"><img src="<?php echo baseUrl; ?>images/adminIcons/trip.png" width="128" height="128" />Trip Management</a></div>
        <div class="panel das_icon"><a href="<?php echo baseUrl?>admin/activities/1/"><img src="<?php echo baseUrl; ?>images/adminIcons/category.png" width="128" height="128" />Activities</a></div>
        <div class="panel das_icon"><a href="<?php echo baseUrl?>admin/images/"><img src="<?php echo baseUrl; ?>images/adminIcons/images.png" width="128" height="128" />Image Management</a></div>
        <div class="panel das_icon"><a href="<?php echo baseUrl?>admin/settings/"><img src="<?php echo baseUrl; ?>images/adminIcons/settings.png" width="128" height="128" />Settings</a></div>
    </div>
</div>
<?php
require 'includes/footer.php';