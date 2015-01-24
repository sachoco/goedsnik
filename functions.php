<?php
load_theme_textdomain( 'goedsnik', get_template_directory() . '/languages' );

register_nav_menu('main_menu', 'Main Menu');
register_nav_menu('mobile_menu', 'Mobile Menu');
add_post_type_support( 'post', 'page-attributes' );
add_theme_support( 'post-thumbnails' ); 
add_image_size( 'homepage-thumb', 180);
add_image_size( 'homepage-15thumb', 153);
update_option('image_default_link_type','none');

add_image_size('blahblah', 560);
add_image_size('portrait', 483);

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '... <div style="margin:0px 0px 10px 0px;"><a href="'.get_permalink().'" target="_self" class="lees_meer">(lees meer)</a></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');

 if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                'label' => 'Category Image',
                'id' => 'category-image',
                'post_type' => 'post'
            )
        );
    }

add_image_size( 'category-image-thumb', 180);

add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
	$custom_sizes = array(
		'blahblah' => 'Landscape',
		'portrait' => 'Portrait'
	);
	return array_merge( $sizes, $custom_sizes );
}



/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );


/** Step 1. */
function my_plugin_menu() {
	add_options_page( 'Theme Options', 'Theme Options', 'edit_pages', 'theme_options', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'edit_pages' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class="wrap" style="width:900px;">
	<?php screen_icon(); ?><h2 style="margin-bottom:30px;">Theme Options</h2>
<form method="post" action="options.php" enctype="multipart/form-data">
<?php settings_fields( 'myoption_group' ); ?>
<?php do_settings_sections( 'theme_options' ); ?>
<?php submit_button(); ?>
</form></div>

<?php
}


function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_bloginfo('template_url').'/js/uploader.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}

function my_admin_styles() {
wp_enqueue_style('thickbox');
}

if (isset($_GET['page']) && $_GET['page'] == 'theme_options') {
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
}





// add the admin settings and such
add_action('admin_init', 'options_admin_init');

function options_admin_init(){
	register_setting( 'myoption_group', 'myoption_group' );
	
	add_settings_section('theme_main', '', 'theme_section_text', 'theme_options');
	
	add_settings_field('topbarimg', 'Top Bar:', 'topbar_img_wp', 'theme_options', 'theme_main');
	add_settings_field('logo', 'Logo:', 'logo_img_wp', 'theme_options', 'theme_main');
	add_settings_field('theme_text_string', 'Background Color:', 'bgcolor_string', 'theme_options', 'theme_main');
	add_settings_field('fontfamily', 'Font Family:', 'font_family_string', 'theme_options', 'theme_main');
	add_settings_field('fontsize', 'Font Size:', 'font_size_string', 'theme_options', 'theme_main');
	add_settings_field('lineheight', 'Line Height:', 'line_height_string', 'theme_options', 'theme_main');
	add_settings_field('navcolorfont', 'Navigation Text Color:', 'navcolor_string', 'theme_options', 'theme_main');
	add_settings_field('posttitlecolor', 'Thumbnail Title Text Color:', 'posttitlecolor_string', 'theme_options', 'theme_main');
	add_settings_field('postcontentcolor', 'Thumbnail Content Text Color:', 'postcontentcolor_string', 'theme_options', 'theme_main');
	add_settings_field('leesmeercolor', '"Lees Meer" Text Color:', 'leesmeercolor_string', 'theme_options', 'theme_main');
	add_settings_field('cattitlecolor', 'Category Title Text Color:', 'cattitlecolor_string', 'theme_options', 'theme_main');
	add_settings_field('upbtnimg', 'Up Button:', 'upbtn_img_wp', 'theme_options', 'theme_main');
	
	add_settings_field('space_under_cat_list', 'Space Under Category Listing:', 'space_under_cat_list_string', 'theme_options', 'theme_main');
	
	
	add_settings_field('post_title_text_color', 'Post Content Font Size:', 'post_title_text_string', 'theme_options', 'theme_main');
	add_settings_field('post_content_lineheight', 'Post Content Line Height:', 'post_content_lineheight_string', 'theme_options', 'theme_main');
	add_settings_field('post_content_text_color', 'Post Content Text Color:', 'post_content_text_color_string', 'theme_options', 'theme_main');
	
	
	
	add_settings_field('page_title_text_size', 'Page Content Font Size:', 'page_title_text_string', 'theme_options', 'theme_main');
	add_settings_field('page_content_lineheight', 'Page Content Line Height:', 'page_content_lineheight_string', 'theme_options', 'theme_main');
	
}
function theme_section_text() {
	//echo '<p>Main description of this section here.</p>';
} 


function topbar_img_wp() {  
	$options = get_option('myoption_group');
	echo '<input id="upload_image" type="text" size="36" name="myoption_group[topbarimg]" value="'.$options['topbarimg'].'" /><input id="upload_image_button" type="button" value="Upload Image" /><br />Enter an URL or upload an image for the banner.';
	echo '<br/><img src="'.$options['topbarimg'].'" />';
}


function logo_img_wp() {  
	$options = get_option('myoption_group');
	echo '<input id="upload_logo_image" type="text" size="36" name="myoption_group[logo]" value="'.$options['logo'].'" /><input id="upload_logo_image_button" type="button" value="Upload Image" /><br />Enter an URL or upload an image for the banner.';
	echo '<br/><img src="'.$options['logo'].'" />';
}


function bgcolor_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[theme_text_string]' size='40' type='text' value='".$options['theme_text_string']."' /><div style='background-color:".$options['theme_text_string'].";width:310px;height:20px;margin-top:10px;'></div>";
}


