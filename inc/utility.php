<?php
/**
 * Utility functions for the theme.
 *
 * This file is for custom helper functions.
 * These should not be confused with WordPress template
 * tags. Template tags typically use prefixing, as opposed
 * to Namespaces.
 *
 * @link https://developer.wordpress.org/themes/basics/template-tags/
 * @package ITSATheme\Utility
 */

namespace ITSATheme\Utility;

/**
 * Change slug to title, replacing hyphens with spaces and capitalized
 * first letters.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function slug_to_title( $slug = '' ) {
	$title = '';

	if ( \is_string( $slug ) ) {
		$title = \str_replace( '-', ' ', $slug );
		$title = \ucwords( $title );
	}

	return $title;
}

/**
 * Fetch current post ID whie in block
 *
 */
function get_acf_post_id() {
	if ( function_exists( 'acf_maybe_get_POST' ) ) {
		return intval( acf_maybe_get_POST( 'post_id' ) );
	} else {
		global $post;
		return $post->ID;
	}
}

/**
 * Recursively search block array for given blocks.
 *
 * @link https://www.billerickson.net/building-a-header-block-in-wordpress/
 *
 * @param string $blockname
 * @param WP_POST $the_post
 * @param array $blocks
 * @return bool
 */
function has_block( $blockname = '', $the_post = null, $blocks = [] ) {
	global $post;
	if ( empty( $the_post ) ) {
		$the_post = $post;
	}

	if ( empty( $blocks ) ) {
		$blocks = parse_blocks( $the_post->post_content );
	}

	foreach ( $blocks as $block ) {

		if ( ! isset( $block['blockName'] ) ) {
			continue;
		}

		if ( $blockname === $block['blockName'] ) {
			return true;
		} elseif ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
			// Scan inner blocks
			$inner_block = has_block( $blockname, null, $block['innerBlocks'] );
			if ( $inner_block ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Get first matching block from array of blocks.
 *
 * @param string $blockname
 * @param WP_POST $the_post
 * @param array $blocks
 * @return array|null
 */
function get_block( $blockname = '', $the_post = null, $blocks = [] ) {
	global $post;

	if ( empty( $the_post ) ) {
		$the_post = $post;
	}

	if ( empty( $blocks ) ) {
		$blocks = parse_blocks( $the_post->post_content );
	}

	foreach ( $blocks as $block ) {

		if ( ! isset( $block['blockName'] ) ) {
			continue;
		}

		if ( $blockname === $block['blockName'] ) {
			return $block;
		} elseif ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
			// Scan inner blocks
			$inner_block = get_block( $blockname, null, $block['innerBlocks'] );
			if ( ! empty( $inner_block ) && isset( $inner_block ) ) {
				return $inner_block;
			}
		}
	}

	return null;
}

/**
 * Get header image ID from acf/header block.
 *
 * @param array  $block
 * @return array
 */
function get_header_image_id( $block ) {

	if ( 'acf/header' !== $block['blockName'] ) {
		return null;
	}

	if ( ! empty( $block['attrs']['data']['image'] ) && isset( $block['attrs']['data']['image'] ) ) {
		return $block['attrs']['data']['image'];
	}

	return null;
}

/**
 * Get header image URL from post.
 *
 * @param  WP_POST $the_post
 * @return array
 */
function get_header_image_url( $the_post = null, $size = 'itsa-section-background' ) {
	global $post;
	if ( empty( $the_post ) ) {
		$the_post = $post;
	}

	$url   = '';
	$block = get_block( 'acf/header', $the_post );

	if ( ! empty( $block ) && isset( $block ) ) {
		$image_id = get_header_image_id( $block );

		if ( is_int( $image_id ) ) {
			$image_array = \wp_get_attachment_image_src( $image_id, $size );
		}

		if ( ! empty( $image_array ) && isset( $image_array ) ) {
			$url = $image_array[0];
		}
	}

	return $url;
}

/**
 * Extract colors from a CSS or Sass file
 *
 * @param string $path the path to your CSS variables file
 */
function get_colors( $path ) {

	$dir = get_stylesheet_directory();

	if ( file_exists( $dir . $path ) ) {
		$css_vars = file_get_contents( $dir . $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
		preg_match_all( ' /#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $css_vars, $matches );
		return $matches[0];
	}

}

/**
 * Adjust the brightness of a color (HEX)
 *
 * @param string $hex The hex code for the color
 * @param number $steps amount you want to change the brightness
 * @return string new color with brightness adjusted
 */
function adjust_brightness( $hex, $steps ) {

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( 3 === strlen( $hex ) ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;

}

/**
 * Return the Twitter sharing URL for a post
 *
 * @param  WP_POST $the_post
 * @return string url
 */
function get_twitter_share_url( $the_post = null ) {
	global $post;
	if ( empty( $the_post ) ) {
		$the_post = $post;
	}

	$permalink = get_the_permalink( $the_post->ID );
	$the_title = get_the_title( $the_post->ID );
	$handle    = get_theme_mod( 'twitter_handle' );

	return 'https://twitter.com/intent/tweet?text=' . rawurlencode( $the_title ) . '&url=' . $permalink . '&via=' . $handle;
}

/**
 * Return the Facebook sharing URL for a post
 *
 * @param  WP_POST $the_post
 * @return string url
 */
function get_facebook_share_url( $the_post = null ) {
	global $post;
	if ( empty( $the_post ) ) {
		$the_post = $post;
	}

	$permalink = get_the_permalink( $the_post->ID );
	$the_title = get_the_title( $the_post->ID );
	$handle    = get_theme_mod( 'facebook_url' );

	return 'http://www.facebook.com/sharer.php?&u=' . $permalink;
}
