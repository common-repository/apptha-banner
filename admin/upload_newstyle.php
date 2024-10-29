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
                  
require_once('../apptha_wpdirectory.php');  // Load file for the plugin
global $wpdb;
$banner_url = get_bloginfo('url');
        define('DIR_PATH', dirname(__FILE__).'/../');
        $cname = $_FILES['new_banner']['name'];
        $tname = $_FILES['new_banner']['tmp_name'];
        $getfolder      =  explode('.',$cname);

         // Get the new banner name and match with table if banner name exist
        $get_bannername = $wpdb->get_col("SELECT bann_tempname FROM " . $wpdb->prefix . "bannerstyles");
        $key = array_search($getfolder[0],$get_bannername);
              if($key == '')  // Checking the banner name
              {
                if($getfolder[1] == 'zip') //Checking the File extension
               {
                    $zip            = new ZipArchive;
                    $res            = $zip->open($tname);
                    if ($res == TRUE)
                     {
                       $dir_move = $zip->extractTo(DIR_PATH);
                       $zip->close();
                       $explode_banner = explode('.', $cname);
                       $rest = substr($explode_banner[0], -1);
                       $dir_install_banner = $wpdb->query("INSERT INTO " . $wpdb->prefix . "bannerstyles
                       (`bann_tempname`, `bann_tempimg`, `bann_bgcolor`, `bann_border`, `bann_borsize`, `bann_fontcolor`,
                        `bann_hover`, `bann_corner`, `bann_fontfamily`, `bann_fontsize`, `bann_width`, `bann_height`, `bann_status`,
                        `bann_spacing`, `bann_timing`) VALUES
                        ('$getfolder[0]', '$getfolder[0].jpg', '#fff', '#ccc', 5, '#f4f5f6, #333','#e6e6e6', 0, 'Georgia', 13, 'auto',
                          270, 'OFF', 10, 3)");
                       echo '1';
                     } else
                     {
                          echo '0';
                     }
               //retrieve all image from database and store them in a variable
                }
                else
                {
                    echo "0";
                }
             }
           else
           {
              echo "0";
           }
           ?>
           <script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $res; ?>);</script>