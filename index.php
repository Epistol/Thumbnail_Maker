<?php 

public function makeThumbnails($updir, $img)
    {
        // 150 or whatever you like for size
 
        $thumbnail_width = 150;
        $thumbnail_height = 150;
        $thumb_beforeword = "thumb";
        $arr_image_details = getimagesize("$updir" .  "$img"); // pass id to thumb name
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        if ($original_width > $original_height) {
            $new_width = $thumbnail_width;
            $new_height = intval($original_height * ($new_width / $original_width));
            if($new_height < $new_width){
                $pourcentage = $thumbnail_height / $new_height;
                $new_height = ($new_height * $pourcentage );
                $new_width = ($new_width * $pourcentage);
            }
        } else {
            $new_height = $thumbnail_height;
            $new_width = intval($original_width * ($new_height / $original_height));
            if($new_width < $new_height){
                $pourcentage = $thumbnail_width / $new_width;
                $new_height = ($new_height * $pourcentage );
                $new_width = ($new_width * $pourcentage);
            }
        }
        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);
        if ($arr_image_details[2] == 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom("$updir" .  "$img");
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
            $imgt($new_image, "$updir" . "/thumbs/" . "$thumb_beforeword" . "$img");
        }
    }
