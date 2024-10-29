<?php 
/*
Plugin Name: Apptha WP Banner Image Slider
Plugin URI: http://www.apptha.com/category/extension/Wordpress/Apptha-Banner
Description: Apptha Banner styles for the worpress.Enable classy effects for the banner styles in one plugin. Provides three default attractive and different stylish smooth animated banners.Activate the desired banner style with a single click.
Version:1.5
Author: Apptha
Author URI: http://www.apptha.com
License: GNU General Public License version 2 or later; see LICENSE.txt
*/

/** This is used for setting the Apptha banner link in the admin dashboard settings */

function banner_page()
{
add_menu_page('Apptha Banner', 'Apptha Banner', 'manage_options', 'banner_show', 'showbanner_admin',get_bloginfo('url').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/image/icon.png');
add_submenu_page( 'banner_show', 'Page title', 'Image Upload', 'manage_options', 'banner_img', 'showbanner_admin');
add_submenu_page( 'banner_show', 'Page title', 'Settings', 'manage_options', 'banner_temp', 'showbanner_admin');
}
function apptha_wpbanner($content)
 {
    $content = preg_replace_callback('/\[appthabanner ([^]]*)\y]/i', 'apptha_bannerpage', $content); //Mac Photo Gallery Page
    return $content;
 }

 function apiKey() {
$const = "uBQxhyPH8Ynxll+3UUiPpeHc4p0NznSnw1bcmjtQMr///DfK+aJuy+UwXB6Q+1rM2mivNxbuQBvJPNUfTAXkW4z5rYkJ6s4LAHqkv2EVwaF2wRGDXRqKvbvT6mm2DaTdUH9KVFduDuMrOkaoGe3ERgZc08Gjspm4BiwdPmF/byi2iHTvCpcjhkAgrAUzQQkoYXFxllj0W5wEB2nx0w53JYUyDyMcIj+bbAgv+TR1KFVKWAukbKyWPo2BV8lLsnZgBz5oiPj/TylJuKbTxq0lAhnkQOWNYxy16+AT+wHo7Tg=";
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
  $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $const = base64_decode($const);
       if (conf__PHSHOP_MACDOC_EXTENSION != 1)
         $val =  mcrypt_decrypt(MCRYPT_RIJNDAEL_128, "appthabanner", $const, MCRYPT_MODE_ECB, $iv);
       return $val;
      
   }
	
function showbanner_admin()
{
    switch ($_GET['page'])
    {
        case 'banner_show' :
            include_once (dirname(__FILE__) . '/admin/banner_show.php'); // admin functions
            break;
       case 'banner_temp' :
           include_once (dirname(__FILE__) .'/banner_temp.php'); // admin functions
           break;
        case 'banner_img' :
            include_once (dirname(__FILE__) . '/admin/banner_img.php'); // admin functions
            break;
    }
    require_once(dirname(__FILE__) . '/apptha_wpinstall.php');
    
}
// The user will call this function to display the banner
function apptha_banner()
{
  global $wpdb;
  $site_url      = get_bloginfo('url');
  $temp_name = $wpdb->get_var("SELECT bann_tempname  FROM " . $wpdb->prefix . "bannerstyles WHERE bann_status='ON'");
  if($temp_name == '')
  {
       echo '<script> alert("Please Go and Select the Banner Style correctly"); location.href = "'.$site_url.'/wp-admin/admin.php?page=banner_show";</script>';
  }
   else
  {
  include_once (dirname(__FILE__).DIRECTORY_SEPARATOR.$temp_name.DIRECTORY_SEPARATOR.$temp_name.'.php'); // admin functions
  }
}

function apptha_bannerpage($content)
{
	global $wpdb;
	
	  $banner_styleid = $content['style'];
	
	  $site_url      = get_bloginfo('url');
	  $temp_name = $wpdb->get_var("SELECT bann_tempname  FROM " . $wpdb->prefix . "bannerstyles WHERE bann_tempid='$banner_styleid'");
	 
	 include_once (dirname(__FILE__).DIRECTORY_SEPARATOR.$temp_name.DIRECTORY_SEPARATOR.$temp_name.'.php'); // admin functions
}

 $lookupObj = array();
 $chars_str;
 $chars_array = array();

function appbanner_generate($domain)
{
$code=appbanner_encrypt($domain);
$code = substr($code,0,25)."CONTUS";
return $code;
}

function appbanner_encrypt($tkey) {

$message =  "EW-ABMP0EFIL9XEV8YZAL7KCIUQ6NI5OREH4TSEB3TSRIF2SI1ROTAIDALG-JW";

	for($i=0;$i<strlen($tkey);$i++){
$key_array[]=$tkey[$i];
}
	$enc_message = "";
	$kPos = 0;
        $chars_str =  "WJ-GLADIATOR1IS2FIRST3BEST4HERO5IN6QUICK7LAZY8VEX9LIFEMP0";
	for($i=0;$i<strlen($chars_str);$i++){
$chars_array[]=$chars_str[$i];
}
	for ($i = 0; $i<strlen($message); $i++) {
		$char=substr($message, $i, 1);

		$offset = appbanner_getOffset($key_array[$kPos], $char);
		$enc_message .= $chars_array[$offset];
		$kPos++;
		if ($kPos>=count($key_array)) {
			$kPos = 0;
		}
	}

	return $enc_message;
}
function appbanner_getOffset($start, $end) {

    $chars_str =  "WJ-GLADIATOR1IS2FIRST3BEST4HERO5IN6QUICK7LAZY8VEX9LIFEMP0";
	for($i=0;$i<strlen($chars_str);$i++){
$chars_array[]=$chars_str[$i];
}

	for ($i=count($chars_array)-1;$i>=0;$i--) {
		$lookupObj[ord($chars_array[$i])] = $i;

	}

	$sNum = $lookupObj[ord($start)];
	$eNum = $lookupObj[ord($end)];

	$offset = $eNum-$sNum;

	if ($offset<0) {
		$offset = count($chars_array)+($offset);
	}

	return $offset;
}
// The common admin CSS and JS will included by checking the admin setted
if (is_admin()) {
 function banner_common_js_css()
    {
        $site_url    = get_bloginfo('url');
        $plugin_name = dirname(plugin_basename(__FILE__));
        wp_enqueue_style('banner_style', $site_url . '/wp-content/plugins/'.$plugin_name.'/css/banner_style.css');
        
    }
add_action('init', 'banner_common_js_css'); // hook init to call the JS and CSS
}
// Loading the five default settings in bannerstyles table
function  banner_activate_loads()
{
global $wpdb;
$execute_query = $wpdb->query("INSERT INTO " . $wpdb->prefix . "bannerstyles (`bann_tempid`, `bann_tempname`, `bann_tempimg`, `bann_bgcolor`, `bann_border`, `bann_borsize`, `bann_fontcolor`, `bann_hover`, `bann_corner`, `bann_fontfamily`, `bann_fontsize`, `bann_width`, `bann_height`, `bann_status`, `bann_spacing`, `bann_timing`) VALUES
(1, 'smooth_slider', 'smooth_slider.jpg', '#ccc', '#ccc', 5, '#fff,#ae1e1e', '#e6e6e6', 0, 'arial', 25, 'auto', 300, 'ON', 0, 3),
(2, 'lof_slider', 'lof_slider.jpg', '#000000', '#fff', 5, '#ccc,#ae1e1e', '#ffffff', 0, 'arial', 12, 'auto', 300, 'OFF', 0, 3),
(3, 'navo_slider', 'navo_slider.jpg', '#ccc', '#ccc', 5, '#fff,#ae1e1e', '#e6e6e6', 0, 'arial', 12, 'auto', 300, 'OFF', 0, 3),
(4, 'blinking_navo', 'blinking_navo.jpg', '#ccc', '#ccc', 5, '#fff,#ae1e1e', '#e6e6e6', 0, 'arial', 12, 'auto', 300, 'OFF', 0, 3),
(5, 'plain_image', 'plain_image.jpg', '#ccc', '#ccc', 5, '#fff,#ae1e1e', '#e6e6e6', 0, 'arial', 12, 'auto', 300, 'OFF', 0, 3);
");
}
/*Function to invoke install player plugin*/
function banners_install()
{
    require_once(dirname(__FILE__) . '/apptha_wpinstall.php');
    banner_install();
    create_imageupload_foulder(); // for copy images and thumbniles
}
// Install Actions
 function banner_sharactivate()
 {
  banner_activate_loads();
 }
// Uninstall Actions
 function banner_sharedeinstall()
 {
   global $wpdb;
   $images_drop = $wpdb->query("DROP TABLE " . $wpdb->prefix . "bannerimages");
   $styles_drop = $wpdb->query("DROP TABLE " . $wpdb->prefix . "bannerstyles");
   $options_drop = $wpdb->query("DELETE FROM " . $wpdb->prefix . "options WHERE option_name='get_api_key'");
 }
// Activation and install hooks
register_activation_hook(plugin_basename(dirname(__FILE__)) . '/apptha_wpbanner.php', 'banners_install');
register_activation_hook(__FILE__, 'banner_sharactivate');
register_uninstall_hook(__FILE__, 'banner_sharedeinstall');

function appthabanner_script() {
  $site_url = get_bloginfo('url');
?>
<script type="text/javascript" src="<?php echo $site_url . '/wp-content/plugins/' . dirname(plugin_basename(__FILE__)) . '/js/jquery-1.6.min.js'; ?>"></script>
<?php }

add_action('wp_head', 'appthabanner_script');
add_shortcode('appthabanner', 'apptha_bannerpage');
// CONTENT FILTER
add_filter('the_content', 'apptha_wpbanner');
// OPTIONS MENU
add_action('admin_menu', 'banner_page'); 
?>
