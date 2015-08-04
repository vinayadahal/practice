<?php
$title = 'Login';
require '../init.php';
require 'includes/header.php';
?>
<div class="panel panel_login">
    <div class="headings">
        <h4>Login Panel - Evergreen Tekking</h4>
    </div>
    <div class="input_wrap">
        <form action="<?php echo baseUrl; ?>admin/checkLogin/" method="POST">
            <div class="inner-addon left-addon">
                <input type="text" class="form-control form_override" name="username" placeholder="Username"/>
                <i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="inner-addon left-addon">
                <input type="password" class="form-control form_override" name="password" placeholder="Password"/>
                <i class="glyphicon glyphicon-lock"></i>
            </div>
            <button type="submit" class="btn btn-default btn_login_override">Login</button>
        </form>
    </div>
</div>
<?php
require 'includes/footer.php';
