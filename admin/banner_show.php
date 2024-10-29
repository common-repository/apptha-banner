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
$banner_url = get_bloginfo('url');
$plugin_name = explode('/', dirname(plugin_basename(__FILE__)));
$folder_name = $plugin_name[0];
?>
<div class="wrap">
    <?php
    
    $strDomainName = $banner_url;
    preg_match("/^(http:\/\/)?([^\/]+)/i", $strDomainName, $subfolder);
	preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $subfolder[2], $matches);
	$customerurl = $matches['domain'];
	$customerurl = str_replace("www.", "", $customerurl);
	$customerurl = str_replace(".", "D", $customerurl);
	$customerurl = strtoupper($customerurl);
	
    $publish_show = $wpdb->get_row("SELECT bann_tempid,bann_tempname,bann_tempimg,bann_status
                                   FROM " . $wpdb->prefix . "bannerstyles WHERE bann_status='ON'");
   ?>
     
       <div class="clear"></div><div id="icon-themes" class="icon32"><br /></div>
        <h2 class="nav-tab-wrapper">
        <a href="?page=banner_show" class="nav-tab  nav-tab-active">Banner Styles</a>
        <a href="?page=banner_img" class="nav-tab">Upload/Edit</a>
        <span id="banner_id"><a href="?page=banner_temp&style=<?php echo $publish_show->bann_tempid; ?>" class="nav-tab">Style Settings</a></span>
        
         <?php
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
                    $get_option_title = appbanner_generate($customerurl);
           ?>
                  
        <script type='text/javascript'>
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
             <div class="buy">
        <?php
        if ($get_title['title'] != $get_option_title) {  ?>
                    <div class="lfloat"><a href="#mydiv" rel="facebox"><img src="<?php echo $banner_url . '/wp-content/plugins/' . $folder_name . '/image/licence.png' ?>" class="bann_margin_right"></a></div>
                    <div class="lfloat"><a href="http://www.apptha.com/shop/checkout/cart/add?product=31" target="_blank"><img src="<?php echo $banner_url . '/wp-content/plugins/' . $folder_name . '/image/buynow.png' ?>"  class="bann_margin_right"></a>
                    </div>
        <?php } else { ?>

        <div id="banner_new" align="right"><a onclick="uploadForm();">
                <img src="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/image/addnewstyle.png"></a>
        </div>
         <?php } ?>
    </div>
    <div id="mydiv" style="display:none">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?page=banner_show'?>" name="license_form" onsubmit="return validateKey();">
            <h4 align="center"><a href="http://www.apptha.com/shop/checkout/cart/add?product=31" target="_blank"> Get Licence</a></h4>
        <h2 align="center" class="bann_apply_lice"> Apply Your License Key Here</h2>
    <div align="right"><input type="text" name="get_license" id="get_license" size="58" />
    <input type="submit" name="submit_license" id="submit_license" value="OK"/></div>
        </form>
    </div>
       	</h2>
      <!-- LOADING THE SCRIPT FOR THE POPUP BOX-->
    <script type='text/javascript'>
        var url = '<?php echo $banner_url; ?>';
        var folder_name = '<?php echo $folder_name; ?>';
        function uploadForm()
        {
            var output= "";
            output += '<div id="content">';
            output += '<form action="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/admin/upload_newstyle.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >';
            output += '<p id="f1_upload_process" style="display:none">Loading...<br/></p>';
            output += '<p id="f1_upload_form" align="center"><br/>';
            output += '<label>Add Style: ';
            output += '<input name="new_banner" type="file" size="30" />';
            output += '</label>';
            output += '<label>';
            output += '<input type="submit" name="submitBtn" class="sbtn" value="Upload" />';
            output += '</label></p>';
            output += '<iframe id="upload_target" name="upload_target" src="#" style="position:absolute;top:20px;width:0;height:0;border:0px solid #fff;"></iframe> </form> </div>';
            jQuery.facebox(output);
        }
        function startUpload(){
            document.getElementById('f1_upload_process').style.display = 'block';
            document.getElementById('f1_upload_form').style.display = 'none';
            return true;
        }
        function stopUpload(success){
            var result = '';
            if (success == 1){
                result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
                window.location = self.location;
            }
            else {
                result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
            }
            document.getElementById('f1_upload_process').style.display = 'none';
            document.getElementById('f1_upload_form').innerHTML = result + '<label>File: <input name="myfile" type="file" size="30" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
            document.getElementById('f1_upload_form').style.display = 'block';

            return true;
        }
        
    </script>
             <!-- LOADING THE SCRIPT AND CSS FOR THE POPUP BOX-->
    <script type="text/javascript" src="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/js/banner_js.js"></script>
    <script type="text/javascript" src="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/js/jquery.form.js"></script>
    <link href="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/css/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name; ?>/js/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox()
    })
