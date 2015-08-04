<?php if (!empty($popTrip)) { ?>
    <div class="heading">Popular Trips</div>
    <div class="featuredTrip">
        <?php foreach ($popTrip as $trip) { ?>
            <div class="featureContent">
                <h3>
                    <a href="<?php echo baseUrl . 'details/' . $trip['id']; ?>/">
                        <?php
                        if (strlen($trip['title']) < 35) {
                            echo ucfirst($trip['title']);
                        } else {
                            echo ucfirst(substr($trip['title'], 0, 32)) . '...';
                        }
                        ?>
                    </a>
                </h3>
                <div class="tripDetails">
                    <span class="sideBarIcon">
                        <a href="<?php echo baseUrl . 'details/' . $trip['id']; ?>/">
                            <div class="sideBarIconImg" style="background-image:url('<?php echo baseUrl . $trip['imgPath']; ?>')"></div>
                        </a>
                    </span>
                    <?php
                    if (strlen($trip['desc']) < 174) {
                        echo $trip['desc'];
                    } else {
                        echo strip_tags(substr($trip['desc'], 0, 174)) . '... <a href="' . baseUrl . 'details/' . $trip['id'] . '/">Read More</a> &raquo;';
                    }
                    ?>
                </div> 
            </div>
        <?php } ?>
    </div>
    <?php
}
if (!empty($allFeatured)) {
    ?>
    <div class="heading">Featured Trips</div>
    <div class="featuredTrip">
        <?php
        foreach ($allFeatured as $featured) {
            ?>
            <div class="featureContent">
                <h3>
                    <a href="<?php echo baseUrl . 'details/' . $featured['id']; ?>/">
                        <?php
                        if (strlen($featured['title']) < 35) {
                            echo ucfirst($featured['title']);
                        } else {
                            echo ucfirst(substr($featured['title'], 0, 32)) . '...';
                        }
                        ?>
                    </a>
                </h3>
                <div class="tripDetails">
                    <span class="sideBarIcon">
                        <a href="<?php echo baseUrl . 'details/' . $featured['id']; ?>/">
                            <div class="sideBarIconImg" style="background-image:url('<?php echo baseUrl . 'images/thumb/' . basename($featured['imgPath']); ?>')"></div>
                        </a>
                    </span>
                    <?php
                    if (strlen($featured['desc']) < 174) {
                        echo $featured['desc'];
                    } else {
                        echo strip_tags(substr($featured['desc'], 0, 174)) . '... <a href="' . baseUrl . 'details/' . $featured['id'] . '/">Read More</a> &raquo;';
                    }
                    ?>
                </div> 
            </div>
        <?php } ?>
    </div>
<?php } ?>
