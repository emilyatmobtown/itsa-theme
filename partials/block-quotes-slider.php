<?php
/**
 * Template part for displaying the Quotes block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$quotes = get_field( 'selected_quotes' );

if ( is_admin() && empty( $quotes ) ) {
	?>

	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Quotes Slider..." contenteditable="false"></span></h2>

	<?php
} elseif ( ! empty( $quotes ) && isset( $quotes ) ) {
	?>

	<div class="row max-width">
		<section class="section block quotes-slider-block has-background has-overlay block-style-seat-belt inverse-color">
			<div class="glide slider">
				<div class="glide__track slider-track" data-glide-el="track">
					<ul class="glide__slides slides">
						<?php foreach ( $quotes as $quote ) { ?>
							<li class="glide__slide slide restricted-width">
								<?php echo wp_kses_post( $quote->post_content ); ?>
							</li>
						<?php } ?>
					</ul>
				</div><!-- .glide__track -->
				<div class="glide__bullets slider-bullets" data-glide-el="controls[nav]">
					<?php foreach ( $quotes as $key => $quote ) { ?>
						<button class="glide__bullet slider-bullet" data-glide-dir="=<?php echo esc_attr( $key ); ?>" aria-hidden="true"></button>
					<?php } ?>
				</div><!-- .glide__bullets -->
			</div><!-- .glide -->
		</section><!-- .section -->
	</div><!-- .row -->

	<?php
}
