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
 * Create Logo Setting and Upload Control
 *
 * @since 0.1.0
 */
function add_customizer_settings( $wp_customize ) {
}
