<?php
$fullUrl = parse_url($_SERVER['REQUEST_URI']);
$ext = explode('.', $fullUrl['path']);
if (!empty($ext[1])) {
    header('location:' . baseUrl . 'error/');
}
$page = substr($fullUrl['path'], strrpos($fullUrl['path'], '/') + 1);
echo $page;
if (empty($page)) {
    $title = 'Home';
} else {
    $title = ucfirst($page);
}

if (!empty($titleController)) {
    $title = $titleController;
}
$categories = $obj_query->select_all('category');
$trekking = $obj_query->select_all('trekking');
$expedition = $obj_query->select_all('expedition');
$_SESSION['normalUser'] = session_id();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?> - Ever Green Trekking</title>
        <link rel="icon" type="image/png" href="<?php echo baseUrl ?>images/favicon.png">
        <link href="<?php echo baseUrl; ?>css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" type="text/css" rel="stylesheet" />
        <script src="<?php echo baseUrl; ?>js/styler.js" type="text/javascript"></script>
        <!--[if lte IE 7]>
        <link href="<?php echo baseUrl; ?>css/ie7support.css" type="text/css" rel="stylesheet" />
        <script>
            $(window).load(function () {
                window.location.href = "<?php echo baseUrl; ?>incompatible";
            });
        </script>
        <![endif]-->
        <!--[if IE 8]>
        <link href="<?php echo baseUrl; ?>css/ie8support.css" type="text/css" rel="stylesheet" />
        <script>
            $(window).load(function () {
                window.location.href = "<?php echo baseUrl; ?>incompatible";
            });
        </script>
        <![endif]-->
        <script src="<?php echo baseUrl; ?>js/scripts.js" type="text/javascript"></script>
        <?php if ($title == 'Home') { ?>
            <script src="<?php echo baseUrl; ?>js/slideShow.js" type="text/javascript"></script>
        <?php } ?>
        <link href="<?php echo baseUrl; ?>css/jquery-ui.min.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo baseUrl; ?>js/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body <?php
    if (!empty($alert)) {
        echo 'onload=\'javascript:alert("' . $alert . '");\'';
    }
    ?>>
        <div class="logoArea">
            <img src="<?php echo baseUrl; ?>images/logo.png" class="logoImg" />
            <div class="searchArea">
                <form method="POST" action="<?php echo baseUrl ?>searchSite/">
                    <input type="text" placeholder="Search ..." name="searchSite" class="headSearch"/>
                    <button type="submit" class="searchIcon"><img src="<?php echo baseUrl; ?>images/toolbar_find.png" height="20" width="20"></button>
                </form>
            </div>
            <div class="headerContact">
                <p><b>Visit Us At: </b>Lakeside-6,  Pokhara</p>
                <p>&nbsp;</p>
                <p><b>Skype ID: </b>evergreentrekkingnepal</p>
                <p>&nbsp;</p>
                <p><b>For Query: </b>info@evergreentreeking.com</p>
                <p>&nbsp;</p>
                <p><div class="fb-like" data-href="https://www.facebook.com/pages/EverGreen-trekking/549031231903436" width="100" layout="button_count"></div></p>
            </div>
            <div class="headerContact">
                <b>Contact Information</b>
                <p>&nbsp;</p>
                <p><b>Email:</b> evergreentrekking@hotmail.com</p>
                <p>&nbsp;</p>
                <p><b>Mobile:</b> +977-98464-66079</p>
                <p>&nbsp;</p>
                <p><b>Phone:</b> +977-98464-66079</p>
                <p>&nbsp;</p>
            </div>
        </div>
        <div class="headerWrap">
            <div class="header">

                <ul>
                    <li><a href="<?php echo baseUrl ?>">Home</a></li>
                    <li><a id="dropDownCompany" href="javascript:void(0);">Company</a>
                        <div class="menu_list" id="dropDownItemCompany">
                            <div><a href="<?php echo baseUrl ?>about">About us</a></div>
                            <div><a href="<?php echo baseUrl ?>team">Our Team</a></div>
                            <div><a href="<?php echo baseUrl ?>policies">Policies</a></div>
                        </div>
                    </li>
                    <li><a href="javascript:void(0);">Destination</a></li>
                    <li><a href="javascript:void(0);">Tours</a></li>
                    <li><a id="dropDown" href="javascript:void(0);">Activities</a>
                        <div class="menu_list" id="dropDownItem">
                            <?php
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    ?>
                                    <div><a href="<?php echo baseUrl . 'searchType/' . $string = str_replace(' ', '+', $category['category']); ?>"><?php echo ucfirst($category['category']); ?></a></div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <li><a id="dropDownTrekking" href="javascript:void(0);">Trekking</a>
                        <div class="menu_list" id="dropDownItemTrekking">
                            <?php
                            if (!empty($trekking)) {
                                foreach ($trekking as $trekType) {
                                    ?>
                                    <div><a href="<?php echo baseUrl . 'searchType/' . $string = str_replace(' ', '+', $trekType['type']); ?>"><?php echo ucfirst($trekType['type']); ?></a></div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <li><a id="dropDownExp" href="javascript:void(0);">Expedition</a>
                        <div class="menu_list" id="dropDownItemExp">
                            <?php
                            if (!empty($expedition)) {
                                foreach ($expedition as $expType) {
                                    ?>
                                    <div><a href="<?php echo baseUrl . 'searchType/' . $string = str_replace(' ', '+', $expType['type']); ?>"><?php echo ucfirst($expType['type']); ?></a></div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <li><a href="<?php echo baseUrl ?>gallery">Gallery</a></li>
                    <li><a href="<?php echo baseUrl; ?>recommended">Recommend us</a></li>
                    <li><a href="<?php echo baseUrl ?>contact">Contact us</a></li>
                </ul>
            </div>
        </div>