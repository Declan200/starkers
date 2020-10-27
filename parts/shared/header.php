<header>
	<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<?php bloginfo( 'description' ); ?>
	<?php get_search_form(); ?>
	<!-- Allows the user to add a custom logo through admin page -->
<!-- Added menu feature on the main page -->
<!-- <?php wp_nav_menu(
	array(
		'theme_location' => 'top-menu'
	)
	);?> -->
	<!-- Ensures banner only appears on the home page -->
	<?php if ( is_front_page() ) {
    banner_home_page_banner();
}
?>
</header>
