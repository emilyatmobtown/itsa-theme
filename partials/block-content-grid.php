<?php
/**
 * Template part for displaying the Post Grid block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */


if ( is_admin() && ! have_rows( 'content_blocks' ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Content Grid..." contenteditable="false"></span></h2>
	<?php
} elseif ( have_rows( 'content_blocks' ) ) {

	?>
	<div class="row max-width">
		<section class="section block content-grid-block">
			<div class="item-grid no-wrap has-background inverse-color">
				<?php
				while ( have_rows( 'content_blocks' ) ) {
					the_row();
					$the_title = get_sub_field( 'title' );
					$text      = get_sub_field( 'text' );
					$the_link  = get_sub_field( 'link' );
					$icon      = get_sub_field( 'icon' );

					if ( ! empty( $the_title ) || ! empty( $text ) ) {
						?>

						<article class="item has-background has-overlay block-style-solid">

						<?php if ( ! empty( $the_title ) ) { ?>
							<h2 class="section-title"><?php echo esc_html( $the_title ); ?></h2>
						<?php } ?>

						<?php if ( ! empty( $text ) ) { ?>
							<p><?php echo esc_html( $text ); ?></p>
						<?php } ?>

						<?php if ( ! empty( $the_link ) ) { ?>
							<a href="<?php echo esc_url( $the_link['url'] ); ?>" title="<?php echo esc_url( $the_link['title'] ); ?>"><button class="has-arrow-right"><?php esc_html_e( 'Learn More', 'itsa-theme' ); ?></button></a>
						<?php } ?>
						</article>

						<?php
					}
				}
				?>
			</div><!-- .item-grid -->
		</section><!-- .section -->
	</div><!-- .row -->
	<?php
}
