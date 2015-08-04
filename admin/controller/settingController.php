<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];
    if ($target == 'updateUser') {
        require '../../init.php';
        $pk = 'id';
        $id = $_SESSION['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $gender = $_POST['gender'];
        $col = 'name,email,username,gender';
        $info = array($name, $email, $username, $gender);
        if ($obj_query->update($col, $info, 'user', $pk, $id)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'User infomation updated';
            header('location:' . baseUrl . 'admin/settings/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'User information cannot be updated';
            header('location:' . baseUrl . 'admin/settings/');
        }
    }
    if ($target == 'updatePassword') {
        require '../../init.php';
        $pk = 'id';
        $id = $_SESSION['id'];
        $old=$_POST['oldPassword'];
        $con = $_POST['conPassword'];
        $new = $_POST['newPassword'];
        if ($con !== $new) {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Two passwords are not matching';
            header('location:' . baseUrl . 'admin/editPassword/');
        } else {
            $col = array('username', 'password');
            $id = 'id';
            $val = $_SESSION['id'];
            $data = $obj_query->select_single($col, 'user', $id, $val); //getting password from database.
            if (sha1($old) == $data['password']) {
                $con = sha1($_POST['conPassword']);
                $col = 'password';
                $info = array($con);
                $pk = 'id';
                $id = $_SESSION['id'];
                if ($obj_query->update($col, $info, 'user', $pk, $id)) {
                    $_SESSION['status'] = 'ok';
                    $_SESSION['flashData'] = 'Password changed';
                    header('location:' . baseUrl . 'admin/settings/');
                } else {
                    $_SESSION['status'] = 'error';
                    $_SESSION['flashData'] = 'Password cannot be changed';
                    header('location:' . baseUrl . 'admin/settings/');
                }
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['flashData'] = 'Old password is not matching with system';
                header('location:' . baseUrl . 'admin/editPassword/');
            }
        }
    }
}