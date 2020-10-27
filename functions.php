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
function declans_theme_custom_header_setup() {
    $defaults = array(
        // Default Header Image to display
        'default-image'         => get_template_directory_uri() . '/images/headers/default.jpg',
        // Display the header text along with the image
        'header-text'           => true,
        // Header text color default
        'default-text-color'        => '000',
        // Header image width (in pixels)
        'width'             => 1000,
        // Header image height (in pixels)
        'height'            => 198,
        // Header image random rotation default
        'random-default'        => false,
        // Enable upload of image file in admin 
        'uploads'       => false,
        // function to be called in theme head section
        'wp-head-callback'      => 'wphead_cb',
        //  function to be called in preview page head section
        'admin-head-callback'       => 'adminhead_cb',
        // function to produce preview markup in the admin screen
        'admin-preview-callback'    => 'adminpreview_cb',
        );
}
add_action( 'after_setup_theme', 'declans_theme_custom_header_setup' );
	
	add_theme_support( 'custom-header' );
	add_theme_support('post-thumbnails');
	// Added dynamic and customisable logo
	function declans_theme_custom_logo_setup() {
		$defaults = array(
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	   'unlink-homepage-logo' => true, 
		);
		add_theme_support( 'custom-logo', $defaults );
	   }  
	register_nav_menus(array('primary' => 'Primary Navigation'));

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
	function add_class_to_nav_li($classes, $item, $args) {
		if(isset($args->add_li_class)) {
		  $classes[] = $args->add_li_class;
		}
		return $classes;
	  }
	  add_filter('nav_menu_css_class', 'add_class_to_nav_li', 1, 3);
	  
	  function add_class_to_nav_a($classes, $item, $args) {
		if(isset($args->add_a_class)) {
		  $classes[] = $args->add_a_class;
		}
		return $classes;
	  }
	  add_filter('nav_menu_css_class', 'add_class_to_nav_a', 1, 3);

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */
	add_action( 'after_setup_theme', 'declans_theme_custom_logo_setup' );
	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );
	add_action( 'init', 'banner_create_post_type' );
	add_action('wp_enque_scripts','load_stylesheets');
	
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
//implemented custom css from style.css 
		wp_register_style( 'style', get_stylesheet_directory_uri().'/style.css', array(), false, 'all' );
        wp_enqueue_style( 'style' );
	}
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