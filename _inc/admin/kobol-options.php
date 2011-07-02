<?php


add_action( 'admin_init', 'kobol_options_init' );
add_action( 'admin_menu', 'kobol_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function kobol_options_init(){
	register_setting( 'kobol_options', 'kobol_theme_options', 'kobol_options_validate' );
}

/**
 * Load up the menu page
 */
function kobol_options_add_page() {
	add_theme_page( __( 'Kobol Options', 'kobol' ), __( 'Kobol Options', 'kobol' ), 'edit_theme_options', 'kobol_options', 'kobol_options_do_page' );
}


/**
 * Create arrays for our select and radio options
 */
$kobol_options_array = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Zero', 'sampletheme' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'One', 'sampletheme' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two', 'sampletheme' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Three', 'sampletheme' )
	),
	'4' => array(
		'value' => '4',
		'label' => __( 'Four', 'sampletheme' )
	),
	'5' => array(
		'value' => '3',
		'label' => __( 'Five', 'sampletheme' )
	)
);


/**
 * Create the options page
 */
function kobol_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
			<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'kobol' ) . "</h2>"; ?>
	
			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'kobol' ); ?></strong></p></div>
			<?php endif; ?>
	
			<form method="post" action="options.php">
				<?php settings_fields( 'kobol_options' ); ?>
				<?php $options = get_option( 'kobol_theme_options' ); ?>
	
				<table class="form-table">
				
				</table>
			</form>
	</div>
	
	
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function kobol_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

?>