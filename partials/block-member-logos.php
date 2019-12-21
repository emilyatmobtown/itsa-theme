<?php
/**
 * Template part for displaying the Member Logos block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$logos = get_field( 'logos' );

if ( is_admin() && empty( $logos ) ) {
	?>

	<h1 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add Member Logos..." contenteditable="false"></span></h1>

	<?php
} elseif ( ! empty( $logos ) && isset( $logos ) ) {
	?>

	<div class="row max-width full-width">
		<section class="section member-logos-block">
			<div class="glide slider" data-glide-autoplay="4000" data-glide-animationDuration="1000" data-glide-rewindDuration="2000" data-glide-per-view="5" data-glide-gap="20" data-glide-bound="true" data-slide-width="200">
				<div class="glide__track slider-track" data-glide-el="track">
					<ul class="glide__slides slides">
						<?php foreach ( $logos as $logo ) { ?>
							<li class="glide__slide slide">
								<img src="<?php echo esc_url( $logo['sizes']['itsa-member-logo'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
							</li>
						<?php } ?>
					</ul>
				</div><!-- .block-area-glide-track -->
			</div><!-- .block-area-text -->
		</section><!-- .section -->
	</div><!-- .row -->

	<?php
}
