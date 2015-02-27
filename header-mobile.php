<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=480" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta name="keywords" content="Katie McGonigal, Stella Akse, Goedsnik, grafisch ontwerp">

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
<!-- <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/masonry.js"></script> -->

<!-- <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scrollto.js"></script> -->
<!--<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/localscroll.js"></script>
-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scrolId.js"></script>
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

.pagegrid #current{
	font-size:<?php echo $options['page_title_text_size']; ?>;
	line-height: <?php echo $options['page_content_lineheight']; ?>;
}

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

<script type="text/javascript">
jQuery(document).ready(function(){


/*
	$.localScroll({
		queue:true,
		duration:1000,
		hash:true,
	});
*/


   
	var colwidth = 204;
	var gridWidth = jQuery('#grid-content').width();
	var numCols = Math.floor(gridWidth/200);
	var resultingGridWidth=numCols*200;
	
	var windowWidth=parseInt(jQuery(window).width());
	var smallwin =false;
	//alert(windowWidth);
	

 	if($(window).width()<=500){
 	
    	jQuery("#logo_inner img,#logo_inner").css({"visibility":"visible"});
 	}
 	else{
 	jQuery("#grid-content div").each(function(){
 			var thislength = jQuery(this).attr("id");
 			
 			if (thislength==""){
 			jQuery(this).css("display","none");
 			}
 		})
 	
 	jQuery(".img_link").each(function(){
		jQuery(this).find("img").attr("src",jQuery(this).attr("rel"));
	});
	 
	 
	//alert(numCols);
	  	

    	var logowidth=parseInt(jQuery("#logo_inner img").width());
    	var logoheight=parseInt(jQuery("#logo_inner img").height());
    	var logoratio=logoheight/logowidth;
    	var newlogowidth=resultingGridWidth;
    	var newlogoheight=Math.floor(resultingGridWidth*logoratio);
    	
	  	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
	  	jQuery("#logo_inner img").removeAttr("height");
	  	jQuery("#logo_inner img").css({"width":newlogowidth+"px"});
    	jQuery("#logo_inner img,#logo_inner").css({"height":newlogoheight,"visibility":"visible"});
	  	
	  	
	  	}
else{
    	jQuery("#logo_inner img").css({"width":newlogowidth});
    	jQuery("#logo_inner img,#logo_inner").css({"height":newlogoheight,"visibility":"visible"});
}
		jQuery("#fblink").css({"margin-left":resultingGridWidth-75+"px"});

    	

   var lastpostindex = $("#grid-content .bottombrick:first").index()-1;
   var lastposttop = parseInt($("#grid-content div:nth-child("+lastpostindex+")").css("top"))+184;
   var windowheight = $(window).innerHeight(); 
   if(lastposttop>windowheight){
		$(".upbtn").css('display','block');
   }
   
   }
   
   
   

		$("[id*='Btn']").stop(true).on('click',function(e){e.preventDefault();$(this).scrolld();});
		/*
console.log($("#ons").offset().top);
		$("#onsBtn").on('click', function(e){
			console.log($("#ons").offset().top);
			
		});
*/
   });
</script>


</head>

<body id="mobile">

<div style="display:none;">Goedsnik (Katie McGonigal & Stella Akse) is een grafisch ontwerpbureau uit Den Haag. We maken onder andere websites, boeken, posters en animaties.Goedsnik (Katie McGonigal & Stella Akse) is een grafisch ontwerpbureau uit Den Haag. We maken onder andere websites, boeken, posters en animaties.Goedsnik (Katie McGonigal & Stella Akse) is een grafisch ontwerpbureau uit Den Haag. We maken onder andere websites, boeken, posters en animaties.</div>
<div id="top_bar"></div>
    <div class="navwrap_mobile">
	    <div id="topsection">
		    <div class="navigation">
		    	<a href="/mobile" target="_self"><div class="logo"></div></a>
		
			    <div class="menu-main-menu-container">
			    	<ul id="menu-main-menu" class="menu">
			    		<li id="menu-item-16" class="menu-item left"><a id="onsBtn" href="#ons"><?php _e("About us","goedsnik"); ?></a></li>
			    		<li id="menu-item-16" class="menu-item center"><a id="contactBtn" href="#contact">Contact</a></li>
			    		<li id="menu-item-fb" class="menu-item right"><a href="https://www.facebook.com/goedsnik.ontwerp?fref=ts" target="_blank"><?php _e("Follow us on","goedsnik"); ?>: <img src="<?php bloginfo('template_url'); ?>/images/fb_link.jpg" /></a></li>
						<li id="menu-item-lang" class="menu-item right"><?php languages_list(); ?></li>
					</ul>
					
					<div class="clear"></div> 
				</div>
			</div>
		</div>
    </div>
<div id="page_wrap">



    <div id="page_content_mobile">
