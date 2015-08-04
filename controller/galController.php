<?php

$titleController = 'Gallery';
$popular = $obj_query->select_all_order('visited', 'visited', 'DESC', '3');
if (!empty($popular)) {
    foreach ($popular as $visited) {
        $popTrip[] = $obj_query->select_single(array('id', 'title', 'imgPath', 'desc'), 'trip', 'id', $visited['tripId']);
    }
}

if (get_image()) {
    $imageNames = get_image();
} else {
    $errorMsg = 'Nothing to display. Please upload some pictures.';
}

function get_image() {
    $files = scandir($_SESSION['rootDir'] . '/images/gallery/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } else {
            $filePath[] = $file;
        }
    }
    if (!empty($filePath)) {
        return $filePath;
    } else {
        return false;
    }
}
