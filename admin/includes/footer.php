<?php
$col = array('content');
$id = 'keyword';
$val = 'copyright';
$res = $obj_query->select_single($col, 'content', $id, $val);
if (empty($res)) {
    $copyright = 'No data can be recieved.';
} else {
    $copyright = $res['content'];
}
?>
<nav class="<?php
if ($page == 'addContent' || $page == 'addTrip' || $title == 'TripManagement' || $title == 'EditInfo' || $title == 'EditTrip' || $title == 'AddTeam' || $title == 'EditTeam' || $title == 'EditSlider' || $title == 'ClientReview' || $title == 'EditReview' || !empty($footerName)) {
    echo 'footerNormal';
} else {
    echo 'navbar navbar-default navbar-fixed-bottom';
}
?>" style="z-index:0;" id="footerAdmin">
    <div class="footer_center">
        <?php
        if (!empty($copyright)) {
            echo $copyright;
        }
        ?>
    </div>
</nav>
</body>
</html>
