<?php
/*
 ***********************************************************/
/**
 * @name          : Apptha WP Banner Image Slider.
 * @version	      : 1.6
 * @package       : apptha
 * @since         : Wordpress 3.2.1
 * @subpackage    : Apptha WP Banner Image Slider.
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : General Public License version 2 or later; see LICENSE.txt
 * @Creation Date : July 20 2011
 * @Modified Date : Jul 19, 2012
 * */

/*
 ***********************************************************/

// UPDATING THE PAGES OF STYLES FOR THE BANNER

require_once('./apptha_wpdirectory.php');  // Load file for the plugin
global $wpdb;

  $bann_style   = $_REQUEST['bann_style'];
  $bgcolor      = '#'.$_REQUEST['bgcolor'];
  $bordercolor  = '#'.$_REQUEST['bordercolor'];
  $hovercolor   = '#'.$_REQUEST['bghover'];
  $fontcolor    = '#'.$_REQUEST['fontcolor'];
  $thumb_text   = '#'.$_REQUEST['thumb_text'];
  $bann_borsize = $_REQUEST['bann_borsize'];

  $font_size   = $_REQUEST['fontsize'];
  $fontfamily  = $_REQUEST['fontfamily'];
  $bann_width  = $_REQUEST['bannwidth'];
  $bann_height = $_REQUEST['bannheight'];
 
  $cornerradius = $_REQUEST['corner'];
  $bannspacing  = $_REQUEST['bannspacing'];
  $bann_timing  = $_REQUEST['bann_timing'];
 
  $bgfont_color = $fontcolor.','.$thumb_text;
     
        $sql = $wpdb->get_results("UPDATE " . $wpdb->prefix . "bannerstyles SET
         bann_bgcolor = '$bgcolor', bann_border = '$bordercolor',bann_borsize = '$bann_borsize',bann_hover = '$hovercolor',bann_corner = '$cornerradius',
         bann_fontcolor = '$bgfont_color', bann_fontfamily = '$fontfamily', bann_fontsize = '$font_size',bann_width = '$bann_width',
         bann_height = '$bann_height',bann_spacing= '$bannspacing',bann_timing='$bann_timing'
         WHERE bann_tempid = '$bann_style'");
  ?>
