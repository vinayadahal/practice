<?php

$fullUrl = parse_url($_SERVER['REQUEST_URI']);
$page = substr($fullUrl['path'], strrpos($fullUrl['path'], '/') + 1);
if (empty($title)) {
    if (empty($page)) {
        $title = 'Home';
    } else {
        $title = ucfirst($page);
    }
}
if (empty($_SESSION['id']) && $title != 'Login') {
    header('location:' . baseUrl . 'admin/login/');
}
if (!empty($_SESSION['id'])) {
    $col = array('username', 'password', 'name', 'gender', 'email', 'role');
    $id = 'id';
    $val = $_SESSION['id'];
    $data = $obj_query->select_single($col, 'user', $id, $val);
    $username = $data['username'];
    $name = $data['name'];
    $gender = $data['gender'];
    $email = $data['email'];
    $role = $data['role'];
}