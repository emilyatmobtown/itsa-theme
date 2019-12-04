<?php
/**
 * Gutenberg Blocks setup
 *
 * @package ITSATheme\Blocks
 */

namespace ITSATheme\Blocks;

/**
 * Set up blocks
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'enqueue_block_assets', $n( 'blocks_scripts' ) );
	add_action( 'enqueue_block_editor_assets', $n( 'blocks_editor_scripts' ) );

	add_filter( 'block_categories', $n( 'blocks_categories' ), 10, 2 );

	add_action( 'acf/init', $n( 'register_blocks' ) );

	add_action( 'init', $n( 'remove_block_styles' ) );
}

/**
 * Remove Core Block Styles
 *
 * @return void
 */
function remove_block_styles() {
	register_block_type(
		'remove/block-style',
		array( 'editor_script' => 'admin' )
	);
}

/**
 * Register Blocks
 *
 * @link https://www.billerickson.net/building-gutenberg-block-acf/#register-block
 * @return void
 */
function register_blocks() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'quotes',
			// translators: This is the name of the Quote block.
			'title'           => __( 'Quote Block', 'itsa-theme' ),
			'render_template' => 'partials/block-quotes-slider.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'admin-users',
			'mode'            => 'auto',
			'keywords'        => array( 'testimonial', 'quote' ),
		)
	);
}

/**
 * Enqueue shared frontend and editor JavaScript for blocks.
 *
 * @return void
 */
function blocks_scripts() {

	wp_enqueue_script(
		'blocks',
		ITSA_THEME_TEMPLATE_URL . '/dist/js/blocks.js',
		[],
		ITSA_THEME_VERSION,
		true
	);
}


/**
 * Enqueue editor-only JavaScript/CSS for blocks.
 *
 * @return void
 */
function blocks_editor_scripts() {

	wp_enqueue_script(
		'blocks-editor',
		ITSA_THEME_TEMPLATE_URL . '/dist/js/blocks-editor.js',
		[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components' ],
		ITSA_THEME_VERSION,
		false
	);

	wp_enqueue_style(
		'editor-style',
		ITSA_THEME_TEMPLATE_URL . '/dist/css/editor-style.css',
		[],
		ITSA_THEME_VERSION
	);

}

/**
 * Filters the registered block categories.
 *
 * @param array  $categories Registered categories.
 * @param object $post       The post object.
 *
 * @return array Filtered categories.
 */
function blocks_categories( $categories, $post ) {
	// if ( ! in_array( $post->post_type, array( 'post', 'page' ), true ) ) {
	// 	return $categories;
	// }
	//
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'itsa-blocks',
				'title' => __( 'ITSA Custom Blocks', 'itsa-theme' ),
			),
		)
	);
}
