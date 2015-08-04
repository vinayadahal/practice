<?php

$titleController = 'Search';
if (!empty($_GET['target'])) {
    if ($_GET['target'] == 'category') {
        $col = array('id', 'title', 'category', 'desc', 'imgPath', 'area', 'duration', 'featured', 'offer');
        $table = 'trip';
        $id = 'category';
        $keyword = $val = $_GET['id'];
        $searchCategory = $obj_query->select_one($col, $table, $id, $val);
    }
    if ($_GET['target'] == 'search') {
        if (!empty($_POST['area']) && !empty($_POST['activity']) && !empty($_POST['duration'])) {
            $area = $_POST['area'];
            $activity = $_POST['activity'];
            $duration = $_POST['duration'];
            $keyword = $activity . ', ' . $area . ', ' . $duration . ', ' . $departure;
            $col = array('id', 'title', 'category', 'desc', 'imgPath', 'area', 'duration', 'featured', 'offer');
            $table = 'trip';
            $id = array('area', 'category', 'duration');
            $val = array($area, $activity, $duration);
            $resultSearch = $obj_query->select_four_var($col, $table, $id, $val);
        } else {
            $_SESSION['alert'] = 'Please choose everything from the dropdown.';
            header('location:' . baseUrl);
        }
    }
    if ($_GET['target'] == 'searchSite') {
        $keyword = $_POST['searchSite'];
        $col = array('id', 'title', 'category', 'desc', 'imgPath', 'area', 'duration', 'featured', 'offer');
        $table = 'trip';
        $id = 'title';
        $val = $keyword;
        $resultSearch = $obj_query->select_like($col, $table, $id, $val);
    }
}

$popular = $obj_query->select_all_order('visited', 'visited', 'DESC', '3');
if (!empty($popular)) {
    foreach ($popular as $visited) {
        $popTrip[] = $obj_query->select_single(array('id', 'title', 'imgPath', 'desc'), 'trip', 'id', $visited['tripId']);
    }
}