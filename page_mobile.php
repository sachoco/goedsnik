<?php
/*
Template Name: Mobile Home
*/
?>
<?php get_header("mobile"); ?>
    <div id="grid-content">
    <div style="height:104px;"></div>
<?php 
global $wpdb;
$current_page = intval(get_the_ID());
$get_id=intval($_GET['id']);
if(!isset($_GET['id'])){$get_id=0;}

$current_page = 1;

$result = $wpdb->get_results("SELECT sorted_array FROM sortable_lookup WHERE sorted_page_id = $current_page AND sorted_get_id = $get_id");

$sorted=unserialize($result[0]->sorted_array);
$sortedarray = explode(",",$sorted);


$tempargs = array('post_type' => 'post','cat'=>1);
$allarray=array();
$the_query = new WP_Query($tempargs);
if ($the_query->have_posts()) :
	while ($the_query->have_posts()) : $the_query->the_post(); 
		array_push($allarray,$post->ID);
	endwhile; 
endif;
wp_reset_postdata();

$args = array('post_type' => 'post','orderby'=>'menu_order','order'=>'ASC',	'meta_key' => 'hide_on_mobile', 'meta_value' => 0);

$tester=0;
$the_query = new WP_Query($args);
		while ( $the_query->have_posts() ) : 
		$the_query->the_post(); 
 		 ?>
		<div id="<?php echo $post->ID; ?>" <?php post_class("item"); ?>>
		<div style="max-width:400px;margin:auto;">
<?php
	if(get_field("video")):
?>		
		<div class="embed-container">
			<?php the_field('video'); ?>
		</div>
			<?php elseif (get_field("mobile_thumbnail") ) : 	?>
				<div style="width:100%;text-align:center">			
					<?php $image = get_field('mobile_thumbnail'); ?>
						<img class="no-lazy" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

				</div>
			<?php elseif (has_post_thumbnail() ) : 	?>
				<div style="width:100%;text-align:center">			
					<?php the_post_thumbnail('large',array('class'	=> "no-lazy")); ?>
				</div>
			<?php endif;?>
			
			<div class="excerptcontent">
		
				<h4><?php the_title(); ?></h4>
				<?php 
				
				$m_text = get_field('mobile_text');
				if($m_text){
					echo $m_text;
				}else{
					$content = get_the_content();
					$content = preg_replace('/(<)([img])(\w+)([^>]*>)/', '', $content);
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
					echo $content;
				}
				
				?>
				<div class="space"></div>
			</div>
		</div>
		</div>
		
<?php $tester++; ?>

<?php endwhile;  ?>
<?php
	
$args = array('post_type' => 'page', 'post__in' => array( 1850,1852 ), 'orderby' => 'ID', 'order'=>'ASC');
$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) : $the_query->the_post(); ?>
	<div id="<?php echo $post->ID; ?>" <?php post_class(); ?>>
		<div id="<?php echo $post->post_name; ?>" style="margin-top: -115px;position: absolute;"></div>		

		<div style="max-width:400px;margin:auto;">


			<?php if (has_post_thumbnail() ) : 	?>
			
			<div style="width:100%;text-align:center">
				<?php the_post_thumbnail('large'); ?>
			</div>
			<?php endif;?>
			
			<div class="excerptcontent">
				<h4><?php the_title(); ?></h4>
				<?php the_content(); ?>
			</div>
		</div>
	</div>	
<?php endwhile; endif; ?>



				
	</div>
<? get_footer("mobile"); ?>