function font_family_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[fontfamily]' size='40' type='text' value='".$options['fontfamily']."' />";
}

function font_size_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[fontsize]' size='40' type='text' value='".$options['fontsize']."' /><div style='font-family:".$options['fontfamily'].";width:310px;height:20px;margin-top:10px;font-size:".$options['fontsize'].";'>the quick brown fox jumps over the lazy dog</div>";
}

function line_height_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[lineheight]' size='40' type='text' value='".$options['lineheight']."' />";
}

function navcolor_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[navcolorfont]' size='40' type='text' value='".$options['navcolorfont']."' /><div style='background-color:".$options['navcolorfont'].";width:310px;height:20px;margin-top:10px;'></div>";
}


function posttitlecolor_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[posttitlecolor]' size='40' type='text' value='".$options['posttitlecolor']."' /><div style='background-color:".$options['posttitlecolor'].";width:310px;height:20px;margin-top:10px;'></div>";
}

function postcontentcolor_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[postcontentcolor]' size='40' type='text' value='".$options['postcontentcolor']."' /><div style='background-color:".$options['postcontentcolor'].";width:310px;height:20px;margin-top:10px;'></div>";
}

function leesmeercolor_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[leesmeercolor]' size='40' type='text' value='".$options['leesmeercolor']."' /><div style='background-color:".$options['leesmeercolor'].";width:310px;height:20px;margin-top:10px;'></div>";
}


function cattitlecolor_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[cattitlecolor]' size='40' type='text' value='".$options['cattitlecolor']."' /><div style='background-color:".$options['cattitlecolor'].";width:310px;height:20px;margin-top:10px;'></div>";
}















function space_under_cat_list_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[space_under_cat_list]' size='40' type='text' value='".$options['space_under_cat_list']."' />";
}


function post_title_text_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[post_title_text_color]' size='40' type='text' value='".$options['post_title_text_color']."' /><div style='font-family:".$options['fontfamily'].";width:510px;height:30px;margin-top:10px;font-size:".$options['post_title_text_color'].";'>the quick brown fox jumps over the lazy dog</div>";
}


function post_content_text_color_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[post_content_text_color]' size='40' type='text' value='".$options['post_content_text_color']."' /><div style='background-color:".$options['post_content_text_color'].";width:310px;height:20px;margin-top:10px;'></div>";
}


