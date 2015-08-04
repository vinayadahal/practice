<?php
require 'init.php';
if (!empty($_SESSION['id'])) {
    $link1 = '<a href="' . baseUrl . 'admin/home/"><button class="admin_edit_btn">Go to Home</button></a>';
    $link2 = '<a href="' . baseUrl . 'admin/logout"><button class="admin_edit_btn">Logout</button></a>';
} else {
    $link1 = '<a href="' . baseUrl.'"><button class="admin_edit_btn">Go to Home</button></a>';
    $link2 = NULL;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo '404' ?> - Ever Green Trekking</title>
        <link href="<?php echo baseUrl; ?>css/errorPage.css" type="text/css" rel="stylesheet" />
        <!--[if IE 7]>
        <script src="<?php echo baseUrl; ?>js/incompatible.js" type="text/javascript"></script>
        <![endif]-->
        <!--[if IE 8]>
        <script src="<?php echo baseUrl; ?>js/incompatible.js" type="text/javascript"></script>
        <![endif]-->
        <link rel="icon" type="image/png" href="<?php echo baseUrl ?>images/favicon.png">
    </head>
    <body>
        <div class="errorCenter">
            <h1 style="text-align: center">Error: 404</h1>
            <div class="imgCenter">
                <img alt="Crying fountain" width=110 height=90 src="<?php echo baseUrl; ?>images/crying-fountain.gif">
            </div>
            Sorry, file cannot be found in this server.<br/>
            <div style="float: left;"><?php echo $link1; ?></div>
            <div style="float: right;"><?php echo $link2; ?></div>
        </div>

    </body>
</html>