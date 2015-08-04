<?php

$latestTrips = $obj_query->select_all_order('trip', 'added', 'DESC', '3');
$allFeatured = $obj_query->select_all_order('trip', 'added', 'DESC', '3', 'featured', 'Yes');
$popular = $obj_query->select_all_order('visited', 'visited', 'DESC', '3');
if (!empty($popular)) {
    foreach ($popular as $visited) {
        $popTrip[] = $obj_query->select_single(array('id', 'title', 'imgPath', 'desc'), 'trip', 'id', $visited['tripId']);
    }
}
$titleController = 'Recommended';
$treks = $obj_query->select_all_order('review', 'addedOn', 'DESC','NULL','publish', 'yes');
