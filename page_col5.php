<?php
/*
Template Name: Five Columns
*/
?>
<? get_header(); ?>

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
			
			
		<div id="current" class="<?php echo implode(' ',get_post_class('masonry', $post->ID)); ?> currentpost_col5 activemason">
	
			<a class="close_btn" href="<?php bloginfo('url');?>" target="_self"></a>
			<a class="title_content" href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a>
			<div style="margin-top:26px">
			<?php the_content(); ?>
		</div>
		
		
		
		</div>
			
		<?php
			}
			endwhile; endif; 
			$args = array('post_type' => 'page','orderby'=>'menu_order','order'=>'ASC');
$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) : $the_query->the_post(); 
 		 $do_not_duplicate = $post->ID; 
 		 if($thispost!=$do_not_duplicate){
 		 ?>
			
	
		
		<div id="<?php echo $post->ID; ?>" <?php post_class('masonry'); ?>>
			<?php if (is_user_logged_in()) { ?>
					<div class="divgripper">
						<img src="<?php bloginfo("template_url"); ?>/images/divgripper.jpg" height="15" />
					</div>
			
			<? } ?>
			<?php if (has_post_thumbnail() ) : ?>
			<a class="img_link" href="<?php the_permalink();?>#currentpost" target="_self"><?php the_post_thumbnail('homepage-thumb'); ?></a>
			<?php endif;?>
			<h4>
			<a href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a>
		</h4>
		
			<?php the_excerpt(); ?>
			<!-- <div style="margin:0px 0px 10px 0px;"><a href="<?php the_permalink();?>" class="lees_meer" target="_self">(lees meer)</a></div> -->
		
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
		<?php 
		}
		?>

<? endwhile; endif; ?>



				
	</div>
    <? get_footer(); ?>