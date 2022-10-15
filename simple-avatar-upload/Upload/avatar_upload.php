<?php
/*
* Simple Avatar Upload
* Author - ic-myXMB
*
*/

// display errors if needed else comment out below
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// if no file was selected on submit
if ($_FILES['avatar_file_upload']['name'] == '') { 

	// if so, echo such is the case
	echo "<p>No upload file was selected thus none was submitted! Please try again.</p>";

	// if so, then redirect back to the fileupload form
	header("Refresh:3; url= index.html", true, 303);
}

// define upload file directory
$file_dir = "avatars";

// echo file infos
foreach ($_FILES as $file_name => $file_data) {

    // if is image file type then get image width and height
	list($width, $height) = getimagesize($file_data["tmp_name"]);

	// if so, also display echo image file infos
	// else comment out the 4 echos below if info display is not desired (ie: path, name, type, size)

	// echo temp path
	echo "temp path: ".$file_data["tmp_name"]."<br/>\n";

	// echo file name
	echo "file name: ".$file_data["name"]."<br/>\n";

	// echo file type
	echo "file type: ".$file_data["type"]."<br/>\n";

	// echo file size
	echo "file size: ".$file_data["size"]." bytes<br/>\n";

    // echo file extension info
	$path = $file_data["name"]; // file data name
	$ext = pathinfo($path, PATHINFO_EXTENSION); // extension name

    // if such file is an image file type
	if ($ext == "jpg" OR $ext == "jpeg" OR $ext == "gif" OR $ext == "png") {	
        // if so, also display image dimension infos

	    // else comment out the 2 echos below if info display is not desired (ie: width, height)

	    // echo file width
	    echo "image width: ".$width." px<br/>\n";	

	    // echo file height
	    echo "image height: ".$height." px<br/>\n";

	    // allowed max width & height
	    $max_width = 100; // allowed width
	    $max_height = 100; // allowed height

	    // if width & height is less than allowed 100x100 then such is not allowed
	    if ($width < $max_width || $height < $max_height) {
	        // if so, cancel the upload

	        // if so, echo a no go notice
	        echo "The image dimensions are smaller than is allowed! Please upload an image 100px by 100px in size.<br/>";

	        // if so, then redirect back to fileupload form
	        header("Refresh:3; url= index.html", true, 303);	         
	    }	

	    // if width & height is greater than allowed 100x100 then such is not allowed
	    if ($width > $max_width || $height > $max_height) {
	        // if so, cancel the upload

	        // if so, echo a no go notice
	        echo "The image dimensions are larger than is allowed! Please upload an image 100px by 100px in size.<br/>";

	        // if so, then redirect back to fileupload form
	        header("Refresh:3; url= index.html", true, 303);	         
	    }
    
	    // if width & height is equal to allowed 100x100 then such is allowed
	    if ($width == $max_width || $height == $max_height) {
	       // if so, do the upload

           // if is an uploaded file
	       if (is_uploaded_file($file_data["tmp_name"])) {

		      // if so, temp explode
		      $temp = explode(".", $file_data["name"]);

		      // if so, do new file name from temp
		      $new_filename = round(microtime(true)) . '.' . end($temp);

              // if so, move upload file or die
		      move_uploaded_file($file_data["tmp_name"], "$file_dir/".$new_filename) or die ("Could not upload image file!");

	          // if so, is an image file so echo image uploaded success notice
		      echo "The image file was uploaded!<br/>";

		      // new filename is avatar_image as avatar_image is avatar
		      $avatar_image = "$file_dir/".$new_filename; 
		      $avatar = $avatar_image;

		      // if so, echo display uploaded image file name
		      // else comment out new filename echo below
              // echo new filename
		      echo "New filename: ".$new_filename."<br />";

		      // display image
		      // echo avatar img
		      echo "<img src=\"$avatar\">";

	       }

	    }

	} else {

	    // file type is not an image file so echo an invalid image format notice
	    echo "File is not an image thus it is an invalid image format. Only upload JPG or JPEG or GIF or PNG file types.";

	    // then redirect back to the fileupload form
	    header("Refresh:3; url= index.html", true, 303);	        	    

	}

}   

?>
