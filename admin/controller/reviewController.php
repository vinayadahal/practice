<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];
    if ($target == 'showAll') {
        $getInfo = $obj_query->select_all_order('review', 'addedOn', 'DESC');
    }
    if ($target == 'insertContent') {
        require '../../init.php';
        echo $title = $_POST['title'];
        $content = $_POST['content'];
        $desc = $_POST['desc'];
        $keyword = $_POST['keyword'];
        $col = array('title', 'content', 'desc', 'keyword');
        $info = array($title, $content, $desc, $keyword);
        if ($obj_query->insert($col, $info, 'content')) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Inserted';
            header('location:' . baseUrl . 'admin/contentManagement/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be inserted';
            header('location:' . baseUrl . 'admin/contentManagement/');
        }
    }
    if ($target == 'editReview') {
        require '../../init.php';
        $col1 = array('id', 'title', 'description');
        $id1 = 'id';
        $val1 = $_GET['id'];
        $data = $obj_query->select_single($col1, 'review', $id1, $val1);
        if (!empty($data)) {
            $title = 'EditReview';
            require '../editReview.php';
        }
    }
    if ($target == 'updateReview') {
        require '../../init.php';
        $pk = 'id';
        $id = $_POST['contentId'];
        $title = $_POST['heading'];
        $content = $_POST['bodyContent'];
        $col = 'title,description';
        $info = array($title, $content);
        if ($obj_query->update($col, $info, 'review', $pk, $id)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Updated';
            header('location:' . baseUrl . 'admin/clientReview/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be updated.';
            header('location:' . baseUrl . 'admin/clientReview/');
        }
    }
    if ($target == 'publish') {
        require '../../init.php';
        $pk = 'id';
        $id = $_GET['id'];
        $col = 'publish';
        $info = array('yes');
        if ($obj_query->update($col, $info, 'review', $pk, $id)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Review Published';
            header('location:' . baseUrl . 'admin/clientReview/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Review cannot be published';
            header('location:' . baseUrl . 'admin/clientReview/');
        }
    }
    if ($target == 'unpublish') {
        require '../../init.php';
        $pk = 'id';
        $id = $_GET['id'];
        $col = 'publish';
        $info = array('no');
        if ($obj_query->update($col, $info, 'review', $pk, $id)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Review is hidden';
            header('location:' . baseUrl . 'admin/clientReview/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Review is still visible';
            header('location:' . baseUrl . 'admin/clientReview/');
        }
    }
    if ($target == 'deleteReview') {
        require '../../init.php';
        $id1 = 'id';
        $val1 = $_GET['id'];
        if ($obj_query->delete_one('review', $id1, $val1)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Deleted';
            header('location:' . baseUrl . 'admin/clientReview/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be deleted';
            header('location:' . baseUrl . 'admin/clientReview/');
        }
    }
}