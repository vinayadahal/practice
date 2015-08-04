<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];
    if ($target == 'doLogin') {
        require '../../init.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $col1 = array('id');
        $id1 = array('username', 'password');
        $val1 = array($username, sha1($password));
        $limit = 1;
        $loginData = $obj_query->select_one($col1, 'user', $id1, $val1, $limit);
        foreach ($loginData as $data) {
            $_SESSION['id'] = $data['id'];
        }
        if (!empty($_SESSION['id'])) {
            header('location:' . baseUrl . 'admin/home/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Incorrect username or password';
            header('location:' . baseUrl . 'admin/login/');
        }
    }
    if ($target == 'doLogout') {
        require '../../init.php';
        compareImage();
        unset($_SESSION['id']);
        if (empty($_SESSION['id'])) {
            header('location:' . baseUrl . 'admin/login/');
        }
    }
}

function compareImage() {
    $files = scandir($_SESSION['rootDir'] . '/images/thumb/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } else {
            $thumbData[] = $file;
        }
    }

    $img = scandir($_SESSION['rootDir'] . '/images/trip/');
    foreach ($img as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } else {
            $imgData[] = $file;
        }
    }

    $data = array_diff($thumbData, $imgData);
    foreach ($data as $rmImg) {
        unlink($_SESSION['rootDir'] . '/images/thumb/' . $rmImg);
    }
}
