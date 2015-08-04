<?php

session_start();
require 'config/connection.php';
require 'model/query_pak.php';
require 'utils/image_resize.php';
require 'utils/generic_func.php';
//$obj_filter = new filter();
$obj_query = new query();
$obj_function = new generic_function();
$_SESSION['rootDir'] = dirname(__FILE__);
