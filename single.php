<?php get_header(); ?>
<div id="grid-container">
    <div id="grid-content">
    	<div class="grid-sizer"></div>

<?php 
global $wpdb;
/*
$thiscat = get_query_var('cat');
$current_page = intval(get_the_ID());
*/
$thiscat = lang_object_id(get_query_var('cat'),"category","nl");
$current_page = lang_object_id(get_the_ID(),"post","nl");
$get_id=intval($_GET['id']);
if(!isset($get_id)){$get_id=0;}
/*
$wpdb->sortable_lookup = $table_prefix.'sortable_lookup'; 
$sortablelookup = $wpdb->prefix.'sortable_lookup'; 
*/
// echo "test page: ". $current_page .", id: ".$get_id;

$result = $wpdb->get_results("SELECT sorted_array FROM sortable_lookup WHERE sorted_page_id = $current_page AND sorted_get_id = $get_id");
$sorted=unserialize($result[0]->sorted_array);
//echo $current_page;
/*
if($sorted[0]==','){
substr($sorted,1);
}
*/
$sortedarray = explode(",",$sorted);
$sortedarray = lang_object_ids($sortedarray, "post");

//echo "<pre>"; print_r($sorted); echo "</pre>";
$allarray=array();
$tempargs = array('post_type' => 'post','cat'=>1,'orderby'=>'menu_order','order'=>'ASC');

$current_post = get_permalink();
$the_query = new WP_Query($tempargs);
if ($the_query->have_posts()) :
	while ($the_query->have_posts()) : $the_query->the_post(); 
	
		array_push($allarray,$post->ID);
	endwhile; 
endif;
wp_reset_postdata();

$beensorted=true;
$zero=array_shift($sortedarray);

if (sizeof($sortedarray)>1){
foreach($allarray as $child){
	if(in_array($child,$sortedarray)){
		//niks
	}
	else{
	array_unshift($sortedarray,$child);
	}
}
	$args = array('post_type' => 'post','cat'=>'1','post__in'=>$sortedarray,  'orderby' => 'post__in', 'order'=>'ASC');
}
else{
	
$beensorted=false;
	$args = array('post_type' => 'post','cat'=>'1','orderby'=>'menu_order','order'=>'ASC');
}

//echo '<pre>'; echo print_r($sortedarray); echo '</pre>';
//echo "<pre>"; print_r($thiscat); echo "</pre>";

$thispost = get_the_ID();

$current_post = get_permalink();
$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) : $the_query->the_post(); 
		
 		 $do_not_duplicate = $post->ID;
 		 
 		 
			if($post->ID==$thispost){
			
			
 		 $columnwidth=get_field('number_of_columns');
 		 
 		 if(empty($columnwidth)){
		    $columnclass='currentpost';
 		 }
 		 else{
 		 switch ($columnwidth) {
		    case 'two':
		        $columnclass='currentpost_col2';
		        break;
		    case 'three':
		        $columnclass='currentpost_col3';
		        break;
		    case 'four':
		        $columnclass='currentpost_col4';
		        break;
		    case 'five':
		        $columnclass='currentpost_col5';
		        break;
		    case 'six':
		        $columnclass='currentpost_col6';
		        break;
		    case 'seven':
		        $columnclass='currentpost_col7';
		        break;
		    case 'full':
		        $columnclass='currentpost_colfull';
		        break;
		    default:
		        $columnclass='currentpost';
		}
		}
			?>
			
			
		<div id="current" class="<?php echo implode(' ',get_post_class('masonry', $post->ID)); ?> <?php echo $columnclass; ?> activemason">
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
			<a class="close_btn" href="<?php bloginfo('url');?>#<?php echo $post->ID;?>" target="_self"></a>
			<a class="title_content" href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a>
			<div class="current_content" style="margin-top:26px">
			<?php 
			
			
			the_content(); ?>
		
			<?php 
			$the_category_list = the_excluded_category(array(1));
			if(strlen($the_category_list)>0){
			?>
			
			<div class="space"></div>
            <div class="font_size_small">
             	<span class="categorie_txt"><?php _e("Category","goedsnik"); ?>:</span> <?php echo $the_category_list; ?>
            </div>
			<?php
			}
			?>
			
			</div>
		</div>
			
		<?php
			}
		 endwhile; endif; 
		 wp_reset_query();
