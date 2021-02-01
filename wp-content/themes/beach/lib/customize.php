<?php
/**
 * Genesis Sample.
 *
 * This file adds the Customizer additions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_action( 'customize_register', 'genesis_sample_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_sample_customizer_register( $wp_customize ) {

	$appearance = genesis_get_config( 'appearance' );

	// Socials
	
	// Color Link
	$wp_customize->add_setting(
		'genesis_sample_link_color',
		[
			'default'           => $appearance['default-colors']['link'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_link_color',
			[
				'description' => __( 'Change the color of post info links and button blocks, the hover color of linked titles and menu items, and more.', 'genesis-sample' ),
				'label'       => __( 'Link Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_link_color',
			]
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_accent_color',
		[
			'default'           => $appearance['default-colors']['accent'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_accent_color',
			[
				'description' => __( 'Change the default hover color for button links, menu buttons, and submit buttons. The button block uses the Link Color.', 'genesis-sample' ),
				'label'       => __( 'Accent Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_accent_color',
			]
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_logo_width',
		[
			'default'           => 350,
			'sanitize_callback' => 'absint',
			'validate_callback' => 'genesis_sample_validate_logo_width',
		]
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'genesis_sample_logo_width',
		[
			'label'       => __( 'Logo Width', 'genesis-sample' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'genesis-sample' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'genesis_sample_logo_width',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 100,
			],

		]
	);

}

/* add settings to create various social media text areas. */
add_action('customize_register', 'my_add_social_sites_customizer');
function my_add_social_sites_customizer($wp_customize) {
	$wp_customize->add_section( 'my_social_settings', array(
	'title'    => __('Social Media Icons', 'text-domain'),
	'priority' => 35,
	) );
	$social_sites = my_customizer_social_media_array();
	$priority = 5;
	foreach($social_sites as $social_site) {
		$wp_customize->add_setting( "$social_site", array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( $social_site, array(
		'label'    => __( "$social_site url:", 'text-domain' ),
		'section'  => 'my_social_settings',
		'type'     => 'text',
		'priority' => $priority,
		) );
		$priority = $priority + 5;
	}

}

//my_social_media_icons() <-- to get the socials
/* takes user input from the customizer and outputs linked social media icons */
function my_social_media_icons() {
	$social_sites = my_customizer_social_media_array();
	/* any inputs that aren't empty are stored in $active_sites array */
	foreach($social_sites as $social_site) {
		if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
		$active_sites[] = $social_site;
		}
	}
	/* for each active social site, add it as a list item */
	if ( ! empty( $active_sites ) ) {
		echo "<ul class='social-media-icons'>";
		foreach ( $active_sites as $active_site ) {
			/* setup the class */
			$class = 'fab fa-' . $active_site;
			if ( $active_site == 'email' ) {
			?>
			<li>
			<a class="email" target="_blank" href="mailto:<?php echo antispambot( is_email( get_theme_mod( $active_site ) ) ); ?>">
			<i class="fab fa-envelope" title="<?php _e('email icon', 'text-domain'); ?>"></i>
			</a>
			</li>
			<?php } else { ?>
			<li>
			<a class="<?php echo $active_site; ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $active_site) ); ?>">
			<i class="<?php echo esc_attr( $class ); ?>" title="<?php printf( __('%s icon', 'text-domain'), $active_site ); ?>"></i>
			</a>
			</li>
			<?php
			}
		}
		echo "</ul>";
	}
}


function my_customizer_social_media_array() {
	/* store social site names in array */
	$social_sites = array('twitter', 'facebook', 'google-plus', 'flickr', 'pinterest', 'youtube', 'tumblr', 'dribbble', 'rss', 'linkedin', 'instagram', 'email');
	return $social_sites;
}

/**
 * Displays a message if the entered width is not numeric or greater than 100.
 *
 * @param object $validity The validity status.
 * @param int    $width The width entered by the user.
 * @return int The new width.
 */
function genesis_sample_validate_logo_width( $validity, $width ) {

	if ( empty( $width ) || ! is_numeric( $width ) ) {
		$validity->add( 'required', __( 'You must supply a valid number.', 'genesis-sample' ) );
	} elseif ( $width < 100 ) {
		$validity->add( 'logo_too_small', __( 'The logo width cannot be less than 100.', 'genesis-sample' ) );
	}

	return $validity;

}

//return value echo get_theme_mod( 'footer_text_block');
add_action( 'customize_register', 'genesischild_register_theme_customizer' );
/*
 * Register Our Customizer Stuff Here
 */
function genesischild_register_theme_customizer( $wp_customize ) {

	// Add Footer Text
	// Add section.
	$wp_customize->add_section( 'custom_footer_text' , array(
		'title'    => __('Site Info','genesischild'),
		'priority' => 300
	) );

	// Add setting
	$wp_customize->add_setting( 'phone_number', array(
		'default'           => __( '', 'genesischild' ),
		'sanitize_callback' => 'sanitize_text'
   ) );
   // Add control
   $wp_customize->add_control( new WP_Customize_Control(
	   $wp_customize,
	   'phone_number',
		   array(
			   'label'    => __( 'Phone Number', 'genesischild' ),
			   'section'  => 'custom_footer_text',
			   'settings' => 'phone_number',
			   'type'     => 'text',
			   'priority' => 5,
		   )
	   )
   );

	// Add setting
	$wp_customize->add_setting( 'footer_text_block', array(
		 'default'           => __( '', 'genesischild' ),
		 'sanitize_callback' => 'sanitize_text'
	) );
	// Add control
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'footer_text_block',
		    array(
		        'label'    => __( 'Footer Text', 'genesischild' ),
		        'section'  => 'custom_footer_text',
		        'settings' => 'footer_text_block',
				'type'     => 'textarea',
				'priority' => 10,
		    )
	    )
	);

	

 	// Sanitize text
	function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}
}
