<?php


add_action( 'admin_init', 'kobol_webfonts_init' );
add_action( 'admin_menu', 'kobol_webfonts_add_page' );

/**
 * Init plugin options to white list our options
 */
function kobol_webfonts_init(){
	register_setting( 'kobol_options_wf', 'kobol_webfonts_options', 'kobol_webfonts_validate' );
}

/**
 * Load up the menu page
 */
function kobol_webfonts_add_page() {
	add_theme_page( __( 'Webfonts', 'kobol' ), __( 'Webfonts', 'kobol' ), 'edit_theme_options', 'kobol_webfonts', 'kobol_webfonts_do_page' );
}

/**
 * Create the options page
 */
function kobol_webfonts_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
			<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Webfont Options', 'kobol' ) . "</h2>"; ?>
	
			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'kobol' ); ?></strong></p></div>
			<?php endif; ?>
	
			<form method="post" action="options.php">
				<?php settings_fields( 'kobol_options_wf' ); ?>
				<?php $options = get_option( 'kobol_webfonts_options' ); ?>
	
				<table class="form-table">
				
				  <?php
  				/**
  				 * Checkbox: Enable Webfonts Javascript
  				 */
  				?>
  				<tr valign="top"><th scope="row"><?php _e( 'Enable Webfonts', 'kobol' ); ?></th>
  					<td>
  						<input id="kobol_webfonts_options[kobol_webfonts_enabled]" name="kobol_webfonts_options[kobol_webfonts_enabled]" type="checkbox" value="1" <?php checked( '1', $options['kobol_webfonts_enabled'] ); ?> />
  						<label class="description" for="kobol_webfonts_options[kobol_webfonts_enabled]"><?php _e( 'Enabled the Google Webfonts Loader', 'kobol' ); ?></label>
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
function kobol_webfonts_validate( $input ) {
  if ( ! isset( $input['kobol_webfonts_enabled'] ) )
  		$input['kobol_webfonts_enabled'] = null;
  	$input['kobol_webfonts_enabled'] = ( $input['kobol_webfonts_enabled'] == 1 ? 1 : 0 );
  	
  	
	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

?>