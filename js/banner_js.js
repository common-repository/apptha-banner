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
 var banner = jQuery.noConflict(); 

//Give alert for the banner styles
function give_alert()
{
    alert('Please Enable and click for edit');
    
}
// For Deleting the Banner

function banner_delete(temp_id,banner_url)
{
   var r=confirm("Are you sure you wish to delete this banner style?");
if (r==true)
  {

  banner.ajax({
    method:"GET",
      url: banner_url+'/wp-content/plugins/'+folder_name+'/admin/banner_ajax.php',
       data : "temp_id="+temp_id,
       asynchronous:false,
        error: function(html){
            },
      success: function(html){
         window.location = self.location;
           }
       });
  }
else
  {
  alert("Process Cancel!");
  }
   
}

    //After show updating the name,desc and url for update
function upd_bannerpht(queue)
    {
    for(i=1;i<=queue;i++)
    {
     var bannedit_phtid = document.getElementById("bannedit_id_"+i).value;
     var bannedit_name  = document.getElementById("bannedit_name_"+i).value;
     var bannedit_desc  = document.getElementById("bannedit_desc_"+i).value;
     var bannedit_url  = document.getElementById("bannedit_url_"+i).value;

banner.ajax({
    method:"GET",
      url: banner_url+'/wp-content/plugins/'+folder_name+'/admin/banner_ajax.php',
       data : "bannedit_phtid="+bannedit_phtid+"&bannedit_name="+bannedit_name+"&bannedit_desc="+bannedit_desc+"&bannedit_url="+bannedit_url,
       asynchronous:false
       });
    }
 alert('Your Datas are Updated.');
 window.location = self.location;
}

// Changing the status of the images in the admin
function banner_status(status,bannpht_id)
{

   banner.ajax({
      method:"GET",
      url: banner_url+'/wp-content/plugins/'+folder_name+'/admin/banner_ajax.php',
      data : 'status='+status+'&bannpht_id='+bannpht_id,
      asynchronous:false,
      error: function(html){
            },
      success: function(html){
           banner('#bannstatus_bind_'+bannpht_id).html(html);
            
           }
      });

}
// Quick Edit Form for updating 
function banner_quickedit(bann_editid)
{
	var token = document.getElementById('token').value;
    if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4)
    {
        document.getElementById('showfield_'+bann_editid).style.display="block";
        document.getElementById('showfield_'+bann_editid).innerHTML = xmlhttp.responseText
    }
  }
xmlhttp.open("GET",banner_url+'/wp-content/plugins/'+folder_name+'/admin/banner_ajax.php?bann_editid='+bann_editid+'&token='+token,true);
xmlhttp.send();
}
// Updating the quick edit form fields

function isURL(s) {
 	var regexp = /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/;
 	return  regexp.test(s);
}
function updimgfield(bann_editid)
{ 
var token = document.getElementById('token').value;
var bannImg_name   = document.getElementById('bannimg_name_'+bann_editid).value;
var bannImg_desc   = document.getElementById('bannimg_desc_'+bann_editid).value;
var regex = /(<([^>]+)>)/ig;
bannImg_name = bannImg_name.replace(regex, '');
bannImg_desc = bannImg_desc.replace(regex, '');
var bannImg_url   = document.getElementById('bannimg_url_'+bann_editid).value;
if(bannImg_url != '')
	{
  var responce = isURL(bannImg_url);
  if(!responce){ alert('Please enter valid url.'); document.getElementById('bannimg_url_'+bann_editid).value = '';
  document.getElementById('bannimg_url_'+bann_editid).focus();
  return false;
  }
	}
 
  if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4)
    {
      document.getElementById('bannName_'+bann_editid).innerHTML = bannImg_name;
      document.getElementById('bannDesc_'+bann_editid).innerHTML = bannImg_desc;
      document.getElementById('bannUrl_'+bann_editid).innerHTML = bannImg_url;
      document.getElementById('showfield_'+bann_editid).style.display="none";
    }
  }

xmlhttp.open("GET",banner_url+'/wp-content/plugins/'+folder_name+'/admin/banner_ajax.php?bann_fieldid='+bann_editid+'&bannImg_name='+bannImg_name+'&bannImg_desc='+bannImg_desc+'&bannImg_url='+bannImg_url+'&token='+token,true);
xmlhttp.send();
}
function cancelimgfield(bann_editid)
{
    document.getElementById('showfield_'+bann_editid).style.display="none";
}
// Changing the status for the published page

function banner_publish(publish,tmp_id,banner_url)
{ 
      banner.ajax({
      method:"GET",
      url: banner_url+'/wp-content/plugins/'+folder_name+'/admin/banner_ajax.php',
      data : "publish="+publish+"&tmp_id="+tmp_id+"&banner_url="+banner_url,
      asynchronous:false,
      error: function(html){
            },
      success: function(html){
         var full_resp = html.split("++");
      
                banner('#banner_show').html(full_resp[0]);
                banner('#banner_id').html(full_resp[1]);
               window.location = self.location;
            }
      });
 }