$tester=0;
$arebricks=false;
$the_query = new WP_Query($args);



///beginning of the loop IF something has ever been reorganised

if($beensorted==true){

	if ($the_query->have_posts()) :
		while ($tester<sizeof($sortedarray)) : 
		if($sortedarray[$tester]!==""){
		$isbrick=str_split($sortedarray[$tester],5);
		$isbrick= $isbrick[0];
		}
		else{
			$isbrick="brick";
		}
		if($isbrick=="brick"){
			$arebricks=true;
		 echo '<div id="'.$sortedarray[$tester].'" class="bottombrick post masonry"></div>';
		}
		
		else{
		$the_query->the_post(); 
		
		

 		 $do_not_duplicate = $post->ID; 
 		// if (in_category("Homepage",$do_not_duplicate)){
			if($post->ID!=$thispost):
			$this_id =  lang_object_id($post->ID,"post","nl");
 		 ?>
		 	
	
		
		<div id="<?php echo $this_id; ?>" <?php post_class('masonry'); ?>>
			<?php// if (is_user_logged_in()) { ?>
				<!--
	<div class="divgripper">
						<img src="<?php bloginfo("template_url"); ?>/images/divgripper.jpg" height="15" />
					</div>
-->
			
			<?// } ?>
			<?php if (has_post_thumbnail() ) : 
			
			$small_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-15thumb' );
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-thumb' );
			if (get_field("is_animated_gif")) {
				$small_thumbnail = $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$small_thumbnail[1] = "100%";
				$small_thumbnail[2] = "";
			}
			?>
			<div style="width:100%;text-align:center">
			<a class="img_link" href="<?php the_permalink();?>" target="_self" rel="<?php echo $small_thumbnail[0];  ?>">
			<script type="text/javascript">
				jQuery(document).ready(function(){
				
					if(parseInt(jQuery(window).width())<=1450){
					
					jQuery("#<?php echo $this_id; ?> .img_link img").attr({
						"src":"<?php echo $small_thumbnail[0]; ?>",
						"width":"<?php echo $small_thumbnail[1]; ?>",
						"height":"<?php echo $small_thumbnail[2]; ?>",
						
					});
					}
				});
			</script>
						
			<?php 
				if (get_field("is_animated_gif")) {
					$default_attr = array(
						'class' => "animated-gif"
					);
					the_post_thumbnail('full', $default_attr); 

				}else{

					the_post_thumbnail('homepage-thumb'); 
				}
			?>
			</a></div>
			<?php endif;?>
			<h4><a href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a></h4>
		
			<?php the_excerpt(); ?>

			
			<?php 
			//}			
			$the_category_list = the_excluded_category(array(1,15));
			if(strlen($the_category_list)>0){
			?>
			
				<div class="space"></div>
	            <div class="font_size_small">
	             	<span class="categorie_txt"><?php _e("Category","goedsnik"); ?>:</span> <?php echo $the_category_list; ?>
	            </div>
			<?php
			}
			?>
			
		
		</div>
		<?php 
			endif;
		}
		
		$tester++;
		?>

<?php //} 
endwhile; endif; 
if($arebricks==false){
?>

<div id="brick1" class='bottombrick post masonry'></div>
<div id="brick2" class='bottombrick post masonry'></div>
<div id="brick3" class='bottombrick post masonry'></div>
<div id="brick4" class='bottombrick post masonry'></div>
<div id="brick5" class='bottombrick post masonry'></div>
<div id="brick6" class='bottombrick post masonry'></div>
<div id="brick7" class='bottombrick post masonry'></div>
<div id="brick8" class='bottombrick post masonry'></div>
<div id="brick9" class='bottombrick post masonry'></div>
<div id="brick10" class='bottombrick post masonry'></div>
<div id="brick11" class='bottombrick post masonry'></div>
<div id="brick12" class='bottombrick post masonry'></div>
<div id="brick13" class='bottombrick post masonry'></div>
<div id="brick14" class='bottombrick post masonry'></div>
<div id="brick15" class='bottombrick post masonry'></div>


<?php


}





}
//end of loop if things have been sorted

