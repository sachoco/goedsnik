<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<?php wp_head(); ?>
</head>

<body>
<div id="page_wrap">
  <div class="navigation">
  <!-- begin our original unordered list from class -->
  
  <!--
   <ul>
      <li><a href="#">Info</a></li>
      <li><a href="#">Highlights</a></li>
      <li><a href="#">Pictures</a></li>
    </ul>
   -->
   
  <!-- end our original unordered list from class -->



<!-- begin list of pages -->

<?php wp_page_menu(array('show_home'   => true,)); ?> 

<!-- end list of pages -->


<!-- begin custom nav menu (note this has been registered in functions.php) -->

<!--
<?php wp_nav_menu( array('theme_location' => 'custom_nav_menu' )); ?>
-->

<!-- end custom nav menu -->


  </div>
  <div class="content_wrap">