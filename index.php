<?php 
	require_once("include/Mobile_Detect.php");
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() && !$detect->isIpad() ) {
		include("page_mobile.php"); 
	}else{
?>	
<?php get_header(); ?>
    <div id="grid-content">
<?php 
global $wpdb;
$current_page = intval(get_the_ID());
$get_id=intval($_GET['id']);
if(empty($_GET['id'])){$get_id=0;}
/*

$wpdb->sortable_lookup = $table_prefix.'sortable_lookup'; 
$sortablelookup = $wpdb->prefix.'sortable_lookup'; 
*/
// echo "test page: ". $current_page .", id: ".$get_id;
if (is_home()) {
$current_page = 1;
}
$result = $wpdb->get_results("SELECT * FROM sortable_lookup WHERE sorted_page_id = $current_page AND sorted_get_id = $get_id");
$returnedresult= $result[0]->sorted_array;
$sorted=unserialize($returnedresult);
//echo "<script>alert('".$shittysorted."');</script>";
//$sorted = "57,116,95,320,40,206,1709,146,27,852,2001,1782,21,1974,169,122,1997,908,127,119,108,560,1196,7,216,1082,1784,112,1330,18,376,1393,1736,33,984,104,849,875,brick1,brick2,brick3,brick4,brick5,brick6,brick7,brick8,brick9,brick10,brick11,brick12,brick13";

$sortedarray = explode(",",$sorted);
$sortedarray = lang_object_ids($sortedarray, "post");
// var_dump($sortedarray);

$tempargs = array('post_type' => 'post','cat'=>1);
//$current_post = get_permalink();
$allarray=array();
$the_query = new WP_Query($tempargs);
if ($the_query->have_posts()) :
	while ($the_query->have_posts()) : $the_query->the_post(); 
		array_push($allarray,$post->ID);
	endwhile; 
endif;
wp_reset_postdata();


//$zero=array_shift($sortedarray);

if (sizeof($sortedarray)>1){
foreach($allarray as $child){

	if(in_array($child,$sortedarray)){
		//niks
	}
	else{
	
	array_unshift($sortedarray,$child);
	}
}
	$args = array('post_type' => 'post','post__in'=>$sortedarray,  'orderby' => 'post__in', 'order'=>'ASC');
   
}
else{
	$args = array('post_type' => 'post','orderby'=>'menu_order','order'=>'ASC');
}
/*
echo '<div style="position:absolute;z-index:20;width:50px;background-color:white;">'; 
foreach($sortedarray as $child){echo $child."<br/><br/>";}
echo "</div>";
*/
// var_dump(lang_object_ids($sortedarray, "post", "nl"));
$tester=0;
$the_query = new WP_Query($args);
//var_dump($the_query);

	if ($the_query->have_posts()) :
	
		while ($tester<=sizeof($sortedarray)) : 
		
		$isbrick=str_split($sortedarray[$tester],5);
	
		if($isbrick[0]=="brick"){
		 echo '<div id="'.$sortedarray[$tester].'" class="bottombrick post masonry"></div>';
		}
		else{
		$the_query->the_post(); 
			
			
 		 $do_not_duplicate = $post->ID; 
 		 if (in_category("Homepage",$do_not_duplicate)){
	 		
	 		$this_id =  $post->ID;
	 		if(function_exists('icl_object_id') && ICL_LANGUAGE_CODE != "nl") $this_id = icl_object_id($this_id,"post",true,"nl");
 		 ?>
		
		<div id="<?php echo $this_id; ?>" <?php post_class('masonry'); ?>>
			<?php //if (is_user_logged_in()) { ?>
				<!--
	<div class="divgripper">
						<img src="<?php bloginfo("template_url"); ?>/images/divgripper.jpg" height="15" />
					</div>
-->
			
			<? //} ?>
			<?php if (has_post_thumbnail() ) : 
			$small_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-15thumb' );
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-thumb' );
			
			
/*
echo "<pre>";
echo print_r(unserialize($result[0]->sorted_array));
echo "</pre>";
*/
			?><div style="width:100%;text-align:center">
			<a class="img_link" href="<?php the_permalink();?>" target="_self" rel="<?php echo $small_thumbnail[0];  ?>">
			<script type="text/javascript">
				jQuery(document).ready(function(){
				
					if(parseInt(jQuery(window).width())<=1450){
					if(parseInt(jQuery(window).width())>500){
					jQuery("#<?php echo $this_id; ?> .img_link img").attr({
						"src":"<?php echo $small_thumbnail[0]; ?>",
						"width":"<?php echo $small_thumbnail[1]; ?>",
						"height":"<?php echo $small_thumbnail[2]; ?>",
						
					});
					}
					else{
						
					jQuery("#<?php echo $this_id; ?> .img_link img").attr({
						"src":"<?php echo $thumbnail[0]; ?>",
						"width":"100%",
						"height":""
						
					});
					}
					}
				});
			</script>
			
			<!-- <img src="<?php echo $thumbnail[0]; ?>"  /> -->
			
			<?php the_post_thumbnail('homepage-thumb'); ?>
			</a></div>
			<?php endif;?>
			<div class="excerptcontent">
		
			<h4><a href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a></h4>
		
			<?php the_excerpt(); 
			//$content_stripped=strip_tags(get_the_content());
			//if (strcmp($content_stripped,get_the_excerpt())<=0){
			?>
	<!-- 		<div style="margin:0px 0px 10px 0px;"><a href="<?php the_permalink();?>" target="_self" class="lees_meer">(lees meer) -->
			<?php //echo $content_length." >= ".$excerpt_length; ?>
			<!-- </a></div> -->
			
			<?php 
			//}
			$the_category_list = the_excluded_category(array(1,15));
			if(strlen($the_category_list)>0){
			?>
			
			<div class="space"></div>
            <div class="font_size_small">
             	<span class="categorie_txt"><?php _e("Category","goedsnik"); ?>:</span> <?php echo $the_category_list; ?>
            </div>
		<?php	}	?>
		</div>
		</div>
		
		<?php
		}
		}
		
		$tester++;
		
		
		/*
}
		else{
		echo 'shes a brick!';
		}
*/
?>

<? endwhile; endif; 
	
?>



				
	</div>
    <? get_footer(); ?>
    <?php } ?>