//beginning of loop if things have not been sorted

else{



if ($the_query->have_posts()) :
	while ($the_query->have_posts()) : 
		$the_query->the_post(); 
		
		

 		$do_not_duplicate = $post->ID; 
		$this_id =  lang_object_id($post->ID,"post","nl");

 		 //if (in_category("Homepage",$do_not_duplicate)){
 		 
		if($post->ID!=$thispost):
?>	
		<div id="<?php echo $this_id; ?>" <?php post_class('masonry'); ?>>

			<?php 
			if (has_post_thumbnail() ) : 
			
				$small_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-15thumb' );
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-thumb' );
				if (get_field("is_animated_gif")) {
					$small_thumbnail = $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$small_thumbnail[1] = "100%";
					$small_thumbnail[2] = "";
				}

			?>
			<div style="width:100%;text-align:center">
			<a class="img_link" href="<?php the_permalink();?>" target="_self" rel="<?php echo $small_thumbnail[0];  ?>">
			<script type="text/javascript">
				jQuery(document).ready(function(){
				
					if(parseInt(jQuery(window).width())<=1450){
					
					jQuery("#<?php echo $this_id; ?> .img_link img").attr({
						"src":"<?php echo $small_thumbnail[0]; ?>",
						"width":"<?php echo $small_thumbnail[1]; ?>",
						"height":"<?php echo $small_thumbnail[2]; ?>",
						
					});
					}
				});
			</script>
			
			<!-- <img src="<?php echo $thumbnail[0]; ?>"  /> -->
			
			<?php 
				if (get_field("is_animated_gif")) {
					$default_attr = array(
						'class' => "animated-gif"
					);
					the_post_thumbnail('full', $default_attr); 

				}else{

					the_post_thumbnail('homepage-thumb'); 
				}
			?>
			</a></div>
			<?php endif;?>
			<h4><a href="<?php the_permalink();?>" target="_self"><?php the_title(); ?></a></h4>
		
			<?php the_excerpt(); 

			$the_category_list = the_excluded_category(array(1,15));
			if(strlen($the_category_list)>0){
			?>
			
				<div class="space"></div>
	            <div class="font_size_small">
	             	<span class="categorie_txt"><?php _e("Category","goedsnik"); ?>:</span> <?php echo $the_category_list; ?>
	            </div>
			<?php
			}
			
			?>
			
		
		</div>

<?php //} 
endif;
endwhile; endif; 
if($arebricks==false){
?>


<div id="brick1" class='bottombrick post masonry'></div>
<div id="brick2" class='bottombrick post masonry'></div>
<div id="brick3" class='bottombrick post masonry'></div>
<div id="brick4" class='bottombrick post masonry'></div>
<div id="brick5" class='bottombrick post masonry'></div>
<div id="brick6" class='bottombrick post masonry'></div>
<div id="brick7" class='bottombrick post masonry'></div>
<div id="brick8" class='bottombrick post masonry'></div>
<div id="brick9" class='bottombrick post masonry'></div>
<div id="brick10" class='bottombrick post masonry'></div>
<div id="brick11" class='bottombrick post masonry'></div>
<div id="brick12" class='bottombrick post masonry'></div>
<div id="brick13" class='bottombrick post masonry'></div>
<div id="brick14" class='bottombrick post masonry'></div>
<div id="brick15" class='bottombrick post masonry'></div>


<?php


}

///geez... that's the end of it all




}
?>














	</div>
	</div>
    <?php get_footer(); ?>