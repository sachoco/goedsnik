<? get_header(); //echo get_query_var('cat');?>

    <div id="grid-content">
    	
<?php 
$thiscat = get_query_var('cat');
global $wpdb;
$current_page = intval($post->ID);
$get_id=intval($_GET['id']);
if(!isset($get_id)){$get_id=0;}
$wpdb->sortable_lookup = $table_prefix.'sortable_lookup'; 
$sortablelookup = $wpdb->prefix.'sortable_lookup'; 
$result = $wpdb->get_results("SELECT sorted_array FROM sortable_lookup WHERE sorted_page_id = $thiscat AND sorted_get_id = $get_id");
$sorted=unserialize($result[0]->sorted_array);

$sortedarray = explode(",",$sorted);


echo(get_query_var('cat')).'<br/>';

echo($current_page);


$allarray=array();
$tempargs = array('post_type' => 'post','cat'=>$thiscat,'orderby'=>'menu_order','order'=>'ASC');
$current_post = get_category_link($thiscat);
$the_query = new WP_Query($tempargs);
if ($the_query->have_posts()) :
	while ($the_query->have_posts()) : $the_query->the_post(); 
		array_push($allarray,$post->ID);
	endwhile; 
endif;
wp_reset_postdata();


$beensorted=true;

if (sizeof($sortedarray)>1){
foreach($allarray as $child){
	if(!(in_array($child,$sortedarray))){
	array_unshift($sortedarray,$child);
	}
}
	$args = array('post_type' => 'post','cat'=>$thiscat,'post__in'=>$sortedarray,  'orderby' => 'post__in', 'order'=>'ASC');
}
else{
	$beensorted=false;
	$args = array('post_type' => 'post','cat'=>$thiscat,'orderby'=>'menu_order','order'=>'ASC');
}

$current_post = get_category_link($thiscat);
$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :
		while ($the_query->have_posts()) : $the_query->the_post(); 
 		 $do_not_duplicate = $post->ID; 
 		 
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
		
	<?php
	
	if($_GET['id']==$post->ID){
	?>
	
		
	
		<div id="current" class="<?php echo implode(' ',get_post_class('masonry', $post->ID)); ?> <?php echo $columnclass; ?> activemason">
	<?php
		$adjacent_post = get_adjacent_post(true,'1',true) ;
		$nextid = $adjacent_post->ID;
		$adjacent_prev_post = get_adjacent_post(true,'1',false) ;
		$previd = $adjacent_prev_post->ID;
		if(is_numeric($nextid)){
	?>
			<script type="text/javascript">
			jQuery(document).keydown(function(e){
				 if (e.keyCode == 39) { 
			     	window.location = "<?php echo $current_post; ?>?id=<?php echo $adjacent_post->ID; ?>";
			    }
			});
			</script>
			<a class="next_post_btn" href="?id=<?php echo $nextid; ?>" target="_self"></a>
	<?php } ?>
	
	<?php if(is_numeric($previd)){ ?>
	
			<script type="text/javascript">
			jQuery(document).keydown(function(e){
				 if (e.keyCode == 37) { 
			     	window.location.assign("<?php echo $current_post; ?>?id=<?php echo $adjacent_prev_post->ID; ?>");
			    }
			});
			</script>
	<?php } ?>
			<a class="close_btn" href="?id=0#<?php echo $post->ID;?>" target="_self"></a>
			<a class="title_content" href="?id=<?php echo $post->ID;?>" target="_self"><?php the_title(); ?></a>
			<div class="current_content" style="margin-top:26px">
			<?php the_content(); ?>
		
			<?php 
			$the_category_list = the_excluded_category(array(1));
			if(strlen($the_category_list)>0){
			?>
			
			<div class="space"></div>
            <div class="font_size_small">
             	Categorie: <?php echo $the_category_list; ?>
            </div>
			<?php
			}
			?>
			
			</div>
		
		</div>
		
<?php } 
endwhile; endif; 
wp_reset_postdata();
$tester=0;
$arebricks=false;



///beginning of the loop IF something has ever been reorganised

if($beensorted==true){

$the_query = new WP_Query($args);
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
//if($_GET['id']!=$post->ID){ 
?>


		<div id="<?php echo $post->ID; ?>" <?php post_class('masonry'); ?>>
			<?php //if (is_user_logged_in()) { ?>
					<!--
<div class="divgripper">
						<img src="<?php bloginfo("template_url"); ?>/images/divgripper.jpg" height="15" />
					</div>
-->
			
			<?php //} ?>
			
			 <?php 
			  if (MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'category-image')) : 
			  
			$small_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-15thumb' );
			 ?>
			 	<a class="img_link" href="?id=<?php echo $post->ID;?>" target="_self">
			 	<script type="text/javascript">
				jQuery(document).ready(function(){
				
					if(parseInt(jQuery(window).width())<=1450){
					
					jQuery("#<?php echo $post->ID; ?> .img_link img").attr({
						"width":"<?php echo $small_thumbnail[1]; ?>",
						"height":"<?php echo $small_thumbnail[2]; ?>",
						
					});
					}
				});
			</script>
			 <?php
			 	MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'category-image',NULL,'category-image-thumb');
			 	
			 	
			 	 
			 	?>
			 	</a>
			 	
			<?php elseif (has_post_thumbnail()) : 
			
			$small_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-15thumb' );
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-thumb' );
			?>
			<div style="width:100%;text-align:center">
			<a class="img_link" href="?id=<?php echo $post->ID;?>" target="_self" rel="<?php echo $small_thumbnail[0];  ?>">
			<script type="text/javascript">
				jQuery(document).ready(function(){
				
					if(parseInt(jQuery(window).width())<=1450){
					
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
			</a></div>
			<?php endif;?>
			
			
			<h4>
			<a href="?id=<?php echo $post->ID;?>" target="_self"><?php the_title(); ?></a>
		</h4>
			<?php the_excerpt(); 
			if (strlen(get_the_excerpt())>0){
			
			?>
			<!-- <div style="margin:0px 0px 10px 0px;"><a href="?id=<?php echo $post->ID;?>" target="_self" class="lees_meer">(lees meer)</a></div> -->
		
			
			<?php 
			}
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
		//}
		}
		
		$tester++;
		?>

<?php endwhile; endif; 
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
			//if($post->ID!=$thispost){
 		 ?>
		 	
	
		
		<div id="<?php echo $post->ID; ?>" <?php post_class('masonry'); ?>>
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
			?>
			<div style="width:100%;text-align:center">
			<a class="img_link" href="?id=<?php echo $post->ID;?>" target="_self" rel="<?php echo $small_thumbnail[0];  ?>">
			<script type="text/javascript">
				jQuery(document).ready(function(){
				
					if(parseInt(jQuery(window).width())<=1450){
					
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
			</a></div>
			<?php endif;?>
			<h4><a href="?id=<?php echo $post->ID;?>" target="_self"><?php the_title(); ?></a></h4>
		
			<?php the_excerpt(); 
			if (strlen(get_the_excerpt())>0){
			
			?>
			<!-- <div style="margin:0px 0px 10px 0px;"><a href="?id=<?php echo $post->ID;?>" target="_self" class="lees_meer">(lees meer)</a></div> -->
		
			
			<?php 
			}
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

<?php endwhile; endif; 
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
    <? get_footer(); ?>