<?php
/**
 * This file contains functions related to the Customizer.
 *
 * @package ITSATheme
 */

namespace ITSATheme\Customizer;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Nope!' );
}

/**
 * Get Customizer started
 *
 * @since 0.1.0
 */
function setup() {
	add_action( 'customize_register', __NAMESPACE__ . '\add_customizer_settings' );
}

/**
 * Create Customizer Settings
 *
 * @since 0.1.0
 */
function add_customizer_settings( $wp_customize ) {

	$wp_customize->add_section(
		'itsa_social',
		array(
			'title'    => __( 'Social', 'itsa-theme' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'twitter_handle',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'twitter_handle',
		array(
			'label'   => __( 'Twitter Handle', 'itsa-theme' ),
			'section' => 'itsa_social',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'instagram_handle',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'instagram_handle',
		array(
			'label'   => __( 'Instagram Handle', 'itsa-theme' ),
			'section' => 'itsa_social',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'facebook_url',
		array(
			'default'   => '',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'facebook_url',
		array(
			'label'   => __( 'Facebook URL', 'itsa-theme' ),
			'section' => 'itsa_social',
			'type'    => 'text',
		)
	);
}
