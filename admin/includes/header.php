<?php
$fullUrl = parse_url($_SERVER['REQUEST_URI']);
$ext = explode('.', $fullUrl['path']);
if (!empty($ext[1])) {
    header('location:' . baseUrl . 'error/');
}
$segments = explode('/', $_SERVER['REQUEST_URI']);
$page = $segments[count($segments) - 2];
if (empty($title)) {
    if (empty($page)) {
        $title = 'Home';
    } else {
        $title = ucfirst($page);
    }
}
if (empty($_SESSION['id']) && $title != 'Login') {
    header('location:' . baseUrl . 'admin/login/');
}
if (!empty($_SESSION['id'])) {
    $col = array('username', 'password', 'name', 'gender', 'email', 'role');
    $id = 'id';
    $val = $_SESSION['id'];
    $userData = $obj_query->select_single($col, 'user', $id, $val);
    $username = $userData['username'];
    $name = $userData['name'];
    $gender = $userData['gender'];
    $email = $userData['email'];
    $role = $userData['role'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?> - Ever Green Trekking</title>
        <link href="<?php echo baseUrl; ?>css/baseStyle.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo baseUrl; ?>css/adminStyle.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo baseUrl; ?>js/styler.js" type="text/javascript"></script>
        <?php if ($title == 'AddTrip' || $title == 'EditTrip' || $title == 'AddTeam' || $title == 'EditTeam' || $title == 'EditReview') { ?>
            <script src="<?php echo baseUrl; ?>ckeditor/ckeditor.js" type="text/javascript"></script>
            <script src="<?php echo baseUrl; ?>ckfinder/ckfinder.js" type="text/javascript"></script>
        <?php } ?>
        <script src="<?php echo baseUrl; ?>js/scripts.js?<?php echo date('H:i:s') ?>" type="text/javascript"></script>
        <?php if ($title == 'EditSlider') { ?>
            <script src="<?php echo baseUrl; ?>js/jquery.Jcrop.min.js" type="text/javascript"></script>
        <?php } ?>
        <?php if ($title == 'AddContent' || $title == 'EditInfo') { ?>
            <script src="<?php echo baseUrl; ?>ckeditor/ckeditor.js" type="text/javascript"></script>
            <script src="<?php echo baseUrl; ?>ckfinder/ckfinder.js" type="text/javascript"></script>
        <?php } ?>
        <link rel="icon" type="image/png" href="<?php echo baseUrl ?>images/favicon.png">
    </head>
    <body <?php
    if (!empty($_SESSION['status']) && $_SESSION['status'] == 'ok') {
        echo 'onload="show_flash(\'success\');"';
    } elseif (!empty($_SESSION['status']) && $_SESSION['status'] == 'error') {
        echo 'onload="show_flash(\'failed\');"';
    }
    ?>>
            <?php
            if (!empty($_SESSION['status']) && $_SESSION['status'] == 'error') {
                echo '<div class="flash_data_err" id="failed"><img src="' . baseUrl . 'images/warning_shield_grey.png" height="20" width="20" /> ' . $_SESSION['flashData'] . '</div>';
                unset($_SESSION['status']);
                unset($_SESSION['flashData']);
            }
            if (!empty($_SESSION['status']) && $_SESSION['status'] == 'ok') {
                echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/tick.png" height="20" width="20" /> ' . $_SESSION['flashData'] . '</div>';
                unset($_SESSION['status']);
                unset($_SESSION['flashData']);
            }
            if ($title != 'Login') {
                ?>
            <nav class="navbar navbar-default" style="margin: 0px" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo baseUrl; ?>admin/home">Evergreen Trekking - Admin Panel</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo baseUrl; ?>admin/home/" style="outline: 0px;">Home</a></li>
                            <li><a href="<?php echo baseUrl; ?>admin/contentManagement/" style="outline: 0px;">Content Management</a></li>
                            <li><a href="<?php echo baseUrl; ?>admin/tripManagement/1/" style="outline: 0px;">Trip Management</a></li>
                            <li><a href="<?php echo baseUrl; ?>admin/activities/1/" style="outline: 0px;">Activities</a></li>
                            <li><a href="<?php echo baseUrl; ?>admin/images/" style="outline: 0px;">Image Management</a></li>
                        </ul>
                        <span class="nav_user_info">Hello,
                            <?php
                            if ($gender == 'male' || $gender == 'Male') {
                                echo 'Mr. ';
                            } else {
                                echo 'Ms. ';
                            }
                            ?>
                            <a href="javascript:void(0);" id="name_link"><?php echo ucfirst($name); ?></a></span>
                    </div>
                </div>
            </nav>
            <div class="logout_box" id="logout_box">
                <div class="arrow-up"></div>
                <div class="logout_text">
                    <div class="logout_btns">&raquo; <a href="<?php echo baseUrl; ?>admin/settings/" style="outline: 0px;">Settings</a></div>
                    <div class="logout_btns">&raquo; <a href="<?php echo baseUrl; ?>admin/logout/">Logout</a></div>
                </div>
            </div>
            <?php
        }            