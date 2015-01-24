jQuery(document).ready(function() {

var thisid;

jQuery('#upload_logo_image_button').click(function() {
 formfield = jQuery('#upload_logo_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 thisid='#upload_logo_image';
 return false;
});

jQuery('#upload_image_button').click(function() {
 formfield = jQuery('#upload_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 thisid='#upload_image';
 return false;
});

jQuery('#upbtn_load_image_button').click(function() {
 formfield = jQuery('#upbtn_load_image').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 thisid='#upbtn_load_image';
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery(thisid).val(imgurl);
 tb_remove();
}

});