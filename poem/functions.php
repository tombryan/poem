<?php
/**
 * poem functions and definitions
 *
 * @package poem
 * @since poem 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since poem 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 680; /* pixels */

if ( ! function_exists( 'poem_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since poem 1.0
 */
function poem_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Add default posts RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'poem' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // poem_setup
add_action( 'after_setup_theme', 'poem_setup' );

/**
 * Register custom widgetized area.
 *
 * @since poem 1.0
 */
function poem_widgets_init() {
	register_sidebar( array(
		'name' => __( 'poem bottom footer', 'poem' ),
		'id' => 'footbar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'poem_widgets_init' );

/**
 * Enqueue styles
 */
function poem_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'poem_scripts' );

// Remove the admin bar from the front end
add_filter( 'show_admin_bar', '__return_false' );

// Disable the theme / plugin text editor in Admin
define('DISALLOW_FILE_EDIT', true);

// Custom styles in admin
function wpfme_adminCSS() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/wp-admin.css"/>';
}
add_action('admin_head', 'wpfme_adminCSS');