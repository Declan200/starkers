<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	// Added dynamic and customisable logo
	function themename_custom_logo_setup() {
		$defaults = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	   'unlink-homepage-logo' => true, 
		);
		add_theme_support( 'custom-logo', $defaults );
	   }
	   add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
	
	   
	register_nav_menus(array('primary' => 'Primary Navigation', 'top-menu' => 'Top Menu'));

	function banner_create_post_type() {
		$labels = array(
			'name' => __( 'Banners' ),
			'singular_name' => __( 'banner' ),
			'add_new' => __( 'New banner' ),
			'add_new_item' => __( 'Add New banner' ),
			'edit_item' => __( 'Edit banner' ),
			'new_item' => __( 'New banner' ),
			'view_item' => __( 'View banner' ),
			'search_items' => __( 'Search banners' ),
			'not_found' =>  __( 'No banners Found' ),
			'not_found_in_trash' => __( 'No banners found in Trash' ),
		);
		$args = array(
			'labels' => $labels,
			'has_archive' => true,
			'public' => true,
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'custom-fields',
				'thumbnail',
				'page-attributes'
			),
			'taxonomies' => array( 'post_tag', 'category'),
		);
		register_post_type( 'banner', $args );
	}
	add_action( 'init', 'banner_create_post_type' );
	
	// function to show home page banner using query of banner post type
	function banner_home_page_banner() { 
		// start by setting up the query
		$query = new WP_Query( array(
			'post_type' => 'banner',
		));
	 
		// now check if the query has posts and if so, output their content in a banner-box div
		if ( $query->have_posts() ) { ?>
			<div class="banner-box">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'banner' ); ?>><?php the_content(); ?></div>
				<?php endwhile; ?>
			</div>
		<?php }
		wp_reset_postdata();
	 
	}

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );
// enabled bootstrap 
		wp_register_style( 'bootstrap', get_stylesheet_directory_uri().'/css/bootstrap.min.css', array(), false, 'all' );
        wp_enqueue_style( 'bootstrap' );
//custom css from style 
		wp_register_style( 'style', get_stylesheet_directory_uri().'/style.css', array(), false, 'all' );
        wp_enqueue_style( 'style' );
	}
add_action('wp_enque_scripts','load_stylesheets');
	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}