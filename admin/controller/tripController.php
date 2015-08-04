<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];
    if ($target == 'showAll') {
        $title = "TripManagement";
        $allData = $obj_query->select_all('trip');
        $totalData = count($allData);
        $dataPerPage = 10;
        $num_pages = ceil($totalData / $dataPerPage);
        if ($_GET['page'] > $num_pages && $_GET['page'] != 1) {
            header('location:' . baseUrl . 'error');
            exit();
        }
        if (!empty($_GET['page']) && $_GET['page'] > 1) {
            $page = $_GET['page'] - 1;
            $start = ($dataPerPage * $page);
        } else {
            $start = 0;
        }
        $sn = $start + 1;
        $getInfo = $obj_query->select_all('trip', $start, $dataPerPage);
        $i = 1;
        if (!empty($getInfo)) {
            foreach ($getInfo as $key => $value) {
                $status = checkThumb($value['imgPath']);
                if (empty($status)) {
                    $thumbPath = createThumbnail($_SESSION['rootDir'] . '/' . $value['imgPath']);
                } else {
                    $thumbPath = $status;
                }
                $info[] = array(
                    'sn' => $i++, 'id' => $value['id'], 'title' => $value['title'],
                    'category' => $value['category'], 'desc' => $value['desc'],
                    'imgPath' => baseUrl . $thumbPath, 'area' => $value['area'],
                    'duration' => $value['duration']);
            }
        }
        compareImage();
    }

    if ($target == 'addTrip') {
        $data = $obj_query->select_all('category');
        $trekking = $obj_query->select_all('trekking');
        $expedition = $obj_query->select_all('expedition');
    }

    if ($target == 'insertTrip') {
        require '../../init.php';
        $title = $_POST['title'];
        $category = $_POST['category'];
        $desc = $_POST['desc'];
        $imgFile = $_FILES['imgFile'];
        $area = $_POST['area'];
        $duration = $_POST['duration'];
        $featured = $_POST['featured'];
        $recommended = $_POST['recommended'];
        if ($featured == 'Yes') {
            $offer = $_POST['offer'];
        } else {
            $offer = $_POST['offer'];
        }
        $filePath = fileCheck($imgFile);
        if (!empty($filePath)) {
            $col = array('title', 'category', 'desc', 'imgPath', 'area', 'duration', 'added', 'featured', 'offer', 'recommended');
            $info = array($title, $category, $desc, $filePath, $area, $duration, date('Y:m:d'), $featured, $offer, $recommended);
            if ($obj_query->insert($col, $info, 'trip')) {
                $_SESSION['status'] = 'ok';
                $_SESSION['flashData'] = 'Record Inserted';
                header('location:' . baseUrl . 'admin/tripManagement/1/');
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['flashData'] = 'Record cannot be inserted';
                header('location:' . baseUrl . 'admin/tripManagement/1/');
            }
        } else {
            echo 'File path cannot be obtained';
        }
    }
    if ($target == 'editTrip') {
        require '../../init.php';
        $allCate = $obj_query->select_all('category');
        $trekking = $obj_query->select_all('trekking');
        $expedition = $obj_query->select_all('expedition');
        $col1 = array('id', 'title', 'category', 'desc', 'imgPath', 'area', 'duration', 'featured', 'recommended');
        $id1 = 'id';
        $val1 = $_GET['id'];
        $editData = $obj_query->select_single($col1, 'trip', $id1, $val1);
        if (!empty($editData)) {
            $title = 'EditTrip';
            require '../editTrip.php';
        }
    }

    if ($target == 'updateTrip') {
        require '../../init.php';
        $pk = 'id';
        $id = $_POST['contentId'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $desc = $_POST['desc'];
        $area = $_POST['area'];
        $duration = $_POST['duration'];
        $featured = $_POST['featured'];
        $recommended = $_POST['recommended'];
        if ($featured == 'Yes') {
            $offer = $_POST['offer'];
        } else {
            $offer = NULL;
        }
        if (!empty($_POST['imgDelete'])) {
            $imgPath = fileCheck($_FILES['imgFile']);
            unlink($_SESSION['rootDir'] . '/' . $_POST['imgPath']);
        } else {
            $imgPath = $_POST['imgPath'];
        }

        if (!empty($imgPath)) {
            $col = 'title,category,desc,imgPath,area,duration,featured,offer,recommended';
            $info = array($title, $category, $desc, $imgPath, $area, $duration, $featured, $offer, $recommended);
            $pk = 'id';
            if ($obj_query->update($col, $info, 'trip', $pk, $id)) {
                $_SESSION['status'] = 'ok';
                $_SESSION['flashData'] = 'Record Updated';
                header('location:' . baseUrl . 'admin/tripManagement/1/');
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['flashData'] = 'Record cannot be updated';
                header('location:' . baseUrl . 'admin/tripManagement/1/');
            }
        }
    }
    if ($target == 'deleteTrip') {
        require '../../init.php';
        $id1 = 'id';
        $val1 = $_GET['id'];
        $tripData = $obj_query->select_single(array('imgPath'), 'trip', 'id', $val1);
        if ($obj_query->delete_one('trip', $id1, $val1)) {
            unlink($_SESSION['rootDir'] . '/' . $tripData['imgPath']);
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Record Deleted';
            header('location:' . baseUrl . 'admin/tripManagement/1/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be deleted';
            header('location:' . baseUrl . 'admin/tripManagement/1/');
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
            header('location:' . baseUrl . 'admin/addTrip');
        }
    } else {
        echo "File not selected";
    }
}

function fileUpload($imgFile) {
    $imgName = basename($imgFile['name']);
    $finalName = preg_replace('/\s+/', '', $imgName);
    $file_path = $_SESSION['rootDir'] . '/images/trip/' . $finalName;
    if (fileExists($file_path)) {
        if (move_uploaded_file($imgFile["tmp_name"], $file_path)) {
            resizeImage($file_path);
            return 'images/trip/' . $finalName;
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'File can not be uploaded';
            header('location:' . baseUrl . 'admin/addTrip');
            exit();
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['flashData'] = 'Same file cannot be uploaded twice';
        header('location:' . baseUrl . 'admin/addTrip');
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
    $new_file_path = $_SESSION['rootDir'] . '/images/trip/' . basename($imgPath);
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
    return 'images/thumb/' . $filename;
}

function checkThumb($imgPath) {
    $files = scandir($_SESSION['rootDir'] . '/images/thumb/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } elseif ($file == basename($imgPath)) {
            return 'images/thumb/' . basename($imgPath);
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
    $new_size = ($img_width + $img_height) / ( $img_width * ($img_height / 200));
    $img_width_new = $img_width * $new_size;
    $img_height_new = $img_height * $new_size;
    $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
    $background = imagecolorallocate($new_image, 0, 0, 0);
    imagecolortransparent($new_image, $background);
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
    imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
    $new_file_path = $_SESSION['rootDir'] . '/images/thumb/' . basename($imgPath);
    return create_image($new_image, $new_file_path, $mime, basename($imgPath));
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
