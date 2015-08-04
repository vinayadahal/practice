<?php
require 'init.php';
require 'controller/aboutController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont" >
            <?php
            if (!empty($aboutInformation)) {
                ?>
                <h2 style="padding: 10px 0px;border-bottom: 1px solid #ccc;"><?php echo ucfirst($aboutInformation['title']); ?></h2>
                <div class="detail">
                    <?php
                    echo $aboutInformation['content'];
                }
                ?>
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
</div>
<?php
require 'includes/footer.php';
