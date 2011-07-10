<?php


add_action( 'admin_init', 'kobol_webfonts_init' );
add_action( 'admin_menu', 'kobol_webfonts_add_page' );

/**
 * Init plugin options to white list our options
 */
function kobol_webfonts_init(){
	register_setting( 'kobol_options', 'kobol_webfonts_options', 'kobol_webfonts_validate' );
}

/**
 * Load up the menu page
 */
function kobol_webfonts_add_page() {
	add_theme_page( __( 'Webfonts', 'kobol' ), __( 'Webfonts', 'kobol' ), 'edit_theme_options', 'kobol_webfonts', 'kobol_webfonts_do_page' );
}


/**
 * Create arrays for our select and radio options
 */
$kobol_header_options = array(
	'static' => array(
		'value' => 'static',
		'label' => __( 'Static Image', 'kobol' )
	),
	'widget' => array(
		'value' => 'widget',
		'label' => __( 'Widget Header', 'kobol' )
	),
	'none' => array(
		'value' => 'none',
		'label' => __( 'None', 'kobol' )
	)
);

$kobol_header_display = array(
	'all' => array(
		'value' => 'all',
		'label' => __( 'All pages', 'kobol' )
	),
	'homepage' => array(
		'value' => 'homepage',
		'label' => __( 'Only on home page', 'kobol' )
	)
);

$kobol_sticky_menu_options = array(
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
function kobol_webfonts_do_page() {
	global $kobol_sticky_menu_options, 
	  $kobol_header_options,
	  $kobol_header_display;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
			<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Webfont Options', 'kobol' ) . "</h2>"; ?>
	
			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'kobol' ); ?></strong></p></div>
			<?php endif; ?>
	
			<form method="post" action="options.php">
				<?php settings_fields( 'kobol_options' ); ?>
				<?php $options = get_option( 'kobol_webfonts_options' ); ?>
	
				<table class="form-table">
				  <?php
  				/**
  				 * Display options for header
  				 */
  				?>
  				<tr valign="top"><th scope="row"><?php _e( 'Start Here', 'kobol' ); ?></th>
  					<td>
  						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Start Here', 'kobol' ); ?></span></legend>
  						<?php
  							if ( ! isset( $checked ) )
  								$checked = '';
  							foreach ( $kobol_header_options as $option ) {
  								$radio_setting = $options['kobol_header_options'];
  
  								if ( '' != $kobol_header_options ) {
  									if ( $options['kobol_header_options'] == $option['value'] ) {
  										$checked = "checked=\"checked\"";
  									} else {
  										$checked = '';
  									}
  								}
  								?>
  								<label class="description"><input type="radio" name="kobol_webfonts_options[kobol_header_options]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
  								<?php
  							}
  						?>
  						</fieldset>
  					</td>
  				</tr>	
          
          <?php
          /**
  				 * Display options for header
  				 */
  				?>
  				<tr valign="top"><th scope="row"><?php _e( 'Header Display', 'kobol' ); ?></th>
  					<td>
  						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Header Display', 'kobol' ); ?></span></legend>
  						<?php
  							if ( ! isset( $checked ) )
  								$checked = '';
  							foreach ( $kobol_header_display as $option ) {
  								$radio_setting = $options['kobol_header_display'];
  
  								if ( '' != $kobol_header_display ) {
  									if ( $options['kobol_header_display'] == $option['value'] ) {
  										$checked = "checked=\"checked\"";
  									} else {
  										$checked = '';
  									}
  								}
  								?>
  								<label class="description"><input type="radio" name="kobol_webfonts_options[kobol_header_display]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
  								<?php
  							}
  						?>
  						</fieldset>
  					</td>
  				</tr>	
				
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
								foreach ( $kobol_sticky_menu_options as $option ) {
									$radio_setting = $options['kobol_sticky_menu_options'];
	
									if ( '' != $kobol_sticky_menu_options ) {
										if ( $options['kobol_sticky_menu_options'] == $option['value'] ) {
											$checked = "checked=\"checked\"";
										} else {
											$checked = '';
										}
									}
									?>
									<label class="description"><input type="radio" name="kobol_webfonts_options[kobol_sticky_menu_options]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
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
function kobol_webfonts_validate( $input ) {
	global $kobol_sticky_menu_options, 
	  $kobol_header_options,
	  $kobol_header_display;

  // Header Options
  if ( ! isset( $input['kobol_header_options'] ) )
  	$input['kobol_header_options'] = null;
  if ( ! array_key_exists( $input['kobol_header_options'], $kobol_header_options ) )
  	$input['kobol_header_options'] = null;
  	
  // Header Display
  if ( ! isset( $input['kobol_header_display'] ) )
  	$input['kobol_header_display'] = null;
  if ( ! array_key_exists( $input['kobol_header_display'], $kobol_header_display ) )
  	$input['kobol_header_display'] = null;

	// Sticky Menu Options
	if ( ! isset( $input['kobol_sticky_menu_options'] ) )
		$input['kobol_sticky_menu_options'] = null;
	if ( ! array_key_exists( $input['kobol_sticky_menu_options'], $kobol_sticky_menu_options ) )
		$input['kobol_sticky_menu_options'] = null;

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

?>