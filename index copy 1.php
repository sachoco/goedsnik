<? get_header(); ?>
    <div id="grid-content">
    	
<?php 
global $wpdb;
$current_page = intval($post->ID);
$get_id=intval($_GET['id']);
if(!isset($_GET['id'])){$get_id=0;}
$wpdb->sortable_lookup = $table_prefix.'sortable_lookup'; 
$sortablelookup = $wpdb->prefix.'sortable_lookup'; 
$result = $wpdb->get_results("SELECT sorted_array FROM sortable_lookup WHERE sorted_page_id = $current_page AND sorted_get_id = $get_id");
$sorted=unserialize($result[0]->sorted_array);
$sortedarray = explode(",",$sorted);

if (sizeof($sortedarray)>1){
	$args = array('post_type' => 'post','cat'=>'1','post__in'=>$sortedarray,  'orderby' => 'post__in', 'order'=>'ASC','ignore_sticky_posts' => 1);
   echo '<script>console.log("<pre>'.print_r($current_page).'</pre>");</script>';
}
else{
	$args = array('post_type' => 'post','cat'=>'1','orderby'=>'menu_order','order'=>'ASC');
}

//echo "<pre>"; print_r($result); echo "</pre>";
/*
echo '<div style="position:absolute;z-index:20;width:50px;background-color:white;">'; 
foreach($sortedarray as $child){echo $child."<br/><br/>";}
echo "</div>";
*/

$the_query = new WP_Query($args);
//var_dump($the_query);

	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) : $the_query->the_post(); 
 		 $do_not_duplicate = $post->ID; ?>
		
		<div id="<?php echo $post->ID; ?>" <?php post_class('masonry'); ?>>
			<?php if (is_user_logged_in()) { ?>
					<div class="divgripper">
						<img src="<?php bloginfo("template_url"); ?>/images/divgripper.jpg" height="15" />
					</div>
			
			<? } ?>
			<?php if (has_post_thumbnail() ) : 
			$small_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-15thumb' );
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-thumb' );

			
			?>
			<a class="img_link" href="<?php the_permalink();?>" target="_self" rel="<?php echo $small_thumbnail[0];  ?>">
			<script type="text/javascript">
				jQuery(document).ready(function(){
				
					if(parseInt(jQuery(window).width())<=1405){
					
					jQuery("#<?php echo $post->ID; ?> .img_link img").attr({
						"src":"<?php echo $small_thumbnail[0]; ?>",
						"width":"<?php echo $small_thumbnail[1]; ?>",
						"height":"<?php echo $small_thumbnail[2]; ?>",
						
					});
					}
				});
			</script>
			
			<!-- <img src="<?php echo $thumbnail[0]; ?>"  /> -->
			
			<?php the_post_thumbnail('homepage-thumb'); ?>
			</a>
			<?php endif;?>
			
		
			<h4><a href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a></h4>
		
			<?php the_excerpt(); ?>
			<div style="margin:0px 0px 10px 0px;"><a href="<?php the_permalink();?>" target="_self" class="lees_meer">(lees meer)</a></div>
			
			<?php 
			$the_category_list = the_excluded_category(array(1));
			if(strlen($the_category_list)>0){
			?>
			
			<div class="space"></div>
            <div class="font_size_small">
             	<span class="categorie_txt">Categorie:</span> <?php echo $the_category_list; ?>
            </div>
			<?php
			}
			?>
		
		</div>
		


<? endwhile; endif; ?>

<!--
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>
<div class='bottombrick post masonry'></div>

-->

				
	</div>
    <? get_footer(); ?>