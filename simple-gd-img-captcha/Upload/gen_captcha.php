<?php
/*
* Simple GD img captcha
* Author: ic-myxmb
*/

// session start
session_start();

// create the captcha image canvas
// adjust width & height if needed below

// image canvas width
$captcha_width = 160;
// image canvas height
$captcha_height = 35;

// create image create true color
$captcha_image = imagecreatetruecolor($captcha_width, $captcha_height);

// image anti alias
imageantialias($captcha_image, true);

// colors array
$colors = [];

// red
$red = rand(125, 175);

// green
$green = rand(125, 175);

// blue
$blue = rand(125, 175);
 
for ($i = 0; $i < 5; $i++) {

  // image color allocate 
  $colors[] = imagecolorallocate($captcha_image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);

}

// image fill
imagefill($captcha_image, 0, 0, $colors[0]);

// for
for ($i = 0; $i < 10; $i++) {

  // image thickness
  imagesetthickness($captcha_image, rand(2, 10));
  
  // rectangle color
  $rectangle_color = $colors[rand(1, 4)];
  
  // image rectangle rands
  imagerectangle($captcha_image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rectangle_color);
  
}

// define the color used for the captcha image text
$white = imagecolorallocate($captcha_image, 255, 255, 255);

// load the font used for the captcha image text
$font = imageloadfont("fonts/hootie.gdf");

// captcha string do random 8 characters
$captcha_text = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 8)), 0, 8);

// session captcha current
$_SESSION['captcha_current'] = $captcha_text;

// if canvas width and height is changed also change x & y below ie: 28, 8 below to reflect dimension changes
$x = 28;
$y = 8;

// write the captcha image string 
imagestring($captcha_image, $font, $x, $y, $captcha_text, $white);

// output the captcha image to browser
header("Content-type: image/png");
imagepng($captcha_image);

// then clean up
imagedestroy($captcha_image);
 
?>
