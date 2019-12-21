<?php
/**
 * Custom template tags for ITSA theme.
 *
 * This file is for custom template tags only and it should not contain
 * functions that will be used for filtering or adding an action.
 *
 * All functions should be prefixed with "itsa" in order to prevent
 * pollution of the global namespace and potential conflicts with functions
 * from plugins.
 *
 * @package ITSATheme\Template_Tags
 *
 */

use ITSATheme\Utility;

/**
 * Get HTML for social share
 *
 * @return string
 * @since 0.1.0
 */
function itsa_get_social_share() {
	$html = '<div class="entry-meta-social inverse-color">
				<span class="entry-meta-text">' . __( 'Share', 'itsa-theme' ) . '</span>
				<a class="icon social-icon twitter-icon" href="#"><span class="screen-reader-text">' . __( 'Twitter', 'itsa-theme' ) . '</span></a>
				<a class="icon social-icon facebook-icon" href="#"><span class="screen-reader-text">' . __( 'Facebook', 'itsa-theme' ) . '</span></a>
				<a class="icon social-icon instagram-icon" href="#"><span class="screen-reader-text">' . __( 'Instagram', 'itsa-theme' ) . '</span></a>
			</div><!-- .entry-meta-social -->';
	return $html;
}

/**
 * Display HTML for social share
 *
 * @return string
 * @since 0.1.0
 */
function itsa_the_social_share() {
	echo wp_kses_post( itsa_get_social_share() );
}

/**
 * Get HTML for post meta
 *
 * @return string
 * @since 0.1.0
 */
function itsa_get_entry_meta() {
	global $post;
	$posttype = get_post_type( $post->ID );

	$html = '<div class="row max-width">
				<div class="entry-meta">';

	if ( is_singular( $posttype ) ) {
		$html .= '<span class="entry-meta-text">' . itsa_get_post_type_plural_label( $posttype ) . '</span>';
	}

	if ( has_term( '', 'issue', $post ) && is_singular( $posttype ) ) {
		$html .= '<div class="entry-meta-text">
					<span>' . __( 'Issues', 'itsa-theme' ) . ': </span>';
		$html .= get_the_term_list( $post->ID, 'issue', '<ul class="entry-categories"><li class="entry-category" rel="category tag">', ', </li><li class="entry-category">', '</li></ul>' );
		$html .= '</div><!-- .entry-meta-text -->';
	}

	if ( 'news' === $posttype ) {
		$html .= '<time class="entry-meta-text" datetime="' . get_the_date( 'c', $post->ID ) . '"  itemprop="datePublished">' . get_the_date( '', $post->ID ) . '</time>';
	}

	$html .= '</div><!-- .entry-meta -->
			</div><!-- .row -->';

	return $html;
}

/**
 * Display HTML for post meta
 *
 * @return string
 * @since 0.1.0
 */
function itsa_the_entry_meta() {
	echo wp_kses_post( itsa_get_entry_meta() );
}

/**
 * Get HTML for post excerpt. If not excerpt exists, then extract excerpt from
 * the first paragraph block. Optionally, include the header if there's a
 * header block;
 *
 * @return string
 * @since 0.1.0
 */
function itsa_get_excerpt( $length, $with_title = false, $with_entry_meta = false ) {
	global $post;

	if ( empty( $length ) ) {
		$length = 240;
	}

	$excerpt     = '';
	$has_excerpt = has_excerpt( $post->ID );

	// Only parse blocks if we need to
	if ( $has_excerpt || $with_title ) {
		$blocks = parse_blocks( $post->post_content );
	}

	if ( $with_title ) {
		$header_block = Utility\get_block( $blocks, 'acf/header' );

		if ( ! empty( $header_block ) && isset( $header_block ) ) {
			$excerpt .= render_block( $header_block );
		}
	}

	if ( $with_entry_meta ) {
		$excerpt .= itsa_get_entry_meta();
	}

	if ( false === $has_excerpt ) {
		$paragraph_block = Utility\get_block( $blocks, 'core/paragraph' );

		if ( ! empty( $paragraph_block ) && isset( $paragraph_block ) ) {
			// Render paragraph block
			$paragraph = render_block( $paragraph_block );

			// Strip HTML tags
			$text = wp_strip_all_tags( $paragraph );

			// Cut string at limit + 1
			$text = substr( $text, 0, $length + 1 );

			// Drop any cut-off words
			$text     = substr( $text, 0, strrpos( $text, ' ' ) );
			$excerpt .= '<p>' . $text . '&hellip;</p>';
		}
	} else {
		$excerpt .= '<p>' . get_the_excerpt( $post->ID ) . '</p>';
	}

	return $excerpt;
}

/**
* Display HTML for post excerpt using first paragraph block. Optionally, include
* the title if there's a header block;
 *
 * @return string
 * @since 0.1.0
 */
function itsa_the_excerpt( $length, $with_title = false, $with_entry_meta = false ) {
	echo wp_kses_post( itsa_get_excerpt( $length, $with_title, $with_entry_meta ) );
}

/**
 * Get singular label for post type.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_post_type_singular_label( $posttype = '' ) {
	if ( ! empty( $posttype ) && post_type_exists( $posttype ) ) {
		$object = get_post_type_object( $posttype );
		return $object->labels->singular_name;
	}
}

/**
 * Get plural label for post type.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_post_type_plural_label( $posttype = '' ) {
	if ( ! empty( $posttype ) && post_type_exists( $posttype ) ) {
		$object = get_post_type_object( $posttype );
		return $object->labels->name;
	}
}

/**
 * Get singular label for taxonomy.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_tax_singular_label( $tax = '' ) {
	if ( ! empty( $tax ) && taxonomy_exists( $tax ) ) {
		$object = get_taxonomy( $tax );
		return $object->labels->singular_name;
	}
}

/**
 * Get plural label for taxonomy.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_tax_plural_label( $tax = '' ) {
	if ( ! empty( $tax ) && taxonomy_exists( $tax ) ) {
		$object = get_taxonomy( $tax );
		return $object->labels->name;
	}
}
