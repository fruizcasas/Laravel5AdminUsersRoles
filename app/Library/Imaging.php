<?php namespace App\Library;

/*
 */

/**
 * Class Imaging
 * @package App\Library

 * // ---------- Start Universal Image Resizing Function --------
 * $target_file = "uploads/$fileName";
 * $resized_file = "uploads/resized_$fileName";
 * $wmax = 500;
 * $hmax = 500;
 * Imaging::img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
 * // ----------- End Universal Image Resizing Function ----------
 *
 * // ---------- Start Convert to JPG Function --------
 * if (strtolower($fileExt) != "jpg") {
 *     $target_file = "uploads/resized_$fileName";
 *     $new_jpg = "uploads/resized_".$kaboom[0].".jpg";
 *     Imaging::img_convert_to_jpg($target_file, $new_jpg, $fileExt);
 * }
 */
class Imaging {



    /**
     * ----------------------- RESIZE FUNCTION -----------------------
     *  Function for resizing any jpg, gif, or png image files
     * ----------------------- RESIZE FUNCTION -----------------------
     *
     * @param $target
     * @param $newcopy
     * @param $w
     * @param $h
     * @param $ext
     */
    static public function img_resize($target, $newcopy, $w, $h) {
        $ext = strtolower(pathinfo($target,PATHINFO_EXTENSION));
        list($w_orig, $h_orig) = getimagesize($target);
        $scale_ratio = $w_orig / $h_orig;
        if (($w / $h) > $scale_ratio) {
            $w = $h * $scale_ratio;
        } else {
            $h = $w / $scale_ratio;
        }
        $img = "";
        $ext = strtolower($ext);
        if ($ext == "gif"){
            $img = imagecreatefromgif($target);
        } else if($ext =="png"){
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }
        $tci = imagecreatetruecolor($w, $h);
        // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        if ($ext == "gif"){
            imagegif($tci, $newcopy);
        } else if($ext =="png"){
            imagepng($tci, $newcopy);
        } else {
            imagejpeg($tci, $newcopy, 84);
        }
    }
    /**
     * ---------------- THUMBNAIL (CROP) FUNCTION ------------------
     * Function for creating a true thumbnail cropping from any jpg, gif, or png image files
     * ---------------- THUMBNAIL (CROP) FUNCTION ------------------
     * @param $target
     * @param $new_copy
     * @param $w
     * @param $h
     * @param $ext
     */
    static public function img_thumb($target, $new_copy, $w, $h) {
        $ext = strtolower(pathinfo($target,PATHINFO_EXTENSION));
        list($w_orig, $h_orig) = getimagesize($target);
        $src_x = ($w_orig / 2) - ($w / 2);
        $src_y = ($h_orig / 2) - ($h / 2);
        $ext = strtolower($ext);
        if ($ext == "gif"){
            $img = imagecreatefromgif($target);
        } else if($ext =="png"){
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }
        $tci = imagecreatetruecolor($w, $h);
        imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
        if ($ext == "gif"){
            imagegif($tci, $new_copy);
        } else if($ext =="png"){
            imagepng($tci, $new_copy);
        } else {
            imagejpeg($tci, $new_copy, 84);
        }
    }
    /**
     * ------------------ IMAGE CONVERT FUNCTION -------------------
     * Function for converting GIFs and PNGs to JPG upon upload
     * ------------------ IMAGE CONVERT FUNCTION -------------------
     * @param $target
     * @param $new_copy
     * @param $ext
     */
    static public function img_convert_to_jpg($target, $new_copy) {
        $ext = strtolower(pathinfo($target,PATHINFO_EXTENSION));
        list($w_orig, $h_orig) = getimagesize($target);
        $ext = strtolower($ext);
        $img = "";
        if ($ext == "gif"){
            $img = imagecreatefromgif($target);
        } else if($ext =="png"){
            $img = imagecreatefrompng($target);
        }
        $tci = imagecreatetruecolor($w_orig, $h_orig);
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
        imagejpeg($tci, $new_copy, 84);
    }

}