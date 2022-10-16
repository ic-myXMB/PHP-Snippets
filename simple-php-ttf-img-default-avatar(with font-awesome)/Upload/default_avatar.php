<?php
/*
* Simple PHP GD img TTF Default Avatar
* Author: ic-myxmb
*/

// display errors if needed else comment out below
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// create a default avatar

// if function exists not
if (!function_exists('generate_default_avatar')) {

    // create default avatar generate function
    function generate_default_avatar() {

        // font awesome 6 icon entity
        $font_text_icon = html_entity_decode('&#xf007;', 0, 'UTF-8');

        // background colour
        $background_colour = [213, 203, 198];

        // font colour
        $font_colour = [255, 255, 255];

        // font text size
        $font_text_size = 300;

        // avatar width
        $avatar_width = 600;

        // avatar height
        $avatar_height = 600;

        // font - font awesome solid 900 ttf
        $font = 'fonts/fa-solid-900.ttf';  	

    	// image create or die / @ errno supress
        $avatar_image = @imagecreate($avatar_width, $avatar_height)
            or die("Cannot Initialize new GD image stream");

        // image colour allocate
        imagecolorallocate($avatar_image, $background_colour[0], $background_colour[1], $background_colour[2]);
        
        // font colour
        $font_colour = imagecolorallocate($avatar_image, $font_colour[0], $font_colour[1], $font_colour[2]);
        
        // text bounding box
        $text_bounding_box = imagettfbbox($font_text_size, 0, $font, $font_text_icon);
        
        // x / y - bb dimensions
        // x
        $x = abs(ceil(($avatar_width - $text_bounding_box[2]) / 2));        
        // y
        $y = abs(ceil(($avatar_height - $text_bounding_box[5]) / 2));

        
        // image ttf text
        imagettftext($avatar_image, $font_text_size, 0, $x, $y, $font_colour, $font, $font_text_icon);
        
        // return avatar image
        return $avatar_image;
    }
}

// display the created default_avatar
$default_avatar = generate_default_avatar();

// output the default_avatar to browser
header("Content-Type: image/png");

//imgpng default_avatar
imagepng($default_avatar);

// clean up by destroy
imagedestroy($default_avatar);

?>
