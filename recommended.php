<?php
require 'init.php';
require 'controller/recomController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont" >
            <div class="allTrek">
                <h2 style="padding: 10px 0px;border-bottom: 1px solid #ccc;margin-bottom: 10px;">Client's Recommendation</h2>
                <?php
                if (!empty($treks)) {
                    foreach ($treks as $trek) {
                        ?>
                        <div class="trekDetails" >
                            <div class="trekText" style="width: 658px;margin:0px;padding: 10px 10px 10px 10px;">
                                <h4 style="color: #095077;float:right;">Published on: <span style="color: #1475A1;"><?php echo date("M jS, Y", strtotime($trek['addedOn'])); ?></span></h4>
                                <br>
                                <br>
                                <h3><i>"<?php echo ucfirst($trek['title']); ?>"</i></h3><br>
                                <?php echo $trek['description']; ?><br>
                                <span style="color: #095077;"><?php echo ucfirst($trek['name']); ?></span> | <span style="color: #1475A1;"><?php echo $trek['email']; ?></span> | <?php echo ucfirst($trek['country']); ?>
                                <br>
                                <span style="color: #095077;">Visited on:</span> <span style="color: #1475A1;"><?php echo date("M, Y", strtotime($trek['visited'])); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No Recommendations yet.";
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
