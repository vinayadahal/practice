<?php

class image_resize {

    function check_action($filename, $temp_path, $final_path, $action) {
        $temp_file_path = $temp_path . '/' . $filename;
        $mime = getimagesize($temp_file_path);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($temp_file_path);
        } elseif ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($temp_file_path);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($temp_file_path);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($temp_file_path);
        }

        if ($action == 'crop') {
            return $this->image_crop($src_img, $filename, $final_path, $temp_file_path, $mime);
        } elseif ($action == 'resize_auto') {
            return $this->resize_auto($src_img, $filename, $final_path, $temp_file_path, $mime);
        }else{
            echo 'no options were chosen';
            exit();
        }
    }

    function image_crop($src_img, $filename, $final_path, $temp_file_path, $mime) {
        $to_crop_array = array('x' => 0, 'y' => 0, 'width' => 900, 'height' => 400);
        $new_image = imagecrop($src_img, $to_crop_array);
        $new_file_path = $final_path . $filename;
        unlink($temp_file_path);
        return $this->create_image($new_image, $new_file_path, $mime);
    }

    function resize_auto($src_img, $filename, $final_path, $temp_file_path, $mime) {
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = ($img_width + $img_height) / ($img_width * ($img_height / 300));
        $img_width_new = $img_width * $new_size;
        $img_height_new = $img_height * $new_size;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
        $new_file_path = $final_path . $filename;
        unlink($temp_file_path);
        return $this->create_image($new_image, $new_file_path, $mime);
    }

    function create_image($new_image, $new_file_path, $mime) {
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        }
        return $result;
    }

    function resize_custom($image_name, $new_width, $new_height, $uploadDir, $moveToDir) {//under construction
        $path = $uploadDir . '/' . $image_name;
        $mime = getimagesize($path);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($path);
        } elseif ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($path);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($path);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($path);
        }
        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);
        if ($old_x > $old_y) {
            $thumb_w = $new_width;
            $thumb_h = $old_y * ($new_height / $old_x);
        } elseif ($old_x < $old_y) {
            $thumb_w = $old_x * ($new_width / $old_y);
            $thumb_h = $new_height;
        } elseif ($old_x == $old_y) {
            $thumb_w = $new_width;
            $thumb_h = $new_height;
        }
        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y); // New save location
        $new_thumb_loc = $moveToDir . $image_name;
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($dst_img, $new_thumb_loc, 8);
        } elseif ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($dst_img, $new_thumb_loc, 80);
        }
        imagedestroy($dst_img);
        imagedestroy($src_img);
        return $result;
    }

}
