<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<!-- Home Page ACF Functionality -->
<!-- <h2><?php the_field('home_page_header_text'); ?></h2>
	<p><?php the_field('home_page_description_text'); ?><p> -->
<!-- About Page ACF Functionality	 -->
	<!-- <h2><?php the_field('about_page_header_text'); ?></h2>
	<p><?php the_field('about_page_description_text'); ?><p> -->
<!-- Contact Page ACF Functionality	 -->
	<!-- <h2><?php the_field('contact_page_header_text'); ?></h2>
	<p><?php the_field('contact_page_description_text'); ?><p> -->
    <h2><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php comments_template( '', true ); ?>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>