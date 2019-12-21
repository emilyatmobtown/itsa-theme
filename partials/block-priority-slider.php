<?php
/**
 * Template part for displaying the Priority Slider block
 *
 * Note: This template calls the render template for the Priority block.
 * This sets up nested rendering, which acf_render_block is not built for.
 * If WP_DEBUG is enabled, a PHP error will be generated due to a missing 'id'
 * index passed to acf_reset_meta at the completion of the rendering of this
 * parent template. There is currently not a clear way to resolve this without
 * rebuilding significant portions of the ACF plugin. However, other than
 * creating a PHP warning, there do not appear to be any other undesirable
 * consequences.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$priorities = get_field( 'selected_priorities' );
$the_title  = get_field( 'title' );

if ( is_admin() && empty( $priorities ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Priority Slider..." contenteditable="false"></span></h2>
	<?php
} elseif ( ! empty( $priorities ) && isset( $priorities ) ) {
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
			<?php } ?><!-- .section -->

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
