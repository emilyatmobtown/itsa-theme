<?php
/**
 * Template part for displaying the Call to Action block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$headline      = get_field( 'headline' );
$text          = get_field( 'text' );
$button        = get_field( 'button' );
$button_target = $button['target'] ? $button['target'] : '_self';
$alignment     = get_field( 'alignment' );
$block_style   = get_field( 'block_style' );
$block_style   = empty( $block_style ) ? 'block-style-solid' : $block_style;

if ( is_admin() && ( empty( $headline ) || empty( $text ) ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Call to Action..." contenteditable="false"></span></h2>
	<?php
} elseif ( ! empty( $headline ) || ! empty( $text ) ) {
	?>

	<div class="row max-width">
		<section class="section block call-to-action-block has-background has-overlay inverse-color <?php echo esc_attr( $block_style ); ?> <?php echo esc_attr( $alignment ); ?>">
			<?php if ( ! empty( $headline ) ) { ?>
				<h2 class="font-weight-600"><?php echo esc_attr( $headline ); ?></h2>
			<?php } ?>
			<?php if ( ! empty( $text ) ) { ?>
				<div class="restricted-width"><?php echo wp_kses_post( $text ); ?></div>
			<?php } ?>
			<?php if ( ! empty( $button ) ) { ?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" title="<?php echo esc_attr( $button['title'] ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><button class="has-arrow-right"><?php echo esc_attr( $button['title'] ); ?></button></a>
			<?php } ?>
		</section><!-- .section -->
	</div><!-- .row -->

	<?php
}
