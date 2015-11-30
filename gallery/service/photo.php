<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require('global.php');

function outputImage($createfromfn, $imagefn, $type, $header, $imgname) 
{         
    header($header);
    
    if ($type == 'thumb') {
        // 	resize image
        list($width, $height) = getimagesize($imgname);
        
        $resizewidth = 200;
        $newwidth    = $resizewidth;
        $newheight   = $resizewidth * $height / $width;
        
        $thumb  = imagecreatetruecolor($newwidth, $newheight);
        $source = $createfromfn($imgname);
        
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        
        $imagefn($thumb);
    } else {
        $source = $createfromfn($imgname);
        $imagefn($source);
    }
} 


$imgrequest = $_GET['name'];
$type       = "full";


if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

$imgname = "{$base_dir}{$imgrequest}";

if (file_exists($imgname)) {
    $file_parts = pathinfo($imgname);
    $header     = '';
	$createfromfn = '';
	$imagefn = '';
    
    switch (strtolower($file_parts['extension'])) {
        case "jpg":
			$header = 'Content-Type: image/jpg';
			$createfromfn = 'imagecreatefromjpeg';
			$imagefn = 'imagejpeg';
            break;
        
        case "png":
			$header = 'Content-Type: image/png';
			$createfromfn = 'imagecreatefrompng';
			$imagefn = 'imagepng';
            break;
        
        case "": // Handle file extension for files ending in '.'
        case NULL: // Handle no file extension
            break;
    }
	
	outputImage($createfromfn, $imagefn, $header, $type, $imgname);
    exit;
}