</script>
    <div class="clear"></div>
       <table class="tab_pad" cellspacing="10" cellpadding="0" width="100%" >
        <tbody>
            <!-- CURRENTLY ACTIVATED BANNER STYLE-->
        <tr><td class="heading"><h3>Current Banner Style</h3></td></tr>
        <tr>
              <td class="border_show">
                  <div class="thumb lfloat" id="banner_show">
                       <h3><?php echo str_replace('_',' ',$publish_show->bann_tempname); ?></h3>
                    <img src="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name . '/'
                   . $publish_show->bann_tempname . '/' . $publish_show->bann_tempimg; ?>" alt="" />
                   <a class="button banner_pointer lfloat" href="?page=banner_temp&style=<?php echo $publish_show->bann_tempid; ?>" >
                   Edit Settings
                   </a><div class="lfloat" style="padding-top:10px">Style id=<?php echo $publish_show->bann_tempid;?></div>
                  </div>
                 <?php if($publish_show->bann_tempname == 'plain_image') {?>
                 <div style="color: #21759B;">[For this style name,description,url is not supported]</div>
                 <?php }?>
                
              </td>
              <td>
              <div class="bann_note" style="width:400px"><h3><strong>To insert Banner in header - Method 1</strong></h3><div class="inside"> <p>After Publishing your own style of template:<br />
                    <strong>Step 1 :</strong>  Please Go To Admin Menu->Appearance-><a href="<?php echo $banner_url; ?>/wp-admin/theme-editor.php">Editor</a> <br />
                    <strong>Step 2 : </strong> Select your theme in top select box and go to file header.php <br />
                    <strong>Step 3 : </strong> Add the following code above/below <br /><strong>"&lt;/div&gt &lt;!-- #header --&gt;"</strong> depends on your theme.<br /><textarea rows="2" cols="60"> &lt;?php  if (function_exists('apptha_banner')) { apptha_banner(); } ?&gt; </textarea>
                      </p></div></div>
              </td>
              <td> <div class="bann_note" style="width:300px"><h3><strong>To insert Banner in Page/Post - Method 2</strong></h3><div class="inside"> <p>
               When you don't like to have a banner on the header part of your blog, you can use the following plugin code to display banner on particular post/page. <br />
                    <strong> Step 1:</strong> [appthabanner style=id] <br />
					<strong> Step 2:</strong> In the above plugin code you have to provide banner style number as a value to 'id'. 
                             Example: [appthabanner style=1] <br />
                    <strong> Note:</strong> The style id is available under each banner style preview/thumb image on this page. (Next to Delete button) 
                   </p></div></div></td>
                   
           </tr>
           <tr><td colspan="3"><table cellpadding="0" cellspacing="0"><tr><td><strong>Note:</strong>Please use only one method to display on your blog/website to avoid conflict.</td></tr></table></td></tr>
            
           
            <!-- REMAINING DEFAULT BANNER STYLES -->
            <tr><td class="heading"><h3>Available Banner Styles</h3></td></tr>
            <tr class="border_show">
<td colspan="3"><table cellpadding="0" cellspacing="0" width="100%"><tr>
                <?php

