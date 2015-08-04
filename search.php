<?php
require 'init.php';
require 'controller/searchController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont" style="width: 945px;">
            <h2 style="padding: 10px 0px;border-bottom: 1px solid #ccc;">Results For: <?php echo ucfirst($keyword); ?></h2>
            <div style="display: table;padding: 10px 0px;">
                <?php
                if (!empty($searchCategory)) {
                    foreach ($searchCategory as $categoryResult) {
                        ?>
                        <div class="searchPanels" id='seachPanel'>
                            <a href="<?php echo baseUrl . 'details/' . $categoryResult['id']; ?>/">
                                <h3><?php echo $categoryResult['title']; ?></h3>
                            </a>
                            <div class="searchPanelsIcon">
                                <a href="<?php echo baseUrl . 'details/' . $categoryResult['id']; ?>/">
                                    <div class="searchPanelsIconImg" style="background-image:url('<?php echo baseUrl . 'images/thumb/' . basename($categoryResult['imgPath']); ?>')"></div>
                                </a>
                            </div>
                            <?php
                            if (strlen($categoryResult['desc']) < 185) {
                                echo $categoryResult['desc'];
                            } else {
                                echo strip_tags(substr($categoryResult['desc'], 0, 185)) . '... <a href="' . baseUrl . 'details/' . $categoryResult['id'] . '/">Read More</a> &raquo;';
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                if (!empty($resultSearch)) {
                    foreach ($resultSearch as $search) {
                        ?>
                        <div class="searchPanels" id='seachPanel'>
                            <a href="<?php echo baseUrl . 'details/' . $search['id']; ?>/">
                                <h3><?php echo $search['title']; ?></h3>
                            </a>
                            <div class="searchPanelsIcon">
                                <a href="<?php echo baseUrl . 'details/' . $search['id']; ?>/">
                                    <img src="<?php echo baseUrl . 'images/thumb/' . basename($search['imgPath']); ?>" alt="SearchIcon" />
                                </a>
                            </div>
                            <?php
                            if (strlen($search['desc']) < 185) {
                                echo $search['desc'];
                            } else {
                                echo substr($search['desc'], 0, 185) . '... <a href="' . baseUrl . 'details/' . $search['id'] . '/">Read More</a> &raquo;';
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                if (empty($resultSearch) && empty($searchCategory)) {
                    echo 'No result to display';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php';


