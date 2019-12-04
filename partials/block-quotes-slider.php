<?php
/**
 * Template part for displaying the Quotes block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$quotes = get_field( 'selected_quotes' );

if ( ! empty( $quotes ) ) {
	?>

	<div class="block-area block-area-quotes-slider">
		<div class="glide">
			<div class="glide__track" data-glide-el="track">
				<ul class="glide__slides">
					<?php foreach ( $quotes as $quote ) { ?>
						<li class="glide__slide">
							<?php echo wp_kses_post( $quote->post_content ); ?>
						</li>
					<?php } ?>
				</ul>
			</div>
			<div class="glide__bullets" data-glide-el="controls[nav]">
				<button class="glide__bullet" data-glide-dir="=0"></button>
				<button class="glide__bullet" data-glide-dir="=1"></button>
				<button class="glide__bullet" data-glide-dir="=2"></button>
			</div>
		</div>
	</div>

	<?php
}