function post_content_lineheight_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[post_content_lineheight]' size='40' type='text' value='".$options['post_content_lineheight']."' />";
}




function page_title_text_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[page_title_text_size]' size='40' type='text' value='".$options['page_title_text_size']."' /><div style='font-family:".$options['fontfamily'].";width:510px;height:30px;margin-top:10px;font-size:".$options['page_title_text_size'].";'>the quick brown fox jumps over the lazy dog</div>";
}



function page_content_lineheight_string() {
	$options = get_option('myoption_group');
	echo "<input id='theme_text_string' name='myoption_group[page_content_lineheight]' size='40' type='text' value='".$options['page_content_lineheight']."' />";
}










function upbtn_img_wp() {  
	$options = get_option('myoption_group');
	//echo '<input type="file" name="myoption_group[topbarimg]" />';
	echo '<input id="upbtn_load_image" type="text" size="36" name="myoption_group[upbtnimg]" value="'.$options['upbtnimg'].'" /><input id="upbtn_load_image_button" type="button" value="Upload Image" /><br />Enter an URL or upload an image for the banner.';
	echo '<br/><img src="'.$options['upbtnimg'].'" />';
}




add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}



function my_save_item_order() {
    global $wpdb;

    $order = serialize($_POST['order']);
    $current_page = intval($_POST['pageid']);
    $get_id = intval($_POST['getid']);
    $wpdb->sortable_lookup = $table_prefix.'sortable_lookup'; 
    $pageexists = $wpdb->get_results("SELECT * FROM $wpdb->sortable_lookup WHERE sorted_page_id = $current_page AND sorted_get_id = $get_id ");
   
			
    if ($pageexists){
			$wpdb->update($wpdb->sortable_lookup, 
							array('sorted_array' => $order), 
							array( 'sorted_page_id' => $current_page,'sorted_get_id' => $get_id) 
						  );

    	}
    else{
    	$data = array('sorted_page_id' => $current_page,'sorted_get_id' => $get_id, 'sorted_array' => $order );
    	$wpdb->insert( $wpdb->sortable_lookup, $data );
    }
   // echo '<script>console.log("'.$order.');</script>';
    die(1);
}
add_action('wp_ajax_item_sort', 'my_save_item_order');
add_action('wp_ajax_nopriv_item_sort', 'my_save_item_order');





function the_excluded_category($excludedcats = array()){
	$count = 0;
	$categories = get_the_category();
	
	
	foreach($categories as $category){
		if (in_array($category->cat_ID, $excludedcats) ) {
			unset($categories[$count]);
		}
		$count++;
	}
	
	$count = 0;
	foreach($categories as $category) {
		$count++;
	//	if ( !in_array($category->cat_ID, $excludedcats) ) {
			$return_string .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "Cortos de %s" ), $category->name ) . '" ' . '>' . $category->name.'</a>';

			if( $count != count($categories) ){
				$return_string .= ", ";
			}

	//	}
	}
	return $return_string;
}



function make_href_root_relative($input) {
    return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}
function root_relative_permalinks($input) {
    return make_href_root_relative($input);
}
add_filter( 'the_permalink', 'root_relative_permalinks' );


function lang_object_ids($ids_array, $type, $lang=null) {
 if(function_exists('icl_object_id')) {
  $res = array();
  foreach ($ids_array as $id) {
	  if($lang){
		  $xlat = icl_object_id($id,$type,false,$lang);
	  }else{
		  $xlat = icl_object_id($id,$type,false);
	  }
   
   if(!is_null($xlat)) $res[] = $xlat;
  }
  return $res;
 } else {
  return $ids_array;
 }
}
function lang_object_id($id, $type="post",$lang=null) {
 if(function_exists('icl_object_id')) {

  if($lang){
	  $res = icl_object_id($id,$type,true,$lang);
  }else{
	  $res = icl_object_id($id,$type,true);
  }
   
  return $res;
 } else {
  return $id;
 }	
}

?>