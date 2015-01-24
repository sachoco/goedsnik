<? get_header(); ?>

    <div id="grid-content">
    	
<?php if (have_posts()) :
		while (have_posts()) : the_post(); 
 		 $do_not_duplicate = $post->ID; ?>
		
		<div <?php post_class(); ?>>
			<?php if (has_post_thumbnail() ) : ?>
			<a class="img_link" href="<?php the_permalink();?>" target="_self"><?php the_post_thumbnail('homepage-thumb'); ?></a>
			<?php endif;?>
		
			<?php the_excerpt(); ?>
		
			<div class="space"></div>
            <div class="font_size_small">
             	Categorie: <?php the_category(', '); ?>
            </div>
		
		</div>


<? endwhile; endif; ?>



				
	</div>
    <? get_footer(); ?>