<?php
require 'init.php';
require 'controller/detailController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont">
            <div class="heading" style="margin-bottom: 5px;"><b><?php echo ucfirst($res['title']); ?></b></div>
            <div class="detail">
                <img src="<?php echo baseUrl . $res['imgPath']; ?>" alt="Main Image" class="mainImg">
                <?php echo $res['desc']; ?>
                <br/>
                <table>
                    <tr>
                        <th colspan="2">Summary:</th>
                    </tr>
                    <tr>
                        <td>Area</td>
                        <td>Duration</td>
                    </tr>
                    <tr>
                        <td><?php echo ucfirst($res['area']); ?></td>
                        <td><?php echo $res['duration']; ?></td>
                    </tr>
                </table>
                <?php if ($res['featured'] == 'Yes' && $res['offer'] != NULL) { ?>
                    <br/>
                    <b>Special offer: <span style="color: #e00;"><?php echo $res['offer']; ?></span></b>
                <?php } ?>
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
    