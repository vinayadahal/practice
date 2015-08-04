<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];
    if ($target == 'slideShow') {
        require '../init.php';
        $filePath = $obj_query->select_all('slider', 0, 10);
        compareImage();
    }
    if ($target == 'uploadImage') {
        require '../../init.php';
        $caption = $_POST['caption'];
        $imgFile = $_FILES['imgFile'];
        $filePath = fileCheck($imgFile);
        if (!empty($filePath)) {
            $col = array('caption', 'uploadUrl', 'enable');
            $info = array($caption, $filePath, 'no');
            if ($obj_query->insert($col, $info, 'slider')) {
                $_SESSION['status'] = 'ok';
                $_SESSION['flashData'] = 'Upload successful.';
                header('location:' . baseUrl . 'admin/showSlider/');
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['flashData'] = 'Cannot upload';
                header('location:' . baseUrl . 'admin/showSlider/');
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'File path not found';
            header('location:' . baseUrl . 'admin/showSlider/');
        }
    }

    if ($target == 'editSlider') {
        require '../../init.php';
        $col1 = array('id', 'caption', 'uploadUrl', 'finalUrl', 'enable');
        $id1 = 'id';
        $val1 = $_GET['id'];
        $editData = $obj_query->select_single($col1, 'slider', $id1, $val1);
        if (!empty($editData)) {
            $title = 'EditSlider';
            require '../editSlider.php';
        } else {
            require 'deleted.php';
        }
    }

    if ($target == 'cropImage') {
        require '../../init.php';
        $imgPath = $_POST['imgPath'];
        $imgId = $_POST['imgId'];
        $caption = $_POST['caption'];
        $coordX = $_POST['x'];
        $coordY = $_POST['y'];
        $coordW = $_POST['w'];
        $coordH = $_POST['h'];
        $filePath = cropImage($imgPath, $coordX, $coordY, $coordW, $coordH, $caption);
        if (!empty($filePath)) {
            $col = 'caption,finalUrl,enable';
            $info = array($caption, $filePath, 'yes');
            $pk = 'id';
            if ($obj_query->update($col, $info, 'slider', $pk, $imgId)) {
                $_SESSION['status'] = 'ok';
                $_SESSION['flashData'] = 'Crop successful.';
                header('location:' . baseUrl . 'admin/showSlider/');
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['flashData'] = 'Cannot crop';
                header('location:' . baseUrl . 'admin/showSlider/');
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'No file to upload';
            header('location:' . baseUrl . 'admin/showSlider/');
        }
    }

    if ($target == 'deleteImage') {
        require '../../init.php';
        $id1 = 'id';
        $val1 = $_GET['id'];
        $sliderData = $obj_query->select_single(array('caption', 'uploadUrl', 'finalUrl'), 'slider', 'id', $val1);
        if ($obj_query->delete_one('slider', $id1, $val1)) {
            if (unlink($_SESSION['rootDir'] . '/' . $sliderData['uploadUrl'])) {
                if (file_exists($_SESSION['rootDir'] . '/' . $sliderData['finalUrl'])) {
                    unlink($_SESSION['rootDir'] . '/' . $sliderData['finalUrl']);
                }
                $_SESSION['status'] = 'ok';
                $_SESSION['flashData'] = 'Slider removed';
                header('location:' . baseUrl . 'admin/showSlider/');
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Record cannot be deleted';
            header('location:' . baseUrl . 'admin/showSlider/');
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
            header('location:' . baseUrl . 'admin/showSlider/');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['flashData'] = 'File is not selected';
        header('location:' . baseUrl . 'admin/showSlider/');
    }
}

function fileUpload($imgFile) {
    $file_path = $_SESSION['rootDir'] . '/images/uploads/' . basename($imgFile["name"]);
    if (fileExists($file_path)) {
        if (move_uploaded_file($imgFile["tmp_name"], $file_path)) {
            resizeImage($file_path);
            return 'images/uploads/' . basename($imgFile["name"]);
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'File can not be uploaded';
            header('location:' . baseUrl . 'admin/showSlider/');
            exit();
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['flashData'] = 'Same file cannot be uploaded twice';
        header('location:' . baseUrl . 'admin/showSlider/');
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
    $new_file_path = $_SESSION['rootDir'] . '/images/uploads/' . basename($imgPath);
    return create_image($new_image, $new_file_path, $mime, 'upload');
}

function fileExists($file_path) {
    if (!file_exists($file_path)) {
        return TRUE;
    } else {
        return FALSE;
    }
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

function create_image($new_image, $new_file_path, $mime, $filename, $folder = NULL) {
    if ($mime['mime'] == 'image/png') {
        $result = imagepng($new_image, $new_file_path, 9);
    } elseif ($mime['mime'] == 'image/jpg') {
        $result = imagejpeg($new_image, $new_file_path, 80);
    } elseif ($mime['mime'] == 'image/jpeg') {
        $result = imagejpeg($new_image, $new_file_path, 80);
    } elseif ($mime['mime'] == 'image/pjpeg') {
        $result = imagejpeg($new_image, $new_file_path, 80);
    }
    if ($folder == 'slide') {
        return 'images/slideShow/' . $filename;
    } else {
        return 'images/uploads/' . $filename;
    }
}

function cropImage($imgPath, $coordX, $coordY, $coordW, $coordH, $text = NULL) {
    $data = getMime($imgPath);
    $src_img = $data[0];
    $mime = $data[1];
    $img_width_new = 700;
    $img_height_new = 350;
    $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
    imagecopyresampled($new_image, $src_img, 0, 0, $coordX, $coordY, $coordW, $coordH, $img_width_new, $img_height_new); // New save location
// code to write text to image
    $black = imagecolorallocate($new_image, 0, 0, 0);
    $white = imagecolorallocate($new_image, 255, 255, 255);

    $font = 'arial.ttf';
    $bbox = imagettfbbox(16, 0, $font, $text);
    $x = $bbox[2] + 20;
    imagefilledrectangle($new_image, 5, 5, $x, 40, $black);

// Add some shadow to the text
    imagettftext($new_image, 16, 0, 11, 31, $black, $font, $text);
// Add the text
    imagettftext($new_image, 16, 0, 10, 30, $white, $font, $text);
    $new_file_path = $_SESSION['rootDir'] . '/images/slideShow/' . basename($imgPath);
    return create_image($new_image, $new_file_path, $mime, basename($imgPath), 'slide');
}

function compareImage() {
    $files = scandir($_SESSION['rootDir'] . '/images/slideShow/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } else {
            $thumbData[] = $file;
        }
    }
    if (!empty($thumbData)) {
        $img = scandir($_SESSION['rootDir'] . '/images/uploads/');
        foreach ($img as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $imgData[] = $file;
            }
        }
        $data = array_diff($thumbData, $imgData);
        foreach ($data as $rmImg) {
            unlink($_SESSION['rootDir'] . '/images/slideShow/' . $rmImg);
        }
    }
}
