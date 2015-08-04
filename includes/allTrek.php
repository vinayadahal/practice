<div class="allTrek">
    <h2>Available Treks</h2><br>
    <?php
    if (!empty($treks)) {
        foreach ($treks as $trek) {
            ?>
            <div class="trekDetails">
                <span class="trekIcon">
                    <a href="<?php echo baseUrl . 'details/' . $trek['id']; ?>/">
                        <div class="imageIconTrek" style="background-image:url('<?php echo baseUrl . 'images/thumb/' . basename($trek['imgPath']); ?>')"></div>
                    </a>
                </span>
                <div class="trekText">
                    <h3>
                        <a href="<?php echo baseUrl . 'details/' . $trek['id']; ?>/">
                            <?php
                            if (strlen($trek['title']) < 35) {
                                echo ucfirst($trek['title']);
                            } else {
                                echo ucfirst(substr($trek['title'], 0, 32)) . '...';
                            }
                            ?>
                        </a>
                    </h3>
                    <?php
                    if (strlen($trek['desc']) < 300) {
                        echo $trek['desc'];
                    } else {
                        echo substr($trek['desc'], 0, 300) . '...';
                    }
                    ?>
                </div>
                <div class="otherDetails">
                    <div class="otherText">
                        <b>Area:</b>
                        <span style="color:#000;"><?php echo $trek['area']; ?></span>
                    </div>
                    <div class="otherText">
                        <b>Duration:</b> 
                        <span style="color:#000"><?php echo $trek['duration']; ?></span>
                    </div>
                    <div class="otherText">
                        <a href="<?php echo baseUrl . 'details/' . $trek['id']; ?>/">Read More</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <a href="<?php echo baseUrl ?>page/<?php echo 1; ?>"><button class="pages">&laquo; First</button></a>
    <?php
    if (!empty($num_pages)) {
        for ($i = 1; $i <= $num_pages; $i++) {
            if (empty($_GET['page'])) { // sets home page as page number 1.
                $_GET['page'] = 1;
            }
            if ($_GET['page'] == 1 && $i >= 17) { // sets last page (page number 17) as '...'
                echo '...';
                break;
            }
            if ($i >= (17 + ($_GET['page'] - 1)) && $_GET['page'] > 1) { // renders new number at last and add '...'
                echo '...';
                break;
            }
            if ($i < ($_GET['page'] - 1) && $i < ($num_pages - 15)) { //skips page number rendering at first
                if (($i + 2) == $_GET['page']) {
                    echo '...';
                    continue;
                }
                if ($i == ($num_pages - 16)) {
                    echo '...';
                }
                continue;
            }
            if ($i == ($_GET['page'] - 1) && $i < ($num_pages - 15)) { // sets '...' at first only.
                if ($i == 1) {
                    echo '...';
                }
                continue;
            }
            if ($i == $_GET['page']) {
                $style = 'pageNumSelected';
            } else {
                $style = 'pagesNum';
            }
            ?>
            <a href="<?php echo baseUrl ?>page/<?php echo $i; ?>"><button class="<?php echo $style; ?>"><?php echo $i; ?></button></a>
            <?php
        }
    }
    ?>
    <a href="<?php echo baseUrl ?>page/<?php echo $num_pages; ?>"><button class="pages">Last &raquo;</button></a>
</div>