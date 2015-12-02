<?php 
	require('global.php');
	
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $albumName = $request->albumName;
    $dir = "{$base_dir}{$albumName}";
    $files = array_values(preg_grep('/^\.+/', scandir($dir), PREG_GREP_INVERT));
    $photos = array();

    foreach ($files as $file){
        $photo = new stdClass();
        $photo->filename = $file;

        $photos[] = $photo;
    }

    header("Content-Type:text/html; charset=utf-8");
    print_r(json_encode($photos));	