<?php
/**
 * Template part for displaying the Header block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$the_id    = get_the_ID() ? get_the_ID() : Utility\get_acf_post_id();
$the_title = get_field( 'title' );
// if ( empty( $the_title ) ) {
// 	$the_wp_title = get_the_title( $the_id );
// 	if ( empty( $the_wp_title ) && is_admin() ) {
// 		$the_title = '';
// 	} else {
// 		$the_title = $the_wp_title;
// 	}
// }
//
$tagline     = get_field( 'tagline' );
$image       = get_field( 'image' );
$header_type = 'header-block-' . get_post_type( $the_id );
$block_style = empty( $image ) ? $header_type : $header_type . ' wp-block-cover has-background has-background-dim inverse-color';
$row_style   = empty( $image ) ? 'max-width' : 'full-width';
$button_text = get_field( 'button_text' );
$url         = get_field( 'button_page_link' );
$url         = empty( $url ) ? get_field( 'button_external_url' ) : $url;
$external    = empty( $url ) ? false : true;

if ( is_admin() && empty( $the_title ) ) {
	?>
	<h1 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Header with Title..." contenteditable="false"></span></h1>
	<?php
} elseif ( ! empty( $the_title ) && isset( $the_title ) ) {
	?>

	<div class="row <?php echo esc_attr( $row_style ); ?>">
		<header class="section block header-block <?php echo esc_attr( $block_style ); ?>" style="background-image:url(<?php echo esc_url( $image['sizes']['itsa-header'] ); ?>)">
			<div class="section-content full-width">
				<?php if ( is_home( $the_id ) || is_front_page( $the_id ) ) { ?>
					<h2 class="entry-title item-title has-text-color"><span class="highlight-primary"><?php echo esc_attr( $the_title ); ?></span></h2>
				<?php } elseif ( ! empty( $image ) ) { ?>
					<h1 class="entry-title item-title has-text-color"><span class="highlight-primary"><?php echo esc_attr( $the_title ); ?></span></h1>
				<?php } else { ?>
					<h1 class="entry-title item-title has-text-color"><?php echo esc_attr( $the_title ); ?></h1>
				<?php } ?>
				<?php if ( ! empty( $tagline ) ) { ?>
					<span class="tagline"><?php echo esc_attr( $tagline ); ?></span>
					<hr class="hrule">
				<?php } ?>
				<?php if ( ! empty( $button_text ) && ! empty( $url ) ) { ?>
					<a class="block-area-button-link" href="<?php echo esc_url( $url ); ?>" <?php echo $external ? 'target="_blank"' : ''; ?>><button class="block-area-button button-arrow-right"><?php echo esc_attr( $button_text ); ?></button></a>
				<?php } ?>
			</div><!-- .section-content -->
		</header><!-- .section -->
	</div><!-- . row -->
	<?php
}
