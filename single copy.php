<? get_header(); ?>

    <div id="grid-content">
    	
<?php 
$args = array('post_type' => 'post','cat'=>'1','orderby'=>'menu_order','order'=>'ASC');
$thispost = get_the_ID();
$current_post = get_permalink();
$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) : $the_query->the_post(); 
 		 $do_not_duplicate = $post->ID; ?>
		
		<?php 
			if($post->ID==$thispost){
			?>
			
			
		<div id="currentpost" <?php post_class('masonry'); ?>>
			<?php 
			$next_post=get_permalink(get_adjacent_post(false,'',true));
			$prev_post=get_permalink(get_adjacent_post(false,'',false));
			if($next_post!=$current_post) {?>
			<script type="text/javascript">
			jQuery(document).keydown(function(e){
				 if (e.keyCode == 39) { 
			     	window.location.assign("<?php echo $next_post; ?>");
			    }
			});
			</script>
			<a class="next_post_btn" href="<?php echo $next_post; ?>" target="_self"></a>
			<?php } ?>
			<?php 
			if($current_post!=$prev_post){ ?>
			<script type="text/javascript">
			jQuery(document).keydown(function(e){
				 if (e.keyCode == 37) { 
			     	window.location.assign("<?php echo $prev_post; ?>");
			    }
			});
			</script>
			
			<?php }
			?>
			<a class="close_btn" href="<?php bloginfo('url');?>" target="_self"></a>
			<a class="title_content" href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a>
			<div style="margin-top:21px">
			<?php the_content(); ?>
		
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
		</div>
			
		<?php
			}
			else{
		?> 
		
		<div <?php post_class('masonry'); ?>>
			<?php if (has_post_thumbnail() ) : ?>
			
			<a class="img_link" href="<?php the_permalink();?>" target="_self"><?php the_post_thumbnail('homepage-thumb'); ?></a>
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
		<?php 
		}
		?>

<? endwhile; endif; ?>



				
	</div>
    <? get_footer(); ?>