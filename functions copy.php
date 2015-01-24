<?php
register_nav_menu('main_menu', 'Main Menu');
add_post_type_support( 'post', 'page-attributes' );
add_theme_support( 'post-thumbnails' ); 
add_image_size( 'homepage-thumb', 180);


add_image_size('blahblah', 560);
add_image_size('portrait', 483);


add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
	$custom_sizes = array(
		'blahblah' => 'Landscape',
		'portrait' => 'Portrait'
	);
	return array_merge( $sizes, $custom_sizes );
}



/*
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}*/



/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );


/** Step 1. */
function my_plugin_menu() {
	add_options_page( 'Theme Options', 'Theme Options', 'manage_options', 'theme_options', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class="wrap">
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
	
	add_settings_field('topbarimg', 'Top bar:', 'topbar_img_wp', 'theme_options', 'theme_main');
	add_settings_field('logo', 'Logo:', 'logo_img_wp', 'theme_options', 'theme_main');
	
	

	add_settings_field('theme_text_string', 'Background Color', 'theme_setting_string', 'theme_options', 'theme_main');
	
}
function theme_section_text() {
	//echo '<p>Main description of this section here.</p>';
} 
function theme_setting_string() {
	$options = get_option('myoption_group');
	?>
	<input id='theme_text_string' name='myoption_group[theme_text_string]' size='40' type='text' value='<?php echo $options['theme_text_string']; ?>' />
	<?php
	echo '<div style="background-color:'.$options['theme_text_string'].';width:310px;height:20px;margin-top:10px;"></div>';
}



function logo_img_wp() {  
	$options = get_option('myoption_group');
	//echo '<input type="file" name="myoption_group[topbarimg]" />';
	echo '<input id="upload_image" type="text" size="36" name="myoption_group[logo]" value="'.$options['logo'].'" /><input id="upload_image_button" type="button" value="Upload Image" /><br />Enter an URL or upload an image for the banner.';
	echo '<br/><img src="'.$options['logo'].'" />';
}

function topbar_img_wp() {  
	$options = get_option('myoption_group');
	//echo '<input type="file" name="myoption_group[topbarimg]" />';
	echo '<input id="upload_image" type="text" size="36" name="myoption_group[topbarimg]" value="'.$options['topbarimg'].'" /><input id="upload_image_button" type="button" value="Upload Image" /><br />Enter an URL or upload an image for the banner.';
	echo '<br/><img src="'.$options['topbarimg'].'" />';
}



/*
function topbar_img() {  
$options = get_option('myoption_group');

echo '<input type="file" name="myoption_group[topbarimg]" />';
echo '<img src="'.$options['topbarimg'].'" />';
}


function validate_setting($plugin_options) { 
	$keys = array_keys($_FILES); 
	$i = 0; 
	foreach ( $_FILES as $image ) {   
		// if a files was upload   
		if ($image['size']) {     
			// if it is an image     
			if (in_array('/(jpg|jpeg|png|gif)$/', $image['type']) ) {       
				$override = array('test_form' => false);      
				// save the file, and store an array, containing its location in $file       
				$file = wp_handle_upload( $image, $override );       
				$plugin_options[$keys[$i]] = $file['url'];     
			} 
			else {       
				// Not an image.        
				$options = get_option('myoption_group');       
				$plugin_options[$keys[$i]] = $options[$logo];       
				// Die and let the user know that they made a mistake.       
				wp_die('No image was uploaded. '.sizeof($image['type']));     
			}   
		}   
		// Else, the user didn't upload a file.   
		// Retain the image that's already on file.   
		else {     
			$options = get_option('myoption_group');     
			$plugin_options[$keys[$i]] = $options[$keys[$i]];   
		}   
	$i++; 
	} 
	return $plugin_options;
}
*/












/*


function myoption_group_validate($input) {
$options = get_option('myoption_group');
$options['theme_text_string'] = trim($input['theme_text_string']);
if(!preg_match('/^[a-z0-9]{32}$/i', $options['theme_text_string'])) {
$options['theme_text_string'] = '';
}
return $options;
}
*/






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
?>