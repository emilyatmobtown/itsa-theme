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
	add_action( 'acf/init', $n( 'register_blocks' ) );
	add_action( 'init', $n( 'remove_block_styles' ) );

	add_filter( 'block_categories', $n( 'blocks_categories' ), 10, 2 );
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
			'name'            => 'tweets',
			// translators: This is the name of the Tweets block.
			'title'           => __( 'Tweets', 'itsa-theme' ),
			'render_template' => 'partials/block-tweets.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'twitter',
			'mode'            => 'auto',
			'keywords'        => array( 'twitter', 'social', 'tweet' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'call-to-action',
			// translators: This is the name of the Call to Action block.
			'title'           => __( 'Call to Action Block', 'itsa-theme' ),
			'render_template' => 'partials/block-call-to-action.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'thumbs-up',
			'mode'            => 'auto',
			'keywords'        => array( 'call to action', 'membership', 'jobs' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'content-grid',
			// translators: This is the name of the Content Grid block.
			'title'           => __( 'Content Grid', 'itsa-theme' ),
			'render_template' => 'partials/block-content-grid.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'screenoptions',
			'mode'            => 'auto',
			'keywords'        => array( 'content', 'blocks', 'row' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'featured-event-block',
			// translators: This is the name of the Featured Event block.
			'title'           => __( 'Featured Event Block', 'itsa-theme' ),
			'render_template' => 'partials/block-featured-event.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'calendar-alt',
			'mode'            => 'auto',
			'keywords'        => array( 'event', 'calendar', 'coming up' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'featured-post-grid',
			// translators: This is the name of the Featured Post Grid block.
			'title'           => __( 'Featured Post Grid', 'itsa-theme' ),
			'render_template' => 'partials/block-featured-post-grid.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'align-left',
			'mode'            => 'auto',
			'keywords'        => array( 'posts', 'featured', 'row' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'header',
			// translators: This is the name of the Header block.
			'title'           => __( 'Header Block', 'itsa-theme' ),
			'render_template' => 'partials/block-header.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'format-image',
			'mode'            => 'auto',
			'keywords'        => array( 'hero', 'banner', 'heading' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'member-logos',
			// translators: This is the name of the Member Logo block.
			'title'           => __( 'Member Logo Block', 'itsa-theme' ),
			'render_template' => 'partials/block-member-logos.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'images-alt2',
			'mode'            => 'auto',
			'keywords'        => array( 'members', 'logos' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'partner-info',
			// translators: This is the name of the Partner Info block.
			'title'           => __( 'Partner Info Block', 'itsa-theme' ),
			'render_template' => 'partials/block-partner-info.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'images-alt2',
			'mode'            => 'auto',
			'keywords'        => array( 'partners', 'coalition', 'alliance' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'post-archive',
			// translators: This is the name of the Post Grid block.
			'title'           => __( 'Post Archive', 'itsa-theme' ),
			'render_template' => 'partials/block-post-archive.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'screenoptions',
			'mode'            => 'auto',
			'keywords'        => array( 'posts', 'archive', 'list' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'post-grid',
			// translators: This is the name of the Post Grid block.
			'title'           => __( 'Post Grid', 'itsa-theme' ),
			'render_template' => 'partials/block-post-grid.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'screenoptions',
			'mode'            => 'auto',
			'keywords'        => array( 'posts', 'issues', 'row' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'post-slider',
			// translators: This is the name of the Post Slider block.
			'title'           => __( 'Post Slider', 'itsa-theme' ),
			'render_template' => 'partials/block-post-slider.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'slides',
			'mode'            => 'auto',
			'keywords'        => array( 'posts', 'issues', 'priorities' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'quotes',
			// translators: This is the name of the Quote block.
			'title'           => __( 'Quote Block', 'itsa-theme' ),
			'render_template' => 'partials/block-quotes-slider.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'editor-quote',
			'mode'            => 'auto',
			'keywords'        => array( 'testimonial', 'quote' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
				'inserter'        => false,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'priority',
			// translators: This is the name of the Priority block.
			'title'           => __( 'Priority Block', 'itsa-theme' ),
			'render_template' => 'partials/block-priority.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'star-filled',
			'mode'            => 'auto',
			'keywords'        => array(),
			'post_types'      => array( 'priority' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
				'inserter'        => false,
			),
		)
	);

	acf_register_block_type(
		array(
			'name'            => 'priority-slider',
			// translators: This is the name of the Priority Slider block.
			'title'           => __( 'Priority Slider Block', 'itsa-theme' ),
			'render_template' => 'partials/block-priority-slider.php',
			'category'        => 'itsa-blocks',
			'icon'            => 'star-filled',
			'mode'            => 'auto',
			'keywords'        => array( 'slider', 'priority' ),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'html'            => false,
				'anchor'          => true,
			),
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
 * Add editor styles to editor.
 *
 * @return void
 */
function add_editor_styles() {
	add_editor_style( ITSA_THEME_TEMPLATE_URL . '/dist/css/editor-style.css' );
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

	return array_merge(
		array(
			array(
				'slug'  => 'itsa-blocks',
				'title' => __( 'ITSA Custom Blocks', 'itsa-theme' ),
			),
		),
		$categories
	);
}
