<?php

if (!empty($_GET['target'])) {
    $target = $_GET['target'];

    if ($target == 'showGallery') {
        require '../init.php';
        if (get_image()) {
            $imageNames = get_image();
        } else {
            $errorMsg = 'Nothing to display. Please upload some pictures.';
        }
    }
    if ($target == 'uploadGallery') {
        require '../../init.php';
        $imgFile = $_FILES['imgFile'];
        $filePath = fileCheck($imgFile);
        if (!empty($filePath)) {
            $_SESSION['status'] = 'ok';
            $_SESSION['flashData'] = 'Upload successful.';
            header('location:' . baseUrl . 'admin/gallery/');
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'File path not found';
            header('location:' . baseUrl . 'admin/gallery/');
        }
    }

    if ($target == 'deleteGallery') {
        require '../../init.php';
        if (!empty($_GET['id'])) {
            if (unlink($_SESSION['rootDir'] . '/' . 'images/gallery/' . $_GET['id'])) {
                $_SESSION['status'] = 'ok';
                $_SESSION['flashData'] = 'Delete successful.';
                header('location:' . baseUrl . 'admin/gallery/');
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['flashData'] = 'Cannot delete the image.';
                header('location:' . baseUrl . 'admin/gallery/');
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'Token is invalid.';
            header('location:' . baseUrl . 'admin/gallery/');
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
            header('location:' . baseUrl . 'admin/gallery/');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['flashData'] = 'File is not selected';
        header('location:' . baseUrl . 'admin/gallery/');
    }
}

function fileUpload($imgFile) {
    $file_path = $_SESSION['rootDir'] . '/images/gallery/' . basename($imgFile["name"]);
    if (fileExists($file_path)) {
        if (move_uploaded_file($imgFile["tmp_name"], $file_path)) {
            resizeImage($file_path);
            return 'images/gallery/' . basename($imgFile["name"]);
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['flashData'] = 'File can not be uploaded';
            header('location:' . baseUrl . 'admin/gallery/');
            exit();
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['flashData'] = 'Same file cannot be uploaded twice';
        header('location:' . baseUrl . 'admin/gallery/');
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
    $new_file_path = $_SESSION['rootDir'] . '/images/gallery/' . basename($imgPath);
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
