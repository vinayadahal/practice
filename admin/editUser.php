<?php
require '../init.php';
require 'includes/header.php';
?>
<div class = "admin_edit_center">
    <h3>Edit User Information</h3>
    <a href = "<?php echo baseUrl ?>admin/settings/" style = "outline: 0px;" title = "Back"><i class = "glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method = "POST" action = "<?php echo baseUrl ?>admin/updateUser/" onsubmit="return validate(['name', 'email', 'gender', 'username'])">
        <label for = "name"><h5>Name:</h5></label> <input id = "name" type = "text" class = "form-control admin_editBox_override" name = "name" value="<?php echo $name; ?>"/>
        <label for = "email"><h5>Email:</h5></label> <input id = "email" type = "text" class = "form-control admin_editBox_override" name = "email" value="<?php echo $email; ?>"/>
        <label for = "gender"><h5>Gender:</h5></label> 
        <select class="form-control selectOverride" name="gender" id="gender">
            <?php if ($gender == 'Male' || $gender == 'male') { ?>
                <option selected="selected" value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                <option value="Female">Female</option>
            <?php } else { ?>
                <option selected="selected" value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                <option value="Male">Male</option>
            <?php } ?>
        </select>
        <label for="username"><h5>Username:</h5></label> <input id="username" type="text" class="form-control admin_editBox_override" name="username" value="<?php echo $username; ?>"/>
        <input type="submit" value="Update" class="admin_edit_btn" />
    </form>
    <a href = "<?php echo baseUrl ?>admin/settings/"><button class="admin_edit_btn">Cancel</button></a>
</div>
<?php
require 'includes/footer.php';
