<?php
require 'init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo 'Incompatible' ?> - Ever Green Trekking</title>
        <link href="<?php echo baseUrl; ?>css/ie7support.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="errorCenter">
            <h1 style="text-align: center">Incompatible Browser Detected!!!</h1>
            <br />
            This browser seems outdated. Please use one of the following browsers to view this website.
            <div class="imgCenter">
                <img alt="Compatilbe" width=800 src="<?php echo baseUrl; ?>images/compatible.jpg">
            </div>
        </div>
    </body>
</html>