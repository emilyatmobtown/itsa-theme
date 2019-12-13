<?php
/**
 * Template part for displaying the Quotes block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$quotes = get_field( 'selected_quotes' );

if ( ! empty( $quotes ) && isset( $quotes ) ) {
	?>

	<div class="row block-area block-area-quotes-slider block-area-with-overlay reverse-color max-width">
		<div class="block-area-content">
			<div class="block-area-text glide block-area-glide">
				<div class="glide__track block-area-glide-track" data-glide-el="track">
					<ul class="glide__slides block-area-glide-slides">
						<?php foreach ( $quotes as $quote ) { ?>
							<li class="glide__slide block-area-glide-slide restricted-width">
								<?php echo wp_kses_post( $quote->post_content ); ?>
							</li>
						<?php } ?>
					</ul>
				</div><!-- .block-area-glide-track -->
				<div class="glide__bullets block-area-glide-bullets" data-glide-el="controls[nav]">
					<?php foreach ( $quotes as $key => $quote ) { ?>
						<button class="glide__bullet block-area-glide-bullet" data-glide-dir="=<?php echo esc_attr( $key ); ?>" aria-hidden="true"></button>
					<?php } ?>
				</div><!-- .block-area-glide-bullets -->
			</div><!-- .block-area-text -->
		</div><!-- .block-area-content -->
	</div><!-- .block-area -->

	<?php
}
