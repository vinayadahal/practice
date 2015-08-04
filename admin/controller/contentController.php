<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];
    if ($target == 'showAll') {
        $getInfo = $obj_query->select_all('content');
    }
    if ($target == 'insertContent') {
        require '../../init.php';
        $title = $_POST['title'];
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
    if ($target == 'editInfo') {
        require '../../init.php';
        $col1 = array('id', 'title', 'content', 'desc', 'keyword');
        $id1 = 'id';
        $val1 = $_GET['id'];
        $data = $obj_query->select_single($col1, 'content', $id1, $val1);
        if (!empty($data)) {
            $title = 'EditInfo';
            require '../editInfo.php';
        }
    }
    if ($target == 'editContent') {
        require '../../init.php';
        $pk = 'id';
        $id = $_POST['contentId'];
        $title = $_POST['heading'];
        $content = $_POST['bodyContent'];
        $col = 'title,content';
        $info = array($title, $content);
        if ($obj_query->update($col, $info, 'content', $pk, $id)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Updated';
            header('location:' . baseUrl . 'admin/contentManagement/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be updated.';
            header('location:' . baseUrl . 'admin/contentManagement/');
        }
    }
    if ($target == 'deleteInfo') {
        require '../../init.php';
        $id1 = 'id';
        $val1 = $_GET['id'];
        if ($obj_query->delete_one('content', $id1, $val1)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Deleted';
            header('location:' . baseUrl . 'admin/contentManagement/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be deleted';
            header('location:' . baseUrl . 'admin/contentManagement/');
        }
    }
}