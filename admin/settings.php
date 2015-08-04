<?php
require '../init.php';
require 'controller/settingController.php';
require 'includes/header.php';
?>
<div class="admin_site_center">
    <div class="panel">
        <div class="panel das_icon"><a href="<?php echo baseUrl; ?>admin/editUser/"><img src="<?php echo baseUrl; ?>images/adminIcons/edit_user.png" width="128" height="128" />Edit Information</a></div>
        <div class="panel das_icon"><a href="<?php echo baseUrl; ?>admin/editPassword/"><img src="<?php echo baseUrl; ?>images/adminIcons/keys.png" width="128" height="128" />Change Password</a></div>
    </div>
</div>
<?php
require 'includes/footer.php';
