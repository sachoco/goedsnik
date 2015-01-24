<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_url'); ?>/custom_styles.css" rel="stylesheet" type="text/css" />
<?
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}
?>
<!--<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>-->
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/masonry.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/easing.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scrollto.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ui-1.10.2.custom.min.js"></script>
<style type="text/css">
<?php 
$options = get_option('myoption_group');
?>
body{
	font-size:<?php echo $options['fontsize']; ?>;
	line-height:<?php echo $options['lineheight']; ?>;
}
.categorie_txt{
	font-size:<?php echo $options['fontsize']; ?>;
	line-height:<?php echo $options['lineheight']; ?>;
}
#page_content{
	background-color:<?php echo $options['theme_text_string']; ?>;
}
.navwrap{
	border-bottom:4px solid <?php echo $options['theme_text_string']; ?>;
}
#page_wrap{
	background-color:<?php echo $options['theme_text_string']; ?>;
}
.navigation ul li a{
	color:<?php echo $options['navcolorfont']; ?>;
}
h4 a{
	color:<?php echo $options['posttitlecolor']; ?>;
}
#page_content{
	color:<?php echo $options['postcontentcolor']; ?>;
}
.lees_meer{
	color:<?php echo $options['leesmeercolor']; ?>;
}
.categorie_txt{
	color:<?php echo $options['cattitlecolor']; ?>;
}
#grid-content div.post{
	padding-bottom:<?php echo $options['space_under_cat_list']; ?>;
}

.activemason a.title_content{
	font-size:<?php echo $options['post_title_text_color']; ?>;
	line-height:<?php echo $options['lineheight']; ?>;
}
.activemason{
	font-size:<?php echo $options['post_title_text_color']; ?>;
	color:<?php echo $options['post_content_text_color']; ?>;
	line-height: <?php echo $options['post_content_lineheight']; ?>;
}

.activemason .font_size_small{
	font-size:<?php echo $options['post_title_text_color']; ?>;
	
}
.slideshow_container{
	font-size:<?php echo $options['post_title_text_color']; ?>;

}

	<?php if (!is_user_logged_in()) { ?>
				.bottombrick{
	/*background-color:<?php echo $options['theme_text_string']; ?> !important; */

}
			
			<? } ?>

/*
.font_size_small{
	color:<?php echo $options['cattitlecolor']; ?>;
}
*/
#top_bar{
background-image: url(<?php echo $options['topbarimg']; ?>);
height:<?php $imagesize = getimagesize($options['topbarimg']); echo $imagesize[1]; ?>px;
/* height: 30px; */
}
</style>
<script type="text/javascript">
jQuery(document).ready(function(){
<?php if($options['upbtnimg']!==""){ ?>
	var upbtn = "<div class='upbtn post masonry masonry-brick' style='height:250px;display:none;'><a class='img_link' href='#top' target='_self'><img src='<?php echo $options['upbtnimg']; ?>' width='100%' /><br/><h3>UP</h3></a></div>";
    //$(upbtn).appendTo("#grid-content");
    $("#grid-content .bottombrick:first").before(upbtn);
    
    <?php } ?>
});
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<!--
<?php

if ( is_user_logged_in() ) {
?>
<!--<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/sortable.js"></script>-->
<script type="text/javascript">
/*
$(document).ready( function () 
{

  if(window.location.hash) {
      var hash = window.location.hash; //Puts hash in variable, and removes the 
      if(hash!=="#top"){
      $('html, body').animate({scrollTop: $(hash).offset().top -80 }, 'fast');
      }
  } else {
      // No hash found
  }

})
*/

</script>
<?php
}
else{ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/unsortable.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){

  if(window.location.hash) {
      var hash = window.location.hash; //Puts hash in variable, and removes the 
      if(hash!=="#top"){
      $('html, body').animate({scrollTop: $(hash).offset().top -60 }, 'fast');
      }
  } else {
      // No hash found
  }
});
</script>-->

