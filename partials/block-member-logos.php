<?php
/**
 * Template part for displaying the Member Logos block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$logos       = get_field( 'logos' );
$block_style = get_field( 'block_style' );
$block_style = empty( $block_style ) ? 'block-style-slider' : $block_style;

if ( ! empty( $logos ) && isset( $logos ) ) {
	?>

	<div class="row block-area block-area-member-logos reverse-color max-width no-side-padding <?php echo esc_attr( $block_style ); ?>">
		<div class="block-area-content no-padding">
			<div class="block-area-text glide block-area-glide" data-glide-autoplay="4000" animationDuration="600" rewindDuration="2000" data-glide-per-view="5" data-glide-gap="20" data-glide-bound="true" data-slide-width="200">
				<div class="glide__track block-area-glide-track" data-glide-el="track">
					<ul class="glide__slides block-area-glide-slides">
						<?php foreach ( $logos as $logo ) { ?>
							<li class="glide__slide block-area-glide-slide">
								<img src="<?php echo esc_url( $logo['sizes']['itsa-member-logo'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
							</li>
						<?php } ?>
					</ul>
				</div><!-- .block-area-glide-track -->
			</div><!-- .block-area-text -->
		</div><!-- .block-area-content -->
	</div><!-- .block-area -->

	<?php
}
