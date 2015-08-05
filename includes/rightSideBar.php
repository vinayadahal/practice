<?php if (!empty($latestTrips)) { ?>
    <div class="heading">Latest Trips</div>
    <div class="featuredTrip">
        <?php foreach ($latestTrips as $latestTrip) { ?>
            <div class="featureContent">
                <h3>
                    <a href="<?php echo baseUrl . 'details/' . $latestTrip['id']; ?>/">
                        <?php
                        if (strlen($latestTrip['title']) < 35) {
                            echo ucfirst($latestTrip['title']);
                        } else {
                            echo ucfirst(substr($latestTrip['title'], 0, 32)) . '...';
                        }
                        ?>
                    </a>
                </h3>
                <div class="tripDetails">
                    <span class="sideBarIcon">
                        <a href="<?php echo baseUrl . 'details/' . $latestTrip['id']; ?>/">
                            <div class="sideBarIconImg" style="background-image:url('<?php echo baseUrl . 'images/thumb/' . basename($latestTrip['imgPath']); ?>')"></div>
                        </a>
                    </span>
                    <?php
                    if (strlen($latestTrip['desc']) < 174) {
                        echo $latestTrip['desc'];
                    } else {
                        echo strip_tags(substr($latestTrip['desc'], 0, 174)) . '... <a href="' . baseUrl . 'details/' . $latestTrip['id'] . '/">Read More</a> &raquo;';
                    }
                    ?>
                </div> 
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?php if (!empty($shortSweet)) { ?>
    <div class="heading">Short and Sweet Trips</div>
    <div class="featuredTrip">
        <?php foreach ($shortSweet as $sns) { ?>
            <div class="featureContent">
                <h3>
                    <a href="<?php echo baseUrl . 'details/' . $sns['id']; ?>/">
                        <?php
                        if (strlen($sns['title']) < 35) {
                            echo ucfirst($sns['title']);
                        } else {
                            echo ucfirst(substr($sns['title'], 0, 32)) . '...';
                        }
                        ?>
                    </a>
                </h3>
                <div class="tripDetails">
                    <span class="sideBarIcon">
                        <a href="<?php echo baseUrl . 'details/' . $sns['id']; ?>/">
                            <div class="sideBarIconImg" style="background-image:url('<?php echo baseUrl . 'images/thumb/' . basename($sns['imgPath']); ?>')"></div>
                        </a>
                    </span>
                    <?php
                    if (strlen($sns['desc']) < 174) {
                        echo $sns['desc'];
                    } else {
                        echo strip_tags(substr($latestTrip['desc'], 0, 174)) . '... <a href="' . baseUrl . 'details/' . $sns['id'] . '/">Read More</a> &raquo;';
                    }
                    ?>
                </div> 
            </div>
        <?php } ?>
    </div>
<?php } ?>
<div class="heading">Find us in facebook</div>
<div class="fb-page" data-href="https://www.facebook.com/evergreentrekkingnepal" width="245" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
    <div class="fb-xfbml-parse-ignore">
        <blockquote cite="https://www.facebook.com/pages/EverGreen-trekking/549031231903436"></blockquote>
    </div>
</div>