<header>
	<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<?php bloginfo( 'description' ); ?>
	<?php get_search_form(); ?>
	<!-- Allows the user to add a custom logo through admin page -->
	<?php 
   $custom_logo_id = get_theme_mod( 'custom_logo' );
   $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      ?>
<img src="<?php echo $image[0]; ?>" alt="">
<!-- Added menu feature on the main page -->
<?php wp_nav_menu(
	array(
		'theme_location' => 'top-menu'
	)
	);?>
	<!-- Ensures banner only appear on the home page -->
	<?php if ( is_front_page() ) {
    banner_home_page_banner();
}
?>
</header>
