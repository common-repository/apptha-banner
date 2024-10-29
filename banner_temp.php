<?php
/*
 ***********************************************************/
/**
 * @name          : Apptha WP Banner Image Slider.
 * @version	  	  : 1.6
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
global $wpdb;
$site_url = get_bloginfo('url');
$plugin_name = explode('/', dirname(plugin_basename(__FILE__)));
$folder_name = $plugin_name[0];
$banner_id     = $wpdb->get_var("SELECT bann_tempid FROM " . $wpdb->prefix . "bannerstyles WHERE bann_status='ON'");
$banner_style  = $_REQUEST['style'];
  if($banner_style == '')
            {
            $get_banner_id = $banner_id;
            }
            else
            {
            $get_banner_id = $banner_style ;
            }
require_once('../wp-content/plugins' . DIRECTORY_SEPARATOR . $folder_name . DIRECTORY_SEPARATOR . 'apptha_wpdirectory.php');  // Load file for the plugin
?>
<!--        SCRIPT AND CSS FOR JQUERY UI STYLE
-->

<script>
    var url = '<?php echo $site_url; ?>';
    var folder_name = '<?php echo $folder_name; ?>';
</script>
<script src="<?php echo $site_url . '/wp-content/plugins/' . $folder_name . '/js/mColorPicker.js'; ?>" type="text/javascript"></script>
<link href="<?php echo $site_url . '/wp-content/plugins/' . $folder_name . '/css/facebox.css'; ?>" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo $site_url . '/wp-content/plugins/' . $folder_name . '/js/facebox.js'; ?>" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo $site_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/js/banner_js.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox()
    })
</script>

<!--            DYNAMICALLY GETTING THE PREVIEW AND SHOW                        -->
<script>

    // STORING THE UPDATED STYLE TO STORED IN TABLE
    function updateDesign()
    {
        var site_url       = '<?php echo $site_url; ?>';
        var folder_name    = '<?php echo $folder_name; ?>';
        var bann_style     = '<?php echo $get_banner_id; ?>';
     
        var bgColorHeader     = document.getElementById('bgColorHeader').value;
        var bgcolor           = bgColorHeader.substr(1);
        var borderColorHeader = document.getElementById('borderColorHeader').value;
        var bordercolor       = borderColorHeader.substr(1);
        var fcHeader          = document.getElementById('fcHeader').value;
        var fontcolor         = fcHeader.substr(1);
        var backhover         = document.getElementById('bgColorhover').value;
        var bghover           = backhover.substr(1);
        var thumb_text        = document.getElementById('thumb_text').value;
        var bann_thumb        = thumb_text.substr(1);

        var bann_borsize  = document.getElementById('bannerborder').value;
        var cornerradius  = document.getElementById('cornerRadius').value;
        var fontfamily    = document.getElementById('fon_family').value;
        var fontsize      = document.getElementById('fon_size').value;
        var bannwidth     = document.getElementById('banner_width').value;
        var bannheight    = document.getElementById('banner_height').value;
       
        var bannspacing   = document.getElementById('banner_spacing').value;
        var bann_timing   = document.getElementById('banner_timing').value;

        if(bgcolor == ""  || bgcolor == "0" || bordercolor =="" || bordercolor =="0" || fontcolor == "" || fontcolor == "0" ||
        		bghover == "" || bghover == "0" ||  bann_borsize == ""  
               || cornerradius == "" ||   fontfamily == "0" ||fontfamily == "" ||  fontsize == "" 
            	   || bannwidth == "" || bannwidth == "0" ||  bannheight == "0" || bannheight == "" 
            		   || bannspacing == "" ||  bann_timing == "0" || bann_timing == ""  ){
                document.getElementById("error_msg").innerHTML = 'Please Enter Values For All The Fields ';
                return false;
            }
         
        banner = jQuery.noConflict();
        banner.ajax({
            method:"POST",
            url: site_url+'/wp-content/plugins/'+folder_name+'/banner_temp_ajax.php',
            data : "bann_style="+bann_style+"&bgcolor="+bgcolor+"&bordercolor="+bordercolor+
                "&fontcolor="+fontcolor+"&fontsize="+fontsize+"&fontfamily="+fontfamily+"&bannwidth="+bannwidth+"&bannheight="+bannheight+
                "&corner="+cornerradius+"&bghover="+bghover+"&bann_borsize="+bann_borsize+
                "&bannspacing="+bannspacing+"&bann_timing="+bann_timing+"&thumb_text="+bann_thumb,
            asynchronous:false,
            success: function() {
                // data.redirect contains the string URL to redirect to
               window.location.href = site_url+'/wp-admin/admin.php?page=banner_temp&style='+bann_style+'&msg=1';
                //showupdatemessage();
               
            }
        });

    }
    function showupdatemessage(){    
       
    	document.getElementById('showupdatemes').style.display = 'block';
    }
    function resetForm()
    {
        document.getElementById("themeConfig").reset();
        window.location = self.location;
    }
</script>
<?php

$banner_show = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "bannerstyles WHERE bann_tempid = '$get_banner_id'");
$edit_pgname = $banner_show->bann_pagename;
$edit_bgcolor = $banner_show->bann_bgcolor;
$edit_brdcolor = $banner_show->bann_border;
$edit_brdsize = $banner_show->bann_borsize;
$edit_color = explode(',', $banner_show->bann_fontcolor);
$edit_banncolor = $edit_color[0];
$edit_thumbcolor = $edit_color[1];
$edit_width = $banner_show->bann_width;
$edit_height = $banner_show->bann_height;
$edit_fntfamily = $banner_show->bann_fontfamily;
$edit_fntsize = $banner_show->bann_fontsize;
$edit_corner = $banner_show->bann_corner;
$edit_hover = $banner_show->bann_hover;

$edit_spacing = $banner_show->bann_spacing;
$edit_timing = $banner_show->bann_timing;
?>
<?php

$strDomainName = $site_url;
    preg_match("/^(http:\/\/)?([^\/]+)/i", $strDomainName, $subfolder);
	preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $subfolder[2], $matches);
	$customerurl = $matches['domain'];
	$customerurl = str_replace("www.", "", $customerurl);
	$customerurl = str_replace(".", "D", $customerurl);
	$customerurl = strtoupper($customerurl);
	$get_option_title = appbanner_generate($customerurl);

$options = get_option('get_api_key');
if (!is_array($options)) {
    $options = array('title' => '', 'show' => '', 'excerpt' => '', 'exclude' => '');
}

if (isset($_POST['submit_license'])) {
    $options['title'] = strip_tags(stripslashes($_POST['get_license']));

    update_option('get_api_key', $options);
}
$option_title = $wpdb->get_var("SELECT option_value FROM " . $wpdb->prefix . "options WHERE option_name='get_api_key'");
$get_title = unserialize($option_title);
?>
 <div class="clear"></div>
 <div class="wrap">
<div id="icon-themes" class="icon32"><br /></div>
<h2 class="nav-tab-wrapper">
    <a href="?page=banner_show" class="nav-tab">Banner Styles</a>
    <a href="?page=banner_img&style=<?php echo $_REQUEST['style'] ?>" class="nav-tab">Upload/Edit</a>
    <a href="?page=banner_temp&style=<?php echo $_REQUEST['style'] ?>" class="nav-tab nav-tab-active">Style Settings</a>
    <div class="buy">
<?php if ($get_title['title'] != $get_option_title) { ?>
            <div class="lfloat"><a href="#mydiv" rel="facebox"><img src="<?php echo $site_url . '/wp-content/plugins/' . $folder_name . '/image/licence.png' ?>" class="bann_margin_right"></a></div>
        <div class="lfloat"><a href="http://www.apptha.com/shop/checkout/cart/add?product=31" target="_blank"><img src="<?php echo $site_url . '/wp-content/plugins/' . $folder_name . '/image/buynow.png' ?>"  class="bann_margin_right"></a>
        </div>
<?php } ?>
    </div>
    <div id="mydiv" style="display:none;" >
        <form method="POST" action=""onSubmit="return validateKey();">
            <h4 align="center"><a href="http://www.apptha.com/shop/checkout/cart/add?product=31" target="_blank"> Get Licence</a></h4>
            <h2 align="center" class="bann_apply_lice"> Apply Your License Key Here</h2>
            <div align="right"><input type="text" name="get_license" id="get_license" size="58" />
                <input type="submit" name="submit_license" id="submit_license" value="Save"/></div>
        </form>
    </div>
</h2>
<script type="text/javascript">

     function validateKey()
           {
        	   var Licencevalue = document.getElementById("get_license").value;
        	   if(Licencevalue == ""||Licencevalue !="<?php echo $get_option_title ?>"){
            	   alert('please enter valid licence key');
            	   return false;
        	   }
                   else
                       {
                            alert('Valid Licence key applied Successfully');
                            return true;
                       }

           }
 </script>
  <?php     $mes = filter_input(INPUT_GET, 'msg' );
                 if(isset($mes)){ ?>
				 <div  id="showupdatemes" class="updated below-h2">
			        <p>
        			<?php echo 'Style Settings updated.'; ?>
        		   </p>
         		</div>
         <?php  }  ?>		

<div class="bann_note"><h3><strong>Banner code</strong></h3><div class="inside lfloat"> <p> <strong>Method 1 :</strong> After Publishing your own style of template:<br />
            Step 1 :  Please Go To Admin Menu->Appearance-><a href="<?php echo $site_url; ?>/wp-admin/theme-editor.php">Editor</a> <br />
            Step 2 :  Select your theme in top select box and go to file header.php <br />
            Step 3 :  Add the following code above/below <strong>"&lt;/div&gt &lt;!-- #header --&gt;"</strong> depends on your theme.<br /><textarea rows="2" cols="60"> &lt;?php  if (function_exists('apptha_banner')) { apptha_banner(); } ?&gt; </textarea>
        </p></div>
        
        <div class="inside lfloat"> <p> <strong>Method 2: </strong>After Publishing your own style of template:<br />
            When you don't like to have a banner on the header part of your blog,<br/> you can use the following plugin code to display banner on particular post/page. <br />
            Step 1:[appthabanner style=id] <br />
			Step 2:In the above plugin code you have to provide banner style number as a value to 'id'.<br/> 
            <textarea> [appthabanner style=1] </textarea><br />
                   </p></div>
        </div>
              <div class="clear"></div>
               <div><strong> Note:</strong>Please use only one method to display on your blog/website to avoid conflict.</div>
<!--                   The left side Jquery UI designing                       -->

<div id="error_msg"></div>
<form method="post"  name="themeConfig" action=" <?php $_SERVER['PHP_SELF'] ?>" id="themeConfig">
    <div class="banner_border">
        <table cellpadding="0" cellspacing="0"><tr><td class="head"><h3>Font Settings</h3>(in pixels)<!-- /theme group header --></td><td>
                        <div for="fon_family" class="banner_set_head"><span  class="lfloat bann_padding_right">Family</span>
                        <input type="text" name="fon_family" id="fon_family" class="fon_family" value="<?php echo $edit_fntfamily; ?>" size="8" onblur="bann_family();"></div>
                    <div for="fon_family" class="banner_set_head"><span  class="lfloat bann_padding_right">Font-Size</span>
                        <input type="text" name="fon_size" id="fon_size" class="fon_size" value="<?php echo $edit_fntsize; ?>" size="8" onblur="bann_fntsize();"></div>
                    <div for="fsDefault" class="banner_set_head"><span  class="lfloat bann_padding_right">Border Size</span>
                        <input type="text" name="bannerborder" id="bannerborder" value="<?php echo $edit_brdsize; ?>" size="3" onblur="bann_borsize();">(* Max 10)</div>
                    <!-- Setbox closed --></td></tr></table>
    </div>
    <!-- End -->
       <div class="banner_border"><table cellpadding="0" cellspacing="0"><tr><td class="head"><h3>Color Settings</h3></td><td><!-- /theme group header -->
                    <div class="banner_setbox">
                        <div class="bann_margin_bottom"><span class="lfloat bann_padding_right">Background color</span>
                             <input id="bgColorHeader" type="color" name="bgColorHeader" value="<?php echo $edit_bgcolor; ?>" size="6" onblur="bann_bg();" data-hex="true" class="color"><div class="clear"></div></div>


                        <div class="bann_margin_bottom"><span  class="lfloat bann_padding_right">Border</span>
<!--                            <input type="text" name="borderColorHeader" id="borderColorHeader" class="hex" onblur="bann_brd()" value="<?php //echo $edit_brdcolor; ?>" size="6" style="background-color: rgb(170, 170, 170); color: rgb(0, 0, 0); ">-->
                             <input id="borderColorHeader" type="color" name="borderColorHeader" onblur="bann_brd()" value="<?php echo $edit_brdcolor; ?>" size="6"value="<?php echo $edit_bgcolor; ?>" onblur="bann_bg();" data-hex="true" class="color"><div class="clear"></div></div>

                            <div class="clear"></div></div>

                        <div class="bann_margin_bottom"><span  class="lfloat bann_padding_right">Text</span>
                        <input id="fcHeader" type="color" name="fcHeader" onblur="bann_brd()"  value="<?php echo $edit_banncolor; ?>" size="6" onblur="bann_bg();" data-hex="true" class="color"><div class="clear"></div></div>
<!--                     <input type="text" name="fcHeader" id="fcHeader" onblur="bann_color()" class="hex" value="<?php //echo $edit_banncolor; ?>" size="6" style="background-color: rgb(34, 34, 34); color: rgb(255, 255, 255); "><div class="clear"></div></div>-->
                    </div> <!-- Setbox closed --></td></tr></table>
    </div> <div class="clear"></div>
    <!-- End -->
    <div class="banner_border"><table cellpadding="0" cellspacing="0"><tr><td class="head"><h3>Dimensions</h3>(in pixels)</td><td><!-- /theme group Hover -->
                    <div class="banner_setbox">
                        <div class="bann_margin_bottom"><span  class="lfloat bann_padding_right">Width</span><input type="text" name="banner_width" id="banner_width"  value="<?php echo $edit_width; ?>" size="6" onblur="bann_wid();"> <div class="clear"></div></div>
                        <div class="bann_margin_bottom"><span  class="lfloat bann_padding_right" >Height</span><input type="text" name="banner_height" id="banner_height" value="<?php echo $edit_height; ?>" size="6" onblur="bann_hei();"> <div class="clear"></div></div>
                        <div class="bann_margin_bottom"><span  class="lfloat bann_padding_right" >Seconds</span><input type="text" name="banner_timing" id="banner_timing" value="<?php echo $edit_timing; ?>" size="6"> <div class="clear"></div></div>
                        <div class="bann_margin_bottom"><span  class="lfloat bann_padding_right" >Space:Below & Top</span><input type="text" name="banner_spacing" id="banner_spacing" value="<?php echo $edit_spacing; ?>" size="6"> <div class="clear"></div></div>
                        <div for="cornerRadius" class="banner_set_head bann_margin_bottom"><span  class="lfloat bann_padding_right">Corners:</span>
                            <input type="text" value="<?php echo $edit_corner; ?>" name="cornerRadius" id="cornerRadius" size="5"> <div class="clear"></div></div>
                    </div> <!-- Setbox closed --></td></tr></table>
    </div>

    <div class="banner_border"><table cellpadding="0" cellspacing="0"><tr><td class="head"><h3>Thumb/Hover settings</h3> [Only for Styles having side thumb images]</td><td><!-- /theme group Default -->
                    <div class="banner_setbox">
                        <div class="bann_margin_bottom"><span  class="lfloat bann_padding_right">Background color</span>
 <input id="bgColorhover" type="color" name="bgColorhover" onblur="bann_brd()" onblur="bann_hover();" value="<?php echo $edit_hover; ?>" size="6" value="<?php echo $edit_bgcolor; ?>" onblur="bann_bg();" data-hex="true" class="color">
<!--                       <input type="text" name="bgColorhover" id="bgColorhover" class="hex" value="e6e6e6" style="background-color: rgb(230, 230, 230); color: rgb(0, 0, 0); " onblur="bann_hover();" value="<?php //echo $edit_hover; ?>"><div class="clear"></div></div>-->
                        <div class="bann_margin_bottom"><span class="lfloat bann_padding_right">Thumb Text</span>
<input id="thumb_text" type="color" name="thumb_text" onblur="bann_brd()" onblur="bann_hover();" value="<?php echo $edit_thumbcolor; ?>" size="6" onblur="bann_bg();" data-hex="true" class="color">
<!--                         <input type="text" name="thumb_text" id="thumb_text" class="hex"  style="background-color: rgb(230, 230, 230); color: rgb(0, 0, 0); "  value="<?php //echo $edit_thumbcolor; ?>"><div class="clear"></div></div>-->
                     
                    </div> <!-- Setbox closed --></td></tr></table>
    </div>

    <div class="clear"></div>
    <!-- End -->
   
    <div class="margin_topbottom">
        <input type="hidden"  name="XXX" value="123"/> 
        <input type="button" value="Apply"  name="Apply_submit" class="button"  align="right" onclick="updateDesign();"/>
        <input type="button" value="Reset"  name="Reset_submit"  class="button" align="right" onclick="resetForm();"/></div>
     
</form>
</div>