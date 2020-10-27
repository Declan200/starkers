<!DOCTYPE html>
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"><!--<![endif]-->
	<head>
     <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<!-- Custom styles for this template -->
<link href="css/clean-blog.min.css" rel="stylesheet">
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cleartype" content="on">

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico"/>
		<!-- <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/img/l/apple-touch-icon-precomposed.png"> -->
		<!-- <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/m/apple-touch-icon-72x72-precomposed.png"> -->
		<!-- <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/h/apple-touch-icon-114x114-precomposed.png"> -->
		<!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/h/apple-touch-icon-144x144-precomposed.png"> -->
		<!--iOS -->
		<!-- <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?>"> -->
		<!-- <meta name="apple-mobile-web-app-capable" content="yes"> -->
		<!-- <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->
		<!-- Startup images -->
		<!-- <link rel="apple-touch-startup-image" href="<?php echo get_stylesheet_directory_uri(); ?>/img/startup/startup-320x460.png" media="screen and (max-device-width:320px)"> -->
		<!-- <link rel="apple-touch-startup-image" href="<?php echo get_stylesheet_directory_uri(); ?>/img/startup/startup-640x920.png" media="(max-device-width:480px) and (-webkit-min-device-pixel-ratio:2)"> -->
		<!-- <link rel="apple-touch-startup-image" href="<?php echo get_stylesheet_directory_uri(); ?>/img/startup/startup-640x1096.png" media="(max-device-width:548px) and (-webkit-min-device-pixel-ratio:2)"> -->
		<!-- <link rel="apple-touch-startup-image" sizes="1024x748" href="<?php echo get_stylesheet_directory_uri(); ?>/img/startup/startup-1024x748.png" media="screen and (min-device-width:481px) and (max-device-width:1024px) and (orientation:landscape)"> -->
		<!-- <link rel="apple-touch-startup-image" sizes="768x1004" href="<?php echo get_stylesheet_directory_uri(); ?>/img/startup/startup-768x1004.png" media="screen and (min-device-width:481px) and (max-device-width:1024px) and (orientation:portrait)"> -->
		<!-- Windows 8 / RT -->
		<!-- <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/img/h/apple-touch-icon-144x144-precomposed.png"> -->
		<!-- <meta name="msapplication-TileColor" content="#000"> -->

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> id="">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
    <div class="mr-2 d-block">
      <!-- Custom logo here -->
      <?php 
   $custom_logo_id = get_theme_mod( 'custom_logo' );
   $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      ?>
<img src="<?php echo $image[0]; ?>" alt="">
      </div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <!-- Create the dynamic menu -->
      <?php wp_nav_menu(array(
  'theme_location' => 'primary',
  'depth' => 2, // 1 no dropdown, 2 dropdowns
  'container' => 'div',
  'container_class' => 'collapse navbar-collapse text-center',
	'container_id' => 'navbarResponsive',
  'menu_class' => 'navbar-nav',
	'add_li_class' => 'nav-item',
	'add_a_class' => 'nav-link'
)); ?>
		<?php get_search_form(); ?>
    </div>
  </nav>
  <!-- Page Header -->
  <!-- if-else statement below manages the banner image of the site displaying a grey box if no image is selected -->
		<?php if ( get_header_image() ) : ?>
  <header class="masthead" style="background-image: url('<?php header_image() ?>')">
	  <?php else: ?>
	   <header class="masthead">
		   <?php endif; ?>
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1 class="display-1"><?php bloginfo( 'name' ); ?></h1>
            <span class="subheading"><?php echo get_bloginfo('description') ?></span>
           </div>
         </div>
      	</div>
    </div>
  </header>
<div class="container my-5 py-5 h-100">