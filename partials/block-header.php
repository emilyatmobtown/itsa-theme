<?php
/**
 * Template part for displaying the Header block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$the_id         = get_the_ID() ? get_the_ID() : Utility\get_acf_post_id();
$the_title      = get_field( 'title' );
$header_type    = get_field( 'header_type' );
$image_url      = '';
$header_content = get_query_var( 'header_content' ) ?? '';

if ( is_admin() && empty( $header_content ) ) {
	$header_content = 'full_header';
}

if ( is_singular( get_post_type() ) ) {
	$header_content = 'full_header';
}

if ( 'default' === $header_type && 'full_header' === $header_content ) {
	$tagline   = get_field( 'tagline' );
	$image     = get_field( 'image' );
	$image_url = ! empty( $image ) ? $image['sizes']['itsa-header'] : '';
	$button    = get_field( 'link' );
} elseif ( 'featured_post' === $header_type && 'full_header' === $header_content ) {
	$featured_posts = get_field( 'featured_post' );
	$featured_post  = $featured_posts[0];
	$image_url      = Utility\get_header_image_url( $featured_post, 'itsa-header' );
}

$header_block_class = 'header-block-' . get_post_type( $the_id );
$block_style        = empty( $image_url ) ? $header_block_class : $header_block_class . ' wp-block-cover has-background has-background-dim inverse-color';
$row_style          = empty( $image_url ) ? 'max-width' : 'full-width';

if ( is_admin() && empty( $the_title ) && empty( $header_type ) ) {
	?>
	<h1 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Header with Title..." contenteditable="false"></span></h1>
	<?php
} elseif ( ! empty( $the_title ) || ! empty( $header_type ) ) {

	// Default to Core title - necessary for standard pages
	if ( empty( $the_title ) ) {
		$the_wp_title = get_the_title( $the_id );
		if ( empty( $the_wp_title ) && is_admin() ) {
			$the_title = '';
		} else {
			$the_title = $the_wp_title;
		}
	}

	?>
	<div class="row <?php echo esc_attr( $row_style ); ?>">
		<header class="section block header-block <?php echo esc_attr( $block_style ); ?>" style="background-image:url(<?php echo esc_url( $image_url ); ?>)">
			<div class="section-content full-width">

				<?php if ( 'featured_post' === $header_type ) { ?>
					<?php if ( ! empty( $image_url ) ) { ?>
						<h1 class="entry-title item-title has-text-color"><span class="highlight-primary"><?php echo esc_attr( $the_title ); ?></span></h1>
					<?php } else { ?>
						<h1 class="entry-title item-title has-text-color"><?php echo esc_attr( $the_title ); ?></h1>
					<?php } ?>
					<?php if ( ! empty( $featured_post ) ) { ?>
						<article id="post-<?php echo esc_attr( $featured_post->ID ); ?>" class="featured-post">
							<?php itsa_the_type_and_term( $featured_post, true ); ?>
							<h2 class="featured-post-title"><?php echo esc_html( $featured_post->post_title ); ?></h2>
							<?php itsa_the_entry_meta( $featured_post ); ?>
							<?php itsa_the_excerpt( null, false, false, $featured_post ); ?>
							<?php itsa_the_post_button( $featured_post ); ?>
						</article>
					<?php } ?>
				<?php } else { ?>
					<?php if ( is_home( $the_id ) || is_front_page( $the_id ) ) { ?>
						<h2 class="entry-title item-title has-text-color"><span class="highlight-primary"><?php echo esc_attr( $the_title ); ?></span></h2>
					<?php } elseif ( ! empty( $image_url ) ) { ?>
						<h1 class="entry-title item-title has-text-color"><span class="highlight-primary"><?php echo esc_attr( $the_title ); ?></span></h1>
					<?php } else { ?>
						<h1 class="entry-title item-title has-text-color"><?php echo esc_attr( $the_title ); ?></h1>
					<?php } ?>
					<?php if ( ! empty( $tagline ) ) { ?>
						<span class="tagline"><?php echo esc_attr( $tagline ); ?></span>
						<hr class="hrule">
					<?php } ?>
					<?php if ( ! empty( $button ) ) { ?>
						<a href="<?php echo esc_url( $button['url'] ); ?>" title="<?php echo esc_url( $button['title'] ); ?>"><button class="has-arrow-right"><?php esc_html_e( 'Learn More', 'itsa-theme' ); ?></button></a>
					<?php } ?>
				<?php } ?>
			</div><!-- .section-content -->
		</header><!-- .section -->
	</div><!-- . row -->
	<?php
}
