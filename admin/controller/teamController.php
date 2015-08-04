<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];
    if ($target == 'showAll') {
        $title = "Manage Team";
        $allData = $obj_query->select_all('team');
        if (count($allData) > 3) {
            $footerName = 'dynamic';
        }
        if (!empty($allData)) {
            $i = 1;
            foreach ($allData as $key => $value) {
                if (!empty($value['photo'])) {
                    $status = checkThumb($value['photo']);
                    if (empty($status)) {
                        $thumbPath = createThumbnail($_SESSION['rootDir'] . '/' . $value['photo']);
                    } else {
                        $thumbPath = $status;
                    }
                } else {
                    if ($value['gender'] == 'Male' || $value['gender'] == 'male') {
                        $thumbPath = 'images/team/blankMale.jpg';
                    } else {
                        $thumbPath = 'images/team/blankFemale.jpg';
                    }
                }
                $info[] = array(
                    'sn' => $i++, 'id' => $value['id'], 'photo' => baseUrl . $thumbPath,
                    'name' => $value['name'], 'desc' => $value['description'],
                    'designation' => $value['designation']);
            }
        }
        compareImage();
    }
    if ($target == 'insertTeam') {
        require '../../init.php';
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $post = $_POST['post'];
        $imgFile = $_FILES['imgFile'];
        $desc = $_POST['desc'];
        if (empty($imgFile['name'])) {
            $filePath = '';
        } else {
            $filePath = fileCheck($imgFile);
        }
        $col = array('photo', 'name', 'gender', 'designation', 'description');
        $info = array($filePath, $name, $gender, $post, $desc);
        if ($obj_query->insert($col, $info, 'team')) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Inserted';
            header('location:' . baseUrl . 'admin/manageTeam/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be inserted';
            header('location:' . baseUrl . 'admin/manageTeam/');
        }
    }
    if ($target == 'editTeam') {
        require '../../init.php';
        $col1 = array('id', 'photo', 'name', 'gender', 'designation', 'description');
        $id1 = 'id';
        $val1 = $_GET['id'];
        $editData = $obj_query->select_single($col1, 'team', $id1, $val1);
        if (!empty($editData)) {
            $title = 'EditTeam';
            require '../editTeam.php';
        }
    }

    if ($target == 'updateTeam') {
        require '../../init.php';
        $pk = 'id';
        $id = $_POST['contentId'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $post = $_POST['post'];
        $desc = $_POST['desc'];
        if (!empty($_POST['imgDelete'])) {
            if (!empty($_FILES['imgFile']['name'])) {
                $imgPath = fileCheck($_FILES['imgFile']);
            } else {
                $imgPath = '';
            }
            if (!empty($_POST['imgPath'])) {
                unlink($_SESSION['rootDir'] . '/' . $_POST['imgPath']);
            }
        } else {
            $imgPath = $_POST['imgPath'];
        }
        $col = 'photo,name,gender,designation,description';
        $info = array($imgPath, $name, $gender, $post, $desc);
        $pk = 'id';
        if ($obj_query->update($col, $info, 'team', $pk, $id)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Updated';
            header('location:' . baseUrl . 'admin/manageTeam/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be updated';
            header('location:' . baseUrl . 'admin/manageTeam/');
        }
    }
    if ($target == 'deleteTeam') {
        require '../../init.php';
        $id1 = 'id';
        $val1 = $_GET['id'];
        $teamData = $obj_query->select_single(array('photo'), 'team', 'id', $val1);
        if ($obj_query->delete_one('team', $id1, $val1)) {
            unlink($_SESSION['rootDir'] . '/' . $teamData['photo']);
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Deleted';
            header('location:' . baseUrl . 'admin/manageTeam/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be deleted';
            header('location:' . baseUrl . 'admin/manageTeam/');
        }
    }
}

function fileCheck($imgFile) {
    if (isset($imgFile)) {
        $check = getimagesize($imgFile["tmp_name"]);
        if ($check !== false) {
            return fileUpload($imgFile);
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'File is not an image';
            header('location:' . baseUrl . 'admin/manageTeam');
        }
    } else {
        echo "File not selected";
    }
}

function fileUpload($imgFile) {
    $imgName = basename($imgFile['name']);
    $finalName = preg_replace('/\s+/', '', $imgName);
    $file_path = $_SESSION['rootDir'] . '/images/team/' . $finalName;
    if (fileExists($file_path)) {
        if (move_uploaded_file($imgFile["tmp_name"], $file_path)) {
            resizeImage($file_path);
            return 'images/team/' . $finalName;
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'File can not be uploaded';
            header('location:' . baseUrl . 'admin/manageTeam');
            exit();
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['flashData'] = 'Same file cannot be uploaded twice';
        header('location:' . baseUrl . 'admin/manageTeam');
    }
}

function fileExists($file_path) {
    if (!file_exists($file_path)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function resizeImage($imgPath) {
    $data = getMime($imgPath);
    $src_img = $data[0];
    $mime = $data [1];
    $img_width = imageSX($src_img);
    $img_height = imageSY($src_img);
    $new_size = $img_height / $img_width;
    $img_width_new = 700;
    $img_height_new = $img_width_new * $new_size;
    $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
    $background = imagecolorallocate($new_image, 0, 0, 0);
    imagecolortransparent($new_image, $background);
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
    imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
    $new_file_path = $_SESSION['rootDir'] . '/images/team/' . basename($imgPath);
    return create_image($new_image, $new_file_path, $mime, 'upload');
}

function getMime($imgPath) {
    $mime = getimagesize($imgPath);
    if ($mime['mime'] == 'image/png') {
        $src_img = imagecreatefrompng($imgPath);
    } elseif ($mime['mime'] == 'image/jpg') {
        $src_img = imagecreatefromjpeg($imgPath);
    } elseif ($mime['mime'] == 'image/jpeg') {
        $src_img = imagecreatefromjpeg($imgPath);
    } elseif ($mime['mime'] == 'image/pjpeg') {
        $src_img = imagecreatefromjpeg($imgPath);
    }
    return array($src_img, $mime);
}

function create_image($new_image, $new_file_path, $mime, $filename) {
    if ($mime['mime'] == 'image/png') {
        $result = imagepng($new_image, $new_file_path, 9);
    } elseif ($mime['mime'] == 'image/jpg') {
        $result = imagejpeg($new_image, $new_file_path, 80);
    } elseif ($mime['mime'] == 'image/jpeg') {
        $result = imagejpeg($new_image, $new_file_path, 80);
    } elseif ($mime['mime'] == 'image/pjpeg') {
        $result = imagejpeg($new_image, $new_file_path, 80);
    }
    return 'images/team/thumb/' . $filename;
}

function checkThumb($imgPath) {
    $files = scandir($_SESSION['rootDir'] . '/images/team/thumb/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } elseif ($file == basename($imgPath)) {
            return 'images/team/thumb/' . basename($imgPath);
        } else {
            continue;
        }
    }
    return NULL;
}

function createThumbnail($imgPath) {
    $data = getMime($imgPath);
    $src_img = $data[0];
    $mime = $data [1];
    $img_width = imageSX($src_img);
    $img_height = imageSY($src_img);
    $new_size = ($img_width + $img_height) / ( $img_width * ($img_height / 77));
    $img_width_new = $img_width * $new_size;
    $img_height_new = $img_height * $new_size;
    $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
    $background = imagecolorallocate($new_image, 0, 0, 0);
    imagecolortransparent($new_image, $background);
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
    imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
    $new_file_path = $_SESSION['rootDir'] . '/images/team/thumb/' . basename($imgPath);
    return create_image($new_image, $new_file_path, $mime, basename($imgPath));
}

function compareImage() {
    $files = scandir($_SESSION['rootDir'] . '/images/team/thumb/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } else {
            $thumbData[] = $file;
        }
    }

    $img = scandir($_SESSION['rootDir'] . '/images/team/');
    foreach ($img as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } else {
            $imgData[] = $file;
        }
    }
    if (!empty($thumbData)) {
        $data = array_diff($thumbData, $imgData);
        foreach ($data as $rmImg) {
            unlink($_SESSION['rootDir'] . '/images/team/thumb/' . $rmImg);
        }
    }
}
