<?php
/**
 *Life Theme Customizer
 *
 * @package Life
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function life_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'life_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'life_customize_partial_blogdescription',
			)
		);
	}

	// add subfooter section
	$wp_customize->add_setting(
		'life_subfooter',
		array(
			'default' 			=> 'Copyright 2021',
			'type'				=> 'theme_mod',
			'sanitize_callback' => 'wp_kses_post'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'life_subfooter',
		array(
			'label'	   => __( 'Subfooter', 'life' ),
			'settings' => 'life_subfooter',
			'priority' => 10,
			'section'  => 'title_tagline',
			'type'	   => 'text',
		)
	) );

	// add rss email reply-to field
	$wp_customize->add_setting(
		'life_rss_email',
		array(
			'type'				=> 'theme_mod',
			'sanitize_callback' => 'wp_kses_post'
		)
	);
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'life_rss_email',
		array(
			'label'	   => __( 'Reply Email', 'life' ),
			'description' => __( 'Specify an email address to be added to RSS feed reply-to links. Leave blank to exclude this link.', 'life' ),
			'settings' => 'life_rss_email',
			'priority' => 11,
			'section'  => 'title_tagline',
			'type'	   => 'email',
		)
	) );

	// add custom link color options
	$wp_customize->add_setting( 'link_color', array(
		'default' => '#191919',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label' => __( 'Default Link Color', 'life' ),
		'section' => 'colors',
		'settings' => 'link_color'
	)));
	$wp_customize->add_setting( 'link_color_dark', array(
		'default' => '#e6e6e6',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_dark', array(
		'label' => __( 'Dark Mode Link Color', 'life' ),
		'section' => 'colors',
		'settings' => 'link_color_dark'
	)));
}
add_action( 'customize_register', 'life_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function life_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function life_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function life_customize_preview_js() {
	wp_enqueue_script( 'life-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), life_VERSION, true );
}
add_action( 'customize_preview_init', 'life_customize_preview_js' );