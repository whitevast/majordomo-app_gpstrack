<?php

$color = $_GET['color'];
if (!$color) {
    $color = '#ff0000';
}

header('Content-Type: image/png');

$width = 20;
$height = $width;

if (!preg_match('/^#/',$color)) $color = '#'.$color;

list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");

$image = imagecreatetruecolor($width, $height);
$color = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $color);

$circle_width = $width-2;
$circle_height = $height-2;
$center_x = round($width/2);
$center_y = round($height/2);

$col=imagecolorallocate($image,$r,$g,$b);
//imagefilledellipse($image, $center_x, $center_y, $circle_width, $circle_height,$col);

$points = array(
    0, 0,				// start
    0+$width-1, 0,				// base
    0+round($width/2), $y+$height 	// apex
);
imagefilledpolygon($image, $points, 3, $col);

$col=imagecolorallocate($image,0,0,0);
imagepolygon($image, $points, 3, $col);

imagealphablending($image,false);
imagesavealpha($image,true);

imagepng($image);