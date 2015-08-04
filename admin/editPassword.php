<?php
require '../init.php';
require 'includes/header.php';
?>
<div class = "admin_edit_center">
    <h3>Edit Password</h3>
    <a href = "<?php echo baseUrl ?>admin/settings/" style = "outline: 0px;" title = "Back"><i class = "glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method = "POST" action = "<?php echo baseUrl ?>admin/updatePassword/" onsubmit="return validate(['oldPass', 'newPass', 'conPass'])">
        <label for="oldPass" id="oldPassword"><h5>Old Password:</h5></label> <input id='oldPass' type="password" class="form-control admin_editBox_override" name = "oldPassword" />
        <label for="newPass" ><h5>New Password:</h5></label> <input id="newPass" type="password" class="form-control admin_editBox_override" name = "newPassword" />
        <label for="conPass" id='conPassword'><h5>Confirm Password:</h5></label> <input id="conPass" type="password" class="form-control admin_editBox_override" name = "conPassword" />
        <input type="submit" value="Update" class="admin_edit_btn" />
    </form>
    <a href = "<?php echo baseUrl ?>admin/settings/"><button class="admin_edit_btn">Cancel</button></a>
</div>
<?php
require 'includes/footer.php';
