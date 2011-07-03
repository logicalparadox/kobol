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
$sticky_menu_options = array(
	'no' => array(
		'value' => 'no',
		'label' => __( 'No', 'kobol' )
	),
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Yes (top)', 'kobol' )
	)
);


/**
 * Create the options page
 */
function kobol_options_do_page() {
	global $sticky_menu_options;

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
				
				
				
				  <?php
  				/**
  				 * Display options for sticky menu
  				 */
  				?>
  				<tr valign="top"><th scope="row"><?php _e( 'Enable Sticky Menus?', 'kobol' ); ?></th>
						<td>
							<fieldset><legend class="screen-reader-text"><span><?php _e( 'Enable Sticky Menus?', 'kobol' ); ?></span></legend>
							<?php
								if ( ! isset( $checked ) )
									$checked = '';
								foreach ( $sticky_menu_options as $option ) {
									$radio_setting = $options['sticky_menu_options'];
	
									if ( '' != $sticky_menu_options ) {
										if ( $options['sticky_menu_options'] == $option['value'] ) {
											$checked = "checked=\"checked\"";
										} else {
											$checked = '';
										}
									}
									?>
									<label class="description"><input type="radio" name="kobol_theme_options[sticky_menu_options]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
									<?php
								}
							?>
							</fieldset>
						</td>
					</tr>				
  			</table>
  			<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'sampletheme' ); ?>" />
				</p>
			</form>
	</div>
	
	
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function kobol_options_validate( $input ) {
	global $sticky_menu_options;

	// Sticky Menu Options
	if ( ! isset( $input['sticky_menu_options'] ) )
		$input['sticky_menu_options'] = null;
	if ( ! array_key_exists( $input['sticky_menu_options'], $sticky_menu_options ) )
		$input['sticky_menu_options'] = null;

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

?>