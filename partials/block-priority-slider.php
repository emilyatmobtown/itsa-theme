<?php
/**
 * Template part for displaying the Priority Slider block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$priorities = get_field( 'selected_priorities' );
$the_title  = get_field( 'title' );

if ( ! empty( $priorities ) && isset( $priorities ) ) {
	?>

	<div class="row max-width">
		<section class="section block priority-slider-block">
			<?php if ( ! empty( $the_title ) ) { ?>
				<header class="section-header">
					<?php if ( is_home() || is_front_page() ) { ?>
						<h3 class="section-title"><?php echo esc_attr( $the_title ); ?></h3>
					<?php } else { ?>
						<h2 class="section-title"><?php echo esc_attr( $the_title ); ?></h2>
					<?php } ?>
				</header><!-- .section-header -->
			<?php } ?>
			<div class="glide slider">
				<div class="glide__track slider-track" data-glide-el="track">
					<ul class="glide__slides slides">
						<?php foreach ( $priorities as $priority ) { ?>
							<li class="glide__slide slide">
								<?php
								$blocks = parse_blocks( $priority->post_content );
								foreach ( $blocks as $block ) {
									if ( 'acf/priority' === $block['blockName'] ) {
										echo wp_kses_post( render_block( $block ) );
										break;
									}
								}
								?>
							</li>
						<?php } ?>
					</ul>
				</div><!-- .glide__track -->
				<div class="glide__bullets slider-bullets" data-glide-el="controls[nav]">
					<?php foreach ( $priorities as $key => $priority ) { ?>
						<button class="glide__bullet slider-bullet" data-glide-dir="=<?php echo esc_attr( $key ); ?>" aria-hidden="true"></button>
					<?php } ?>
				</div><!-- .glide__bullets -->
			</div><!-- .glide -->
		</section><!-- .section -->
	</div><!-- .row -->

	<?php
}
