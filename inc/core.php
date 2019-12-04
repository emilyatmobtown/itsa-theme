<?php
/**
 * Core setup, site hooks and filters.
 *
 * @package ITSATheme\Core
 */

namespace ITSATheme\Core;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'after_setup_theme', $n( 'i18n' ) );
	add_action( 'after_setup_theme', $n( 'theme_setup' ) );
	add_action( 'widgets_init', $n( 'register_sidebars' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
	add_action( 'admin_enqueue_scripts', $n( 'admin_scripts' ) );
	add_action( 'admin_enqueue_scripts', $n( 'admin_styles' ) );
	add_action( 'wp_head', $n( 'js_detection' ), 0 );
	add_action( 'wp_head', $n( 'add_manifest' ), 10 );

	add_filter( 'script_loader_tag', $n( 'script_loader_tag' ), 10, 2 );
}

/**
 * Makes Theme available for translation.
 *
 * Translations can be added to the /languages directory.
 * If you're building a theme based on "sample-theme", change the
 * filename of '/languages/SampleTheme.pot' to the name of your project.
 *
 * @return void
 */
function i18n() {
	load_theme_textdomain( 'itsa-theme', ITSA_THEME_PATH . '/languages' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function theme_setup() {
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-formats', array( 'quote' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'gallery',
		)
	);
	add_theme_support( 'disable-custom-colors' );
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Blue', 'itsa-theme' ),
				'slug'  => 'blue',
				'color' => '#001940',
			),
			array(
				'name'  => __( 'Dark Blue', 'itsa-theme' ),
				'slug'  => 'dark-blue',
				'color' => '#001333',
			),
			array(
				'name'  => __( 'Teal', 'itsa-theme' ),
				'slug'  => 'teal',
				'color' => '#51cfd9',
			),
			array(
				'name'  => __( 'Dark Teal', 'itsa-theme' ),
				'slug'  => 'dark-teal',
				'color' => '#36a5ae',
			),
			array(
				'name'  => __( 'White', 'itsa-theme' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Black', 'itsa-theme' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
		)
	);

	$logo_defaults = array(
		'height'      => 36,
		'width'       => 183,
		'flex-height' => true,
		'flex-width'  => true,
	);
	add_theme_support( 'custom-logo', $logo_defaults );

	register_nav_menus(
		array(
			// translators: This is the name of the primary menu used in the theme.
			'primary'  => __( 'Primary Menu', 'itsa-theme' ),
			// translators: This is the name of the first footer menu used in the theme.
			'footer-1' => __( 'Footer Menu 1', 'itsa-theme' ),
			// translators: This is the name of the second footer menu used in the theme.
			'footer-2' => __( 'Footer Menu 2', 'itsa-theme' ),
			// translators: This is the name of the third footer menu used in the theme.
			'footer-3' => __( 'Footer Menu 3', 'itsa-theme' ),
		)
	);
}

/**
 * Register sidebars
 *
 * @return void
 */
function register_sidebars() {
	$sidebars = array(
		array(
			// translators: This is the name of the first footer column used in the theme.
			'name'        => __( 'Footer Column 1', 'itsa-theme' ),
			'id'          => 'footer-column-1',
			// translators: This is the description of the first footer column used in the theme.
			'description' => __( 'Widgets shown in this area appear in the first column of footer.', 'itsa-theme' ),
		),
		array(
			// translators: This is the name of the second footer column used in the theme.
			'name'        => __( 'Footer Column 2', 'itsa-theme' ),
			'id'          => 'footer-column-2',
			// translators: This is the description of the second footer column used in the theme.
			'description' => __( 'Widgets shown in this area appear in the second column of footer.', 'itsa-theme' ),
		),
		array(
			// translators: This is the name of the third footer column used in the theme.
			'name'        => __( 'Footer Column 3', 'itsa-theme' ),
			'id'          => 'footer-column-3',
			// translators: This is the description of the third footer column used in the theme.
			'description' => __( 'Widgets shown in this area appear in the third column of footer.', 'itsa-theme' ),
		),
		array(
			// translators: This is the name of the fourth footer column used in the theme.
			'name'        => __( 'Footer Column 4', 'itsa-theme' ),
			'id'          => 'footer-column-4',
			// translators: This is the description of the fourth footer column used in the theme.
			'description' => __( 'Widgets shown in this area appear in the fourth column of footer.', 'itsa-theme' ),
		),
		array(
			// translators: This is the name of the fifth footer column used in the theme.
			'name'        => __( 'Footer Column 5', 'itsa-theme' ),
			'id'          => 'footer-column-5',
			// translators: This is the description of the fifth footer column used in the theme.
			'description' => __( 'Widgets shown in this area appear in the fifth column of footer.', 'itsa-theme' ),
		),
	);

	$defaults = array(
		'name'          => 'ITSA Sidebar',
		'id'            => 'itsa-sidebar',
		'description'   => 'This is a generic sidebar.',
		'class'         => '',
		'before_widget' => '<div class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer-title">',
		'after_title'   => '</h2>',
	);

	foreach ( $sidebars as $sidebar ) {
		$args = wp_parse_args( $sidebar, $defaults );
		register_sidebar( $args );
	}
}

