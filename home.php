<?php
require 'init.php';
require 'controller/homeController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont">
            <div class="slideShow">
                <div id="carousel">
                    <?php
                    if (!empty($data)) {
                        foreach ($data as $slider) {
                            if ($slider['finalUrl'] != NULL) {
                                ?>
                                <li><img src="<?php echo baseUrl . $slider['finalUrl']; ?>"/></li>
                                <?php
                            }
                        }
                    } else {
                        echo '<p>No images are uploaded</p>';
                    }
                    ?>
                </div>
                <div id="pager"></div>
            </div>
            <?php
            require 'includes/searchTrip.php';
            require 'includes/allTrek.php';
            ?>
        </div>
        <div class="sideCont">
            <?php require 'includes/rightSideBar.php'; ?>
        </div>
    </div>
    <!--content end-->
    <?php
    require 'includes/footer.php';
    