<?php

$latestTrips = $obj_query->select_all_order('trip', 'added', 'DESC', '3');
$allFeatured = $obj_query->select_all_order('trip', 'added', 'DESC', '3', 'featured', 'Yes');
//for pagination
$allCountTrek = count($obj_query->select_all('trip'));
$dataPerPage = 5;
$num_pages = ceil($allCountTrek / $dataPerPage);
//echo $_GET['page'];
if (!empty($_GET['page']) && $_GET['page'] > 1) {
    $page = $_GET['page'] - 1;
    $start = ($dataPerPage * $page);
} else {
    $start = 0;
}
$sn = $start + 1;
$treks = $obj_query->select_all('trip', $start, $dataPerPage);
$popular = $obj_query->select_all_order('visited', 'visited', 'DESC', '3');
if (!empty($popular)) {
    foreach ($popular as $visited) {
        $popTrip[] = $obj_query->select_single(array('id', 'title', 'imgPath', 'desc'), 'trip', 'id', $visited['tripId']);
    }
}

$dropDownArea = $obj_query->select_distinct_col('area', 'trip');
$dropDownActivity = $obj_query->select_distinct_col('category', 'category');
$dropDownDuration = $obj_query->select_distinct_col('duration', 'trip');
$dropDownDeparture = $obj_query->select_distinct_col('departure', 'trip');
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

$contactInformation = $obj_query->select_single(array('title', 'content', 'desc'), 'content', 'keyword', 'contact');

$titleController = ucfirst($contactInformation['title']);
