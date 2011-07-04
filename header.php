<?php
/**
 * @package WordPress
 * @subpackage Toolbox
 */
 
 // load theme options
 $kobol_options = get_option('kobol_theme_options');
 
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory'); ?>/css/app.css" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php bloginfo( 'template_directory' ); ?>/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<header id="branding" role="banner">
			<hgroup>
				<h1 id="site-title"><span><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				
				<?php if ( $kobol_options['kobol_header_display'] == 'all' || ( $kobol_options['kobol_header_display'] == 'homepage' && is_front_page() ) ) : ?>
				<div id="hcontent">
  				<?php
  				  if ( $kobol_options['kobol_header_options'] == 'widget' ) : ?>
  				    <div id="header-widgets">
  				      <?php dynamic_sidebar( 'header' ); ?>
  				    </div>
  				<?php
  			    elseif ( ( $kobol_options['kobol_header_options'] == 'static' || ! $kobol_options['kobol_header_options'] ) && get_header_image() ) : ?>
  				    <img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
  				<?php
  				  elseif ( $kobol_options['kobol_header_options'] == 'none' ) : ?>
  				    <?php //do nothing 
  				    ?>
  				
  				<?php endif; ?>  
	      </div>
	      <?php endif; ?>
			</hgroup>

      <div id="nav-placeholder">
        <div id="nav-wrap">
    			<nav id="access" role="navigation">
    				<h1 class="section-heading"><?php _e( 'Main menu', 'toolbox' ); ?></h1>
    				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>
    
    				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    			</nav><!-- #access -->
    		</div>
    	</div>
	</header><!-- #branding -->


	<div id="main">