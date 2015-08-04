<?php

class generic_function {

    function get_css() {
        $files = scandir('css/');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                echo '<link href="css/' . $file . '" rel="stylesheet" type="text/css" />';
            }
        }
    }

    function get_js() {
        $files = scandir('js/');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                echo '<script src="js/' . $file . '" type="text/javascript"></script>';
            }
        }
    }

    function get_image() {
        $files = scandir('images/slideshow/');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                echo '<div><img src="images/slideshow/' . $file . '" /></div>';
            }
        }
    }

    function get_gallery() {
        $files = scandir('images/gallery/');
        $i = 1;
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                echo '<div class="gal_icons"><a href="javascript:void(0)" id="img' . $i . '"><img id="img_path' . $i . '" src="images/gallery/' . $file . '"  style="width: 100%;"/></a></div>';
                $i++;
            }
        }
        return $i;
    }
    
    function flash_store($key, $msg){
//        $f
    }

    function sanitize_output($buffer) {
        $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
        $replace = array('>', '<', '\\1');
        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }

}
