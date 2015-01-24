<?php
/*
Template Name: Mobile Page
*/
?><? get_header("smartphone"); ?>

    <div id="grid-content" class="pagegrid">
    	
<?php 
$thispost = get_the_ID();

$args = array('post_type' => 'page');
$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) : $the_query->the_post(); 
 		 $do_not_duplicate = $post->ID; ?>
		<?php 
			if($post->ID==$thispost){
			?>	
			
		<div id="<?php echo $post->ID; ?>" <?php post_class('masonry'); ?>>
		<div style="width:400px;margin:auto;">


			<?php if (has_post_thumbnail() ) : 
			$small_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-15thumb' );
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-thumb' );

			
			?><div style="width:100%;text-align:center">
			<a class="img_link" href="<?php the_permalink();?>" target="_self" rel="<?php echo $small_thumbnail[0];  ?>">
			
			<!-- <img src="<?php echo $thumbnail[0]; ?>"  /> -->
			
			<?php the_post_thumbnail('large'); ?>
			</a></div>
			<?php endif;?>
			<div class="excerptcontent">
		
			<h4><a href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a></h4>
		
			<?php the_content(); ?>
			
		</div>
		</div>
			
		<? } ?>
<? endwhile; endif; ?>



				
	</div>

    <? get_footer("mobile"); ?>