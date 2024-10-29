<?php
/*
 ***********************************************************/
/**
 * @name          : Apptha WP Banner Image Slider.
 * @version	  : 1.5
 * @package       : apptha
 * @since         : Wordpress 3.2.1
 * @subpackage    : Apptha WP Banner Image Slider.
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : General Public License version 2 or later; see LICENSE.txt
 * @Creation Date : July 20 2011
 * @Modified Date : November 01 2011
 * */

/*
 ***********************************************************/
require_once('../../../../wp-load.php');

$dbtoken = md5(DB_NAME);
$token = trim($_REQUEST["token"]);

if($dbtoken != $token ){
    die("You are not authorized to access this file");
}
   class SimpleImage {
   var $image;
   var $image_type;
 
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }
}

require_once('../apptha_wpdirectory.php');
global $wpdb;

$uploaddir = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/apptha_banner_images/uploads/"; // Getting the directory to load images
$file      = $uploaddir . basename($_FILES['uploadfile']['name']);
$thumb     = $_FILES['uploadfile']['name'];
$size      = $_FILES['uploadfile']['size'];

$image = new SimpleImage();
$image->load($_FILES['uploadfile']['tmp_name']);

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file))
{
    $img_file = $_FILES['uploadfile']['name'];
 /******************************************    INSERT THE IMAGE IN THE TABLE         ******************************************/
    $upload_image =  $wpdb->query("INSERT INTO " . $wpdb->prefix . "bannerimages (`bann_img`, `bann_imgname`, `bann_imgdesc`, `bann_imgstatus`)
                                                                          VALUES ('$img_file', '', '', '1')");

       $lastid           = $wpdb->insert_id;
       $album_image      = $wpdb->get_var("select bann_img from " . $wpdb->prefix . "bannerimages WHERE bann_imgid='$lastid'");
       
       $filenameext      = explode('.',$album_image);
       $filenameextcount = count($filenameext);
       $thumbfile        = $lastid . "_thumb." . $filenameext[(int) $filenameextcount - 1];
       $image->save($uploaddir . $thumbfile);

/******************************************       THUMB IMAGE RESIZE AND SAVE     ******************************************/
                $thumb_file = dirname(dirname(dirname(dirname(__FILE__)))) . "/uploads/apptha_banner_images/thumbnails/"; // Getting the folder to load the thumb images
                $twidth = 100;
                $theight =100;
               
                $image->resize($twidth,$theight);
                $image->save($thumb_file . $thumbfile);
                
                // update the table with resized image name
                $upd = $wpdb->query("UPDATE " . $wpdb->prefix . "bannerimages SET bann_img='$thumbfile',`bann_imgsort`='$lastid' WHERE bann_imgid=$lastid");
                echo "success";
 }
 else
 {
	       echo "error ".$_FILES['uploadfile']['error']." --- ".$_FILES['uploadfile']['tmp_name']." %%% ".$file."($size)";
 }
?>