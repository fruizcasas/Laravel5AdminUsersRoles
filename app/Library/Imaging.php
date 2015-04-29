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
     * @param $source
     * @param $target
     * @param $w
     * @param $h
     */
    static public function img_resize($source, $target, $w, $h) {
        list($w_orig, $h_orig) = getimagesize($source);
        $scale_ratio = $w_orig / $h_orig;
        if (($w / $h) > $scale_ratio) {
            $w = $h * $scale_ratio;
        } else {
            $h = $w / $scale_ratio;
        }
        $ext = strtolower(pathinfo($source,PATHINFO_EXTENSION));
        if ($ext == "gif"){
            $img = imagecreatefromgif($source);
        } else if($ext =="png"){
            $img = imagecreatefrompng($source);
        } else {
            $img = imagecreatefromjpeg($source);
        }
        $tci = imagecreatetruecolor($w, $h);
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        $ext = strtolower(pathinfo($target,PATHINFO_EXTENSION));
        if ($ext == "gif"){
            imagegif($tci, $target);
        } else if($ext =="png"){
            imagepng($tci, $target);
        } else {
            imagejpeg($tci, $target, 84);
        }
    }
    /**
     * ---------------- THUMBNAIL (CROP) FUNCTION ------------------
     * Function for creating a true thumbnail cropping from any jpg, gif, or png image files
     * ---------------- THUMBNAIL (CROP) FUNCTION ------------------
     * @param $source
     * @param $target
     * @param $w
     * @param $h
     */
    static public function img_thumb($source, $target, $w, $h) {
        $ext = strtolower(pathinfo($source,PATHINFO_EXTENSION));
        list($w_orig, $h_orig) = getimagesize($source);
        $src_x = ($w_orig / 2) - ($w / 2);
        $src_y = ($h_orig / 2) - ($h / 2);
        if ($ext == "gif"){
            $img = imagecreatefromgif($source);
        } else if($ext =="png"){
            $img = imagecreatefrompng($source);
        } else {
            $img = imagecreatefromjpeg($source);
        }
        $tci = imagecreatetruecolor($w, $h);
        imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
        if ($ext == "gif"){
            imagegif($tci, $target);
        } else if($ext =="png"){
            imagepng($tci, $target);
        } else {
            imagejpeg($tci, $target, 84);
        }
    }
    /**
     * ------------------ IMAGE CONVERT FUNCTION -------------------
     * Function for converting GIFs and PNGs to JPG upon upload
     * ------------------ IMAGE CONVERT FUNCTION -------------------
     * @param $source
     * @param $target
     */
    static public function img_convert_to_jpg($source, $target) {
        $ext = strtolower(pathinfo($source,PATHINFO_EXTENSION));
        list($w_orig, $h_orig) = getimagesize($source);
        $img = "";
        if ($ext == "gif"){
            $img = imagecreatefromgif($source);
        } else if($ext =="png"){
            $img = imagecreatefrompng($source);
        }
        $tci = imagecreatetruecolor($w_orig, $h_orig);
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
        imagejpeg($tci, $target, 84);
    }

}