<?php
require 'init.php';
require 'controller/contactController.php';
require 'includes/header.php';
?>
<div class="contentWrap">
    <div class="content"> 
        <div class="sideCont">
            <?php require 'includes/leftSideBar.php'; ?>
        </div>
        <div class="middleCont" >
            <?php
            if (!empty($contactInformation)) {
                ?>
                <h2 style="padding: 10px 0px;border-bottom: 1px solid #ccc;"><?php echo ucfirst($contactInformation['title']); ?></h2>
                <div class="detail">
                    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
                    <div style='overflow:hidden;height:450px;width:680px;'>
                        <div id='gmap_canvas' style='height:450px;width:680px;'></div>
                        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                    </div>
                    <a href='http://www.maps-generator.com'>maps-generator.com</a>
                    <script type='text/javascript' src='http://embedmaps.com/google-maps-authorization/script.js?id=f69e4aa3efac729006213e498dee9e12960143a0'></script>
                    <script type='text/javascript'>
                        function init_map() {
                            var myOptions = {
                                zoom: 12, center: new google.maps.LatLng(28.205302099999997, 83.96163639999997),
                                mapTypeId: google.maps.MapTypeId.ROADMAP};
                            map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                            marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(28.205302099999997, 83.96163639999997)});
                            infowindow = new google.maps.InfoWindow({
                                content: '<strong>Ever Green Trekking</strong><br>' +
                                        ' Lakeside-6<br>' +
                                        ' Pokhara<br>'
                            });
                            google.maps.event.addListener(marker, 'click', function () {
                                infowindow.open(map, marker);
                            });
                            infowindow.open(map, marker);
                        }
                        google.maps.event.addDomListener(window, 'load', init_map);
                    </script>
                    <?php
                    echo $contactInformation['content'];
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
