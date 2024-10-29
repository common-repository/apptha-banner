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
  global $wpdb;
  $site_url   = get_bloginfo('url');
  $plugin_name   = explode('/',dirname(plugin_basename(__FILE__)));
  $folder_name   = $plugin_name[0];
  $banner_show = $wpdb->get_row("SELECT *  FROM " . $wpdb->prefix . "bannerstyles WHERE bann_tempname='lof_slider'");
  $banner_show_img = $wpdb->get_var("SELECT count(*) FROM  " . $wpdb->prefix . "bannerimages WHERE bann_imgstatus='1'");
  $bannerImg =  apiKey();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/lof_slider/css/layout.css" />
<script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/lof_slider/js/jquery.easing.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/lof_slider/js/script.js"></script>

<style>
	ul.lof-main-wapper li {
		position:relative;
	}
</style>
<div class="apptha_clear"></div>
<div id="lof_container">
<?php
 if($banner_show->bann_width != 'auto')
      {
		    $assign_width = $banner_show->bann_width.'px';
	
      }
      else
      {
          $assign_width = '100%';
      }
      $thumb_font  = explode(',',$banner_show->bann_fontcolor);
          
echo '<style>
    .lof-slidecontent{
	   	    border:'.$banner_show->bann_border.' solid '.$banner_show->bann_borsize.'px;
	        background:' . $banner_show->bann_bgcolor . ';
            border-bottom-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-bottom-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            margin-top:'.$banner_show->bann_spacing . 'px;
            margin-bottom:'.$banner_show->bann_spacing . 'px;
            -moz-border-radius: ' . $banner_show->bann_corner . 'px;
          
         height:' . $banner_show->bann_height. 'px;
         font-family:' . $banner_show->bann_fontfamily . ';
         color:' . $banner_show->bann_fontcolor . ';
         }
    .lof-navigator li.active div{
         background:' . $banner_show->bann_hover . ';
         }
    .lof-navigator li div{
         background:' . $banner_show->bann_bgcolor . ';
        }
    .lof-navigator li.active div .lof_text{
     font-family:' . $banner_show->bann_fontfamily . ';
         color:' . $thumb_font[1] . ';
         font-size: '.$banner_show->bann_fontsize.'px;
             font-weight:bold;
    }

 .lof-navigator li.active div .lof_desc{
     font-family:' . $banner_show->bann_fontfamily . ';
         color:' . $thumb_font[1] . ';
         font-size: '.$banner_show->bann_fontsize.'px;
    }
    .lof_text
         {
         font-family:' . $banner_show->bann_fontfamily . ';
         color:' . $thumb_font[0] . ';
         font-size: '.$banner_show->bann_fontsize.'px;
         font-weight:bold;
         }
         .lof_desc
         {
         font-family:' . $banner_show->bann_fontfamily . ';
         color:' . $thumb_font[0] . ';
         font-size: '.$banner_show->bann_fontsize.'px;
         }
         .right_tab
         {
           border-top:'.$banner_show->bann_border.' solid 3px;
         }
</style>';
$result = $wpdb->get_results("SELECT bann_img,bann_imgname,bann_imgdesc,bann_imgurl FROM " . $wpdb->prefix . "bannerimages WHERE bann_imgstatus='1' ORDER BY bann_imgsort DESC");
if(count($result) > 0)
{

?>
<!------------------------------------- THE CONTENT ------------------------------------------------->
<div id="lofslidecontent45" class="lof-slidecontent">
<div class="preload"><div></div></div>
 <!-- MAIN CONTENT -->
  <?php
  $option_title = $wpdb->get_var("SELECT option_value FROM " . $wpdb->prefix . "options WHERE option_name='get_api_key'");
    $get_title = unserialize($option_title);
    $strDomainName = $site_url;
           preg_match("/^(http:\/\/)?([^\/]+)/i", $strDomainName, $subfolder);
	preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $subfolder[2], $matches);
	$customerurl = $matches['domain'];
	$customerurl = str_replace("www.", "", $customerurl);
	$customerurl = str_replace(".", "D", $customerurl);
	$customerurl = strtoupper($customerurl);
	$get_option_title = appbanner_generate($customerurl);
if ($get_title['title'] != $get_option_title) {
    echo $bannerImg;
    ?>

<?php } ?>
  <div class="lof-main-outer">
  	<ul class="lof-main-wapper" id="lof-main-wapper">
            <?php
            foreach($result as $get_images)
            {
            ?>
  		<li>
                    <a href="<?php echo $get_images->bann_imgurl;?>" target="_blank">
            <img src="<?php echo $site_url;?>/wp-content/uploads/apptha_banner_images/uploads/<?php echo $get_images->bann_img;?>" title="<?php echo $get_images->bann_imgname;?>"
            height="<?php echo $banner_show->bann_height.'px';?>" /></a>
                
        </li>
       <?php } ?>
      </ul>
  </div>
  <!-- END MAIN CONTENT -->
    <!-- NAVIGATOR -->

  <div class="lof-navigator-outer">
  		<ul class="lof-navigator">
                     <?php
            foreach($result as $get_images)
            {
            ?>
            <li>
            	<div class="right_tab">
                	<img src="<?php echo $site_url;?>/wp-content/uploads/apptha_banner_images/uploads/<?php echo $get_images->bann_img;?>" />
                        
                        <div  class="lof_clear"><h3 class="lof_text"><?php echo substr($get_images->bann_imgname,0,25);?></h3>
                  	<span class="lof_desc"><?php echo  substr($get_images->bann_imgdesc,0,55);?></span> </div>
                </div>
            </li>
          <?php } ?>
        </ul>
  </div>
 </div>
    </div>
<?php }

else {
     echo '<div align="center">Please Upload Images For Banner</div>';
}
?>
<div class="apptha_clear"></div>
<script type="text/javascript">
    var noConflict = jQuery.noConflict();
    var get_width = '<?php echo $banner_show->bann_width ?>';
    var get_imgCount = '<?php echo $banner_show_img;?>';
    var get_border   = '<?php echo $banner_show->bann_borsize;?>';
   if(get_width == 'auto')
      {
        var corWidth = document.getElementById('lof_container').offsetWidth;
      }
    else
    {
         var corWidth = get_width;
    }


    var caliUi = corWidth*(70/100)*(get_imgCount)
    var corBord = corWidth-(2*get_border);
    noConflict("#lofslidecontent45").css('width',corBord);
    noConflict("#lof-main-wapper").css('width',caliUi);
    noConflict('ul.lof-main-wapper li').css('width', corWidth*(70/100))
   
    noConflict(document).ready( function(){
		noConflict('#lofslidecontent45').lofJSidernews( {
                interval:5000,
                easing:'easeInOutQuad',

                height: '<?php echo $banner_show->bann_height;?>',
                width:corWidth*(70/100),
                second_width:corWidth*(30/100),
                duration:'<?php echo $banner_show->bann_timing*1000; ?>',
		auto:true } );
	});
</script>