//Pagination
    function listPagesNoTitle($args) { //Pagination
        if ($args) {
            $args .= '&echo=0';
        } else {
            $args = 'echo=0';
        }
        $pages = wp_list_pages($args);
        echo $pages;
    }

    function findStart($limit) { //Pagination
        if (!(isset($_REQUEST['pages'])) || ($_REQUEST['pages'] == "1")) {
            $start = 0;
            $_GET['pages'] = 1;
        } else {
            $start = ($_GET['pages'] - 1) * $limit;
        }
        return $start;
    }

    /*
     * int findPages (int count, int limit)
     * Returns the number of pages needed based on a count and a limit
     */

    function findPages($count, $limit) { //Pagination
        $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
        if ($pages == 1) {
            $pages = '';
        }
        return $pages;
    }

    /*
     * string pageList (int curpage, int pages)
     * Returns a list of pages in the format of "ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â« < [pages] > ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â»"
     * */

    function pageList($curpage, $pages) {
        //Pagination
        $page_list = "";
        if ($search != '') {

            $self = '?page=' . banner_show;
        } else {
            $self = '?page=' . banner_show;
        }

        /* Print the first and previous page links if necessary */
        if (($curpage != 1) && ($curpage)) {
            $page_list .= "  <a href=\"" . $self . "&pages=1\" title=\"First Page\">First</a> ";
        }

        if (($curpage - 1) > 0) {
            $page_list .= "<a href=\"" . $self . "&pages=" . ($curpage - 1) . "\" title=\"Previous Page\"><</a> ";
        }

        /* Print the numeric page list; make the current page unlinked and bold */
        for ($i = 1; $i <= $pages; $i++) {
            if ($i == $curpage) {
                $page_list .= "<b>" . $i . "</b>";
            } else {
                $page_list .= "<a href=\"" . $self . "&pages=" . $i . "\" title=\"Page " . $i . "\">" . $i . "</a>";
            }
            $page_list .= " ";
        }

        /* Print the Next and Last page links if necessary */
        if (($curpage + 1) <= $pages) {
            $page_list .= "<a href=\"" . $self . "&pages=" . ($curpage + 1) . "\" title=\"Next Page\">></a> ";
        }

        if (($curpage != $pages) && ($pages != 0)) {
            $page_list .= "<a href=\"" . $self . "&pages=" . $pages . "\" title=\"Last Page\">Last</a> ";
        }
        $page_list .= "</td>\n";

        return $page_list;
    }

    /*
     * string nextPrev (int curpage, int pages)
     * Returns "Previous | Next" string for individual pagination (it's a word!)
     */

    function nextPrev($curpage, $pages) { //Pagination
        $next_prev = "";

        if (($curpage - 1) <= 0) {
            $next_prev .= "Previous";
        } else {
            $next_prev .= "<a href=\"" . $_SERVER['PHP_SELF'] . "&pages=" . ($curpage - 1) . "\">Previous</a>";
        }

        $next_prev .= " | ";

        if (($curpage + 1) > $pages) {
            $next_prev .= "Next";
        } else {
            $next_prev .= "<a href=\"" . $_SERVER['PHP_SELF'] . "&pages=" . ($curpage + 1) . "\">Next</a>";
        }
        return $next_prev;
    }

    //End of Pagination

    $count = $wpdb->get_var("SELECT count(*) FROM " . $wpdb->prefix . "bannertemp");
    $limit = 20;
    $start = findStart($limit);
    /* Find the number of pages based on $count and $limit */
    $pages = findPages($count, $limit);
    /* Now we use the LIMIT clause to grab a range of rows */

    $rst_show = $wpdb->get_results("SELECT bann_tempid,bann_tempname,bann_tempimg,bann_status FROM " . $wpdb->prefix . "bannerstyles WHERE bann_status='OFF' ORDER BY bann_tempid ASC LIMIT $start,$limit");
                foreach ($rst_show as $show) {
                ?>
                <td width="15%">
                   <div class="thumb">
                       <h3 class="banner_name"><?php echo str_replace('_',' ',$show->bann_tempname); ?></h3>
                    <img src="<?php echo $banner_url; ?>/wp-content/plugins/<?php echo $folder_name . '/'
                    . $show->bann_tempname . '/' . $show->bann_tempimg; ?>" alt="" />
                   </div>
                   <div class="clear"></div>
                   <a class="button banner_pointer lfloat" onclick=banner_publish('ON',<?php echo $show->bann_tempid; ?>,'<?php echo $banner_url; ?>')>
                   Activate
                   </a>
                   <div class="lfloat"><a class="button banner_pointer" onclick="banner_delete('<?php echo $show->bann_tempid; ?>','<?php echo $banner_url; ?>')">Delete</a></div>
                   <div class="lfloat" style="padding-top:10px">Style id=<?php echo $show->bann_tempid;?></div>
                  
               </td>
                <?php
                    $i++;
                    if ($i % 3 == 0) {
                        echo '</tr> <tr class="border_show">';
                    }
                }
                ?>
               <?php
               $pagelist = pageList($_REQUEST['pages'], $pages);
              ?>
              </tr>
              </table>
              </td>
              </tr>
      </tbody>
    </table>
          
                <div class="pages"><?php echo $pagelist; ?></div> <!-- Pagination -->
 </div>