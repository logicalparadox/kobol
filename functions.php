<?php
/**
 * @package WordPress
 * @subpackage kobol
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on kobol, use a find and replace
 * to change 'kobol' to the name of your theme in all the template files
 */
load_theme_textdomain( 'kobol', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );


require_once ( get_stylesheet_directory() . '/_inc/admin/kobol-options.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/**
 * This theme uses wp_nav_menu() in one location.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'kobol' ),
) );

/**
 * Adds support "sticky" navigation
 */

function kobol_sticky_nav_support() {
  if ( !is_admin() ) { // instruction to only load if it is not the admin area
     // register your script location, dependencies and version
     wp_register_script('kobol_sticky_nav',
         get_bloginfo('template_directory') . '/js/kobol-stickynav.js',
         array('jquery'),
         '1.0' );
     // enqueue the script
     wp_enqueue_script('kobol_sticky_nav');
  }
}


function kobol_stick_nav_class($classes) {
	$classes[] = 'sticky-nav';
	return $classes;
}
add_filter('body_class','kobol_stick_nav_class');


/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Add support for the Aside and Gallery Post Formats
 */
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function kobol_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'kobol_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function kobol_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar 1', 'kobol' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array (
		'name' => __( 'Sidebar 2', 'kobol' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional second sidebar area', 'kobol' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	
}
add_action( 'init', 'kobol_widgets_init' );
