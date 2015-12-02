<?php 
require('global.php');

$folders = array_values(preg_grep('/^[\.#]+/', scandir($base_dir), PREG_GREP_INVERT));

header("Content-Type:text/html; charset=utf-8");
print_r(json_encode($folders));