/**
 * Enqueue scripts for front-end.
 *
 * @return void
 */
function scripts() {

	wp_enqueue_script(
		'frontend',
		ITSA_THEME_TEMPLATE_URL . '/dist/js/frontend.js',
		[],
		ITSA_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'shared',
		ITSA_THEME_TEMPLATE_URL . '/dist/js/shared.js',
		array( 'jquery' ),
		ITSA_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'glide',
		ITSA_THEME_TEMPLATE_URL . '/dist/vendor/glide.min.js',
		[],
		ITSA_THEME_VERSION,
		true
	);

	if ( is_page_template( 'templates/page-styleguide.php' ) ) {
		wp_enqueue_script(
			'styleguide',
			ITSA_THEME_TEMPLATE_URL . '/dist/js/styleguide.js',
			[],
			ITSA_THEME_VERSION,
			true
		);
	}

}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {

	wp_enqueue_style(
		'styles',
		ITSA_THEME_TEMPLATE_URL . '/dist/css/style.css',
		[],
		ITSA_THEME_VERSION
	);

	wp_enqueue_style(
		'glide-styles',
		ITSA_THEME_TEMPLATE_URL . '/dist/vendor/glide.core.min.css',
		[],
		ITSA_THEME_VERSION
	);

	if ( is_page_template( 'templates/page-styleguide.php' ) ) {
		wp_enqueue_style(
			'styleguide',
			ITSA_THEME_TEMPLATE_URL . '/dist/css/styleguide-style.css',
			[],
			ITSA_THEME_VERSION
		);
	}
}

/**
 * Enqueue scripts for admin.
 *
 * @since 0.1.0
 */
function admin_scripts() {
	wp_enqueue_script(
		'admin',
		ITSA_THEME_TEMPLATE_URL . '/dist/js/admin.js',
		array( 'wp-blocks', 'wp-edit-post' ),
		ITSA_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'glide',
		ITSA_THEME_TEMPLATE_URL . '/dist/vendor/glide.min.js',
		[],
		ITSA_THEME_VERSION,
		true
	);
}

/**
 * Enqueue styles for admin.
 *
 * @since 0.1.0
 */
function admin_styles() {
	wp_enqueue_style(
		'glide-styles',
		ITSA_THEME_TEMPLATE_URL . '/dist/vendor/glide.core.min.css',
		[],
		ITSA_THEME_VERSION
	);
}

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @return void
 */
function js_detection() {

	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

/**
 * Add async/defer attributes to enqueued scripts that have the specified script_execution flag.
 *
 * @link https://core.trac.wordpress.org/ticket/12009
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function script_loader_tag( $tag, $handle ) {
	$script_execution = wp_scripts()->get_data( $handle, 'script_execution' );

	if ( ! $script_execution ) {
		return $tag;
	}

	if ( 'async' !== $script_execution && 'defer' !== $script_execution ) {
		return $tag;
	}

	// Abort adding async/defer for scripts that have this script as a dependency. _doing_it_wrong()?
	foreach ( wp_scripts()->registered as $script ) {
		if ( in_array( $handle, $script->deps, true ) ) {
			return $tag;
		}
	}

	// Add the attribute if it hasn't already been added.
	if ( ! preg_match( ":\s$script_execution(=|>|\s):", $tag ) ) {
		$tag = preg_replace( ':(?=></script>):', " $script_execution", $tag, 1 );
	}

	return $tag;
}

/**
 * Appends a link tag used to add a manifest.json to the head
 *
 * @return void
 */
function add_manifest() {
	echo "<link rel='manifest' href='" . esc_url( ITSA_THEME_TEMPLATE_URL . '/manifest.json' ) . "' />";
}
