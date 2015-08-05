<div class="popupBackground" id="generating">
    <div style="background:#fff;margin:250px auto;width: 200px;padding: 10px 0px;">
        <div style="width:200px;height:80px;text-align:center" id="loading">
            <img src="<?php echo baseUrl; ?>images/loader.gif" alt="loading" style="height:64px;width:64px" />
            <br>
            Generating Icon...
        </div>
    </div>
</div>

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
