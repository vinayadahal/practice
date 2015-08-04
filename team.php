<?php
require 'init.php';
require 'controller/ourTeamController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont" >
            <div class="allTrek">
                <h2 style="padding: 10px 0px;border-bottom: 1px solid #ccc;margin-bottom: 10px;">Our Team Members</h2>
                <?php
                if (!empty($teamInfo)) {
                    foreach ($teamInfo as $team) {
                        ?>
                        <div class="trekDetails">
                            <span class="trekIcon">
                                <img src="<?php echo $team['photo']; ?>" alt="Team Member" />
                            </span>
                            <div class="trekText" style="width: 400px">
                                <h3><?php echo ucfirst($team['name']); ?></h3>
                                <div style="color:#095077;margin: 5px 0px;"><?php echo $team['designation']; ?></div>
                                <?php echo $team['desc']; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="sideCont">
            <?php require 'includes/rightSideBar.php'; ?>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php';
