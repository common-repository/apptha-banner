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
    $site_url       = get_bloginfo('url');
    $plugin_name    = explode('/',dirname(plugin_basename(__FILE__)));
    $folder_name    = $plugin_name[0];
    $banner_show = $wpdb->get_row("SELECT *  FROM " . $wpdb->prefix . "bannerstyles WHERE bann_tempname='navo_slider'");
   $edit_color   = explode(',',$banner_show->bann_fontcolor);
    $banner_thumb = $edit_color[1];
    $banner_color = $edit_color[0];
   
?>

<link rel="stylesheet" href="<?php echo $site_url .'/wp-content/plugins/'.$folder_name.'/navo_slider/css/global.css'?>">
<script type="text/javascript" src="<?php echo $site_url . '/wp-content/plugins/'.$folder_name.'/navo_slider/js/jquery1.5.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $site_url . '/wp-content/plugins/'.$folder_name.'/navo_slider/js/slides.min.jquery.js'; ?>"></script>
<script type="text/javascript">
 var get_width = '<?php echo $banner_show->bann_width; ?>';
 var conflict = jQuery.noConflict();
 conflict(function(){
     //conflict('#banner_solu').html('<?php //echo apiKey();?>');
      			conflict('#slides').slides({
				preload: true,
				preloadImage: '/img/loading.gif',
				play:  '<?php echo $banner_show->bann_timing*1000; ?>',
				pause: '<?php echo $banner_show->bann_timing*1000; ?>',
				hoverPause: true,
				animationStart: function(current){
					conflict('.caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					conflict('.caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					conflict('.caption').animate({
						bottom:0
					},200);
				}
			});
                      
		});
</script>
<?php
$bannerImg =  apiKey();
$result = $wpdb->get_results("SELECT t2.bann_height,t1.* FROM " . $wpdb->prefix . "bannerimages as t1 INNER JOIN
                                     " . $wpdb->prefix . "bannerstyles as t2 WHERE t1.bann_imgstatus='1' and t2.bann_status='ON' ORDER BY t1.bann_imgsort ASC");

$get_width = $banner_show->bann_width;
    if($get_width == 'auto')
    {
    	if($banner_show->bann_borsize == '' || $banner_show->bann_borsize == '0')
    	{
    		 $assign_width = '100%';
	         $minus_brd  = '100%';
	         echo '<style>.slides_container { width:'.$assign_width.'}  
	        </style>';
    	}
    	else
       {
    		  $assign_width = '100%';
	          $minus_brd  = '100%';
	          echo '<style>.slides_container { width:'.$assign_width.'} </style>';
    	}
   
    }
    else
    {
		    $assign_width = $banner_show->bann_width.'px';
			$minus_brd = ($banner_show->bann_width) - (2*$banner_show->bann_borsize).'px';
			echo '<style>.slides_container { width:'.$minus_brd.'} </style>';
    }
    

if(count($result) == '1')
{
echo '<style> .caption { bottom:0px;}</style>';
}
echo '<style>
     #slides{
            font-family:' . $banner_show->bann_fontfamily . ';
            color:' . $banner_show->bann_fontcolor . ';
	        background:' . $banner_show->bann_bgcolor . ';
           
           }
     
#container_navo { width:'.$assign_width.';}
#apptha_inner { background-color: '.$banner_show->bann_border.';
            border-bottom-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-bottom-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            margin-top:'.$banner_show->bann_spacing . 'px;
            margin-bottom:'.$banner_show->bann_spacing . 'px;
            -moz-border-radius: ' . $banner_show->bann_corner . 'px;
	        padding: '.$banner_show->bann_borsize.'px; 
           }
	       
            #slides .prev { top: '.$banner_show->bann_height/(2).'px}
            #slides .next {top:'.$banner_show->bann_height/(2).'px}

            .slide img
            {
             border-top-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
           -moz-border-radius: ' . $banner_show->bann_corner . 'px;
	         } 
            
    .slides_container { height:'.$banner_show->bann_height.'px }
    .slides_container div.slide { width:'.$assign_width.'; height:'.$banner_show->bann_height.'px }
    .caption { width:'.$assign_width.';}
    .caption h2 { font-size:'.$banner_show->bann_fontsize.'px;color:'.$banner_color.' !important; font-family:'. $banner_show->bann_fontfamily . ' !important;}
    .caption p { font-size:'.$banner_show->bann_fontsize.'px;color:'.$banner_color.'; font-family:' . $banner_show->bann_fontfamily . ' !important;}
</style>';

?>

<div class="apptha_clear"></div>

<div id="container_navo">
<?php

if(count($result) > 0)
{
?>
    <div id="apptha_inner">
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
            }
    ?>
    <div id="slides">
        <div class="slides_container">
        <?php
         global $wpdb;
         $banner_bind ='';
             foreach($result as $res)
             { ?>
                <div class="slide">
                    <a href="<?php echo $res->bann_imgurl; ?>" target="_blank">
                <img src="<?php echo $site_url.'/wp-content/uploads/apptha_banner_images/uploads/'.$res->bann_img ;?>" width="<?php echo $minus_brd;?>"  height="<?php echo $banner_show->bann_height.'px';?>" alt="" /></a>
                <div class="caption"><h2 class="navo_heading"><?php echo $res->bann_imgname;?></h2><p><?php echo $res->bann_imgdesc;?></p>
                </div>
                </div>
        <?php } ?>
        </div>
        <a href="#" class="prev"><img src="<?php echo $site_url.'/wp-content/plugins/'.$folder_name.'/navo_slider/img/arrow-prev.png';?>" width="24" height="43" alt="Arrow Prev"></a>
        <a href="#" class="next"><img src="<?php echo $site_url.'/wp-content/plugins/'.$folder_name.'/navo_slider/img/arrow-next.png';?>" width="24" height="43" alt="Arrow Next"></a>
    </div>
    </div>
</div>

<?php 

}

else {
     echo '<div align="center">Please Upload Images For Banner</div>';
}
?>
<div class="apptha_clear"></div>
