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
  $banner_show = $wpdb->get_row("SELECT *  FROM " . $wpdb->prefix . "bannerstyles WHERE bann_tempname='smooth_slider'");
  $banner_show_img = $wpdb->get_var("SELECT count(*) FROM  " . $wpdb->prefix . "bannerimages WHERE bann_imgstatus='1'");
  $thumb_font  = explode(',',$banner_show->bann_fontcolor);
  $bannerImg =  apiKey();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/smooth_slider/css/template.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/smooth_slider/css/template.css" />
	<script type="text/javascript" src="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/smooth_slider/js/jqtransform.js"></script>

       <script type="text/javascript">
	var $j=jQuery.noConflict();
		 $j(document).ready(function() {
		$j(function(){
			 $j('#select-form').jqTransform({imgPath:'http://livedemo00.template-help.com/virtuemart_35208/templates/theme168/images/'});
		});
	});
	</script>
	<script type="text/javascript" src="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/smooth_slider/js/jscript2_ytms.js"></script>
	<script type="text/javascript" src="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/smooth_slider/js/jscript2_ytms_butter.js"></script>
	<script type="text/javascript" src="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/smooth_slider/js/jscript2_xjquery.easing.1.3.js"></script>

	<!--[if lt IE 7]>
		<div style=' clear: both; text-align:center; position: relative;'>
			<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0"  alt="" /></a>
		</div>
	<![endif]-->
	<style>
	   .featuredBorder ,  .related .extra-releted , .row1 , .apptha_pagination li.current a img , .apptha_pagination li a:hover img , .main-1 , .module-categories h3 , .module_LoginForm , .module_multi h3  , .module_multi .boxIndent ,
	   .browseAddToCartContainer .addtocart_button , .vmCartContainer .addtocart_button , .Product-border , .continue_link , .checkout_link , .button.color , a.button.color ,.ship-adress , .ship-adress1 , .module h3,
		.module_text h3, .module_menu h3 , .module .boxIndent, 	.module_text .boxIndent, 	.module_menu .boxIndent
	  {
		 	behavior:url(/virtuemart_35208/templates/theme168/PIE.php)
		}
	</style>
        <?php
        echo '<style type="text/css">
.apptha_slider
{
            
	        background:' . $banner_show->bann_bgcolor . ';
            height:'.$banner_show->bann_height.'px;
            border-top-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            -moz-border-radius: ' . $banner_show->bann_corner . 'px;
    
}
#smooth_slider
{
  margin-top:'.$banner_show->bann_spacing . 'px;
            margin-bottom:'.$banner_show->bann_spacing . 'px;
}
.pic
{
height:100% !important;
 border-right:'.$banner_show->bann_border.' solid '.$banner_show->bann_borsize.'px;
            
            border-top-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            -moz-border-radius: ' . $banner_show->bann_corner . 'px;
}
.descr h2
{
background: none !important;
padding-top:15px;
font-family:' . $banner_show->bann_fontfamily . ';
color:' . $thumb_font[0] . ';
font-size: '.$banner_show->bann_fontsize.'px;
font-weight:bold;

}
.descr p
{
background: none !important;
font-family:' . $banner_show->bann_fontfamily . ';
color:' . $thumb_font[0] . ';
padding-top:5px;
font-size: '.$banner_show->bann_fontsize.'px;
}
.thumb_bottom {
  
            background:' . $banner_show->bann_bgcolor . ';
            border-left:'.$banner_show->bann_border.' solid '.$banner_show->bann_borsize.'px;
            border-right:'.$banner_show->bann_border.' solid '.$banner_show->bann_borsize.'px;
            border-bottom:'.$banner_show->bann_border.' solid '.$banner_show->bann_borsize.'px;
            border-bottom-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-bottom-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top:'.$banner_show->bann_border.' solid '.$banner_show->bann_borsize.'px;
            border-top-left-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            border-top-right-radius: ' . $banner_show->bann_corner . 'px ' . $banner_show->bann_corner . 'px;
            -moz-border-radius: ' . $banner_show->bann_corner . 'px;
  }


</style>';
        $result = $wpdb->get_results("SELECT bann_img,bann_imgname,bann_imgdesc,bann_imgurl FROM " . $wpdb->prefix . "bannerimages WHERE bann_imgstatus='1' ORDER BY bann_imgsort ASC");
  
        ?>
<div class="apptha_clear"></div>
<div id="smooth_slider">
 <div id="apptha_slide">
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

<?php }
if(count($result) > 0)
{
      
?>
		<div class="apptha_slider">
			<ul class="items">
                              <?php
            foreach($result as $get_images)
            {
            ?>
				<li><a href="<?php echo $get_images->bann_imgurl;?>" target="_blank"><img src="<?php echo $site_url;?>/wp-content/uploads/apptha_banner_images/uploads/<?php echo $get_images->bann_img;?>" title="<?php echo $get_images->bann_imgname;?>" /></a>
       
					<div class="banner">
						<div class="descr">
							<h2><?php echo $get_images->bann_imgname;?></h2>
                                                        <p><?php echo $get_images->bann_imgdesc;?></p>
						</div>
						</div>
				</li>
				<?php } ?>
			</ul>

		</div>
          <div class="thumb_bottom">
		<ul class="apptha_pagination clearfix"  >
                                        <?php
            foreach($result as $get_images)
            {
            ?>
			  <li><a href="#"><img src="<?php echo $site_url;?>/wp-content/uploads/apptha_banner_images/thumbnails/<?php echo $get_images->bann_img;?>" title="<?php echo $get_images->bann_imgname;?>"
             /></a></li>
			  
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
    var $j=jQuery.noConflict();
    var get_width = '<?php echo $banner_show->bann_width ?>';
    var get_imgCount = '<?php echo $banner_show_img;?>';
    var get_border   = '<?php echo $banner_show->bann_borsize;?>';
   if(get_width == 'auto')
      {
        var corWidth = document.getElementById('smooth_slider').offsetWidth;
      }
    else
    {
         var corWidth = get_width;
    }
    var calBrd = corWidth-(2*get_border);
    var calUi = calBrd/get_imgCount;
    var calThumb   = get_imgCount*106;

     $j(".apptha_slider").css('width',corWidth);
    $j('.thumb_bottom').css('width',calBrd);
    $j('#apptha_slide ul.apptha_pagination li img').css('width', calUi-6);
   // $j('#apptha_slide ul.apptha_pagination').css('width',calThumb);
      
		 $j(document).ready(function() {
		$j(function(){
			 $j('#select-form').jqTransform({imgPath:'http://livedemo00.template-help.com/virtuemart_35208/templates/theme168/images/'});
		});
	});
		$j(document).ready(function(){
		$j(function(){
			$j('.apptha_slider')._TMS({
				prevBu:'.prev',
				nextBu:'.next',
				playBu:'.play',
				duration:1100,
				easing:'easeOutQuad',
				preset:'fadeThree',
				pagination:'.apptha_pagination',
				slideshow:'<?php echo $banner_show->bann_timing*1000; ?>',
				numStatus:false,
				banners:'fromRight',// fromLeft, fromRight, fromTop, fromBottom
				waitBannerAnimation:false,
				progressBar:'<div class="progbar"></div>'
             })
		})
                 

	 });
        </script>