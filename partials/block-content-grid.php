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
					$the_title  = get_sub_field( 'title' );
					$text       = get_sub_field( 'text' );
					$button     = get_sub_field( 'link' );
					$icon_style = get_sub_field( 'icon' );

					if ( ! empty( $the_title ) || ! empty( $text ) ) {
						?>

						<article class="item has-background has-overlay block-style-solid <?php echo esc_attr( $icon_style ); ?>">

							<?php if ( ! empty( $the_title ) ) { ?>
								<h2 class="font-weight-600"><?php echo esc_html( $the_title ); ?></h2>
							<?php } ?>

							<?php if ( ! empty( $text ) ) { ?>
								<p><?php echo esc_html( $text ); ?></p>
							<?php } ?>

							<?php if ( ! empty( $button ) ) { ?>
								<a href="<?php echo esc_url( $button['url'] ); ?>" title="<?php echo esc_url( $button['title'] ); ?>"><button class="has-arrow-right"><?php esc_html_e( 'Learn More', 'itsa-theme' ); ?></button></a>
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