<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function(){





   
	var colwidth = 204;
	var gridWidth = jQuery('#grid-content').width();
	var numCols = Math.floor(gridWidth/200);
	var resultingGridWidth=numCols*200;
	
	var windowWidth=parseInt(jQuery(window).width());
	var smallwin =false;
	
	if (windowWidth<=1405){
	 colwidth = 165;
	 smallwin=true;
	 jQuery("#grid-content div.post").css("width","143px");
	 numCols=Math.floor(gridWidth/163);
	 resultingGridWidth=numCols*163;
	}
 	
 	
 	jQuery(".img_link").each(function(){
		jQuery(this).find("img").attr("src",jQuery(this).attr("rel"));
	});
	 
	 
	//alert(numCols);
	  	
	  	

    	var logowidth=parseInt(jQuery("#logo_inner img").width());
    	var logoheight=parseInt(jQuery("#logo_inner img").height());
    	var logoratio=logoheight/logowidth;
    	var newlogowidth=resultingGridWidth+20;
    	var newlogoheight=resultingGridWidth*logoratio;
    	
    	jQuery("#logo_inner img").css({"width":newlogowidth});
    	jQuery("#logo_inner img,#logo_inner").css({"height":newlogoheight,"visibility":"visible"});
		jQuery("#fblink").css({"margin-left":resultingGridWidth-75+"px"});


    	

   var lastpostindex = $("#grid-content .bottombrick:first").index()-1;
   var lastposttop = parseInt($("#grid-content div:nth-child("+lastpostindex+")").css("top"))+184;
   var windowheight = $(window).innerHeight(); 
   if(lastposttop>windowheight){
		$(".upbtn").css('display','block');
   }
   
   
   
   
   
   
	 
	 
	 
	var t = $('#grid-content');
	 
   
    
    
    
    t.sortable({
        distance: 12,
        forcePlaceholderSize: true,
        handle: '.divgripper',
        items: '.post,.page',
        placeholder: 'card-sortable-placeholder masonry',
        tolerance: 'pointer',
        
        start:  function(event, ui) {            
                 //console.log(ui); 
            ui.item.addClass('dragging').removeClass('masonry');
            if ( ui.item.hasClass('bigun') ) {
                 ui.placeholder.addClass('bigun');
                 }
                   ui.item.parent().masonry('reload')
                },
        change: function(event, ui) {
                   ui.item.parent().masonry('reload');
                },
        stop:   function(event, ui) { 
                   ui.item.removeClass('dragging').addClass('masonry');
                   ui.item.parent().masonry('reload');
        },
       
        update: function(event, ui) {
            jQuery('#loading-animation').show(); // Show the animate loading gif while waiting

            opts = {
                url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'item_sort', // Tell WordPress how to handle this ajax request
                    order: t.sortable('toArray').toString(), // Passes ID's of list items in  1,3,2 format
                    pageid: <?php echo get_the_ID(); ?>,
                    getid: <?php if(isset($_GET['id'])){echo $_GET['id'];}else{echo 0;} ?>
                },
                success: function(response) {
                    $('#loading-animation').hide(); // Hide the loading animation
                   console.log(t.sortable('toArray').toString());
                    return; 
                },
                error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
                    //alert(e);
                     alert('There was an error saving the updates');
                    $('#loading-animation').hide(); // Hide the loading animation
                    return; 
                }
            };
            $.ajax(opts);
        }
   });

    	if (jQuery(".currentpost_colfull")[0]){
   			var secondtop = jQuery("#grid-content div.post:nth-child(2)").css("top");
    		jQuery("#grid-content div.post,#grid-content div.page").each(function(){
		    	if(jQuery(this).css("top")==secondtop){
		    		var thispad = parseInt(jQuery(this).css("padding-left"))+parseInt(jQuery(this).css("padding-right"));
		    		var thiswidth = parseInt(jQuery(this).css("width"))+thispad;
		    		masonwidth=masonwidth+thiswidth-4;
		    	}
    		});
    		jQuery(".currentpost_colfull").css("width",masonwidth+"px");
   			
		}
		else{
    		jQuery("#grid-content div.post,#grid-content div.page").each(function(){
		    	if(jQuery(this).css("top")=="0px"){
		    		var thispad = parseInt(jQuery(this).css("padding-left"))+parseInt(jQuery(this).css("padding-right"));
		    		var thiswidth = parseInt(jQuery(this).css("width"))+thispad;
		    		masonwidth=masonwidth+thiswidth;
		    	}
    		});
    
    	}
    	
     
   });
</script>













</head>

<body>

<body>
<div id="top_bar"></div>
<div id="page_wrap">
	<div id="logo">
		<a href="<?php bloginfo('url'); ?>" target="_self">
			<div id="logo_inner">
		    	<img src="<?php echo $options['logo']; ?>" height="79" />
	        </div>
        </a>
    </div>
<?php 
//echo get_the_ID();
?>
    <div class="navwrap">
    <div id="topsection">
    <div class="navigation">
    <?php //wp_page_menu(array('show_home'   => false,)); ?> 
    <?php wp_nav_menu( array('theme_location' => 'main_menu' )); ?>
    	<div class="navbox">
    		<form action="<?php bloginfo('url'); ?>" method="get">
    			<?php wp_dropdown_categories('show_option_all=Kies Categorie&exclude=1'); ?>
    		</form>
    	</div>
    	<!-- <div id="fblink">Volg ons op: <a href="#" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/fb_link.jpg" /></a></div> -->
    </div>
    </div>
    </div></div>

    <div id="page_content">