<?php
/**
 * ITSA Theme constants and setup functions
 *
 * Version:             0.1.0
 * Requires at least:   5.3
 * Requires PHP:        7.3
 * Text Domain:         itsa-theme
 * Domain Path:         /languages
 *
 * @package ITSATheme
 */

namespace ITSATheme;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Nope!' );
}

// Useful global constants.
define( 'ITSA_THEME_VERSION', '0.1.0' );
define( 'ITSA_THEME_TEMPLATE_URL', get_template_directory_uri() );
define( 'ITSA_THEME_PATH', get_template_directory() . '/' );
define( 'ITSA_THEME_INC', ITSA_THEME_PATH . 'inc/' );

require_once ITSA_THEME_INC . 'core.php';
require_once ITSA_THEME_INC . 'overrides.php';
require_once ITSA_THEME_INC . 'template-tags.php';
require_once ITSA_THEME_INC . 'utility.php';
require_once ITSA_THEME_INC . 'blocks.php';

// Run the setup functions.
ITSATheme\Core\setup();
ITSATheme\Blocks\setup();

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for the the new wp_body_open() function that was added in 5.2
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
