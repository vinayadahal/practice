<?php

$latestTrips = $obj_query->select_all_order('trip', 'added', 'DESC', '3');
$allFeatured = $obj_query->select_all_order('trip', 'added', 'DESC', '3', 'featured', 'Yes');
$popular = $obj_query->select_all_order('visited', 'visited', 'DESC', '3');
if (!empty($popular)) {
    foreach ($popular as $visited) {
        $popTrip[] = $obj_query->select_single(array('id', 'title', 'imgPath', 'desc'), 'trip', 'id', $visited['tripId']);
    }
}
$titleController = 'Our Team';
$teamData = $obj_query->select_all('team');
if (!empty($teamData)) {
    foreach ($teamData as $team) {

        if (!empty($team['photo'])) {
            $thumbPath = 'images/team/thumb/' . basename($team['photo']);
        } else {
            if ($team['gender'] == 'Male' || $team['gender'] == 'male') {
                $thumbPath = 'images/team/blankMale.jpg';
            } else {
                $thumbPath = 'images/team/blankFemale.jpg';
            }
        }
        $teamInfo[] = array(
            'id' => $team['id'], 'photo' => baseUrl . $thumbPath,
            'name' => $team['name'], 'desc' => $team['description'],
            'designation' => $team['designation']);
    }
}