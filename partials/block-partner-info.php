<?php
/**
 * Template part for displaying the Partner Info block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

if ( is_admin() && ! have_rows( 'partners' ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Partner Info Block..." contenteditable="false"></span></h2>
	<?php
} elseif ( have_rows( 'partners' ) ) {

	?>
	<div class="row max-width">
		<section class="section block partner-info-block has-background has-overlay block-style-blurred-lights inverse-color">
			<div class="item-grid restricted-width">
				<?php
				while ( have_rows( 'partners' ) ) {
					the_row();
					$name        = get_sub_field( 'name' );
					$logo        = get_sub_field( 'logo' );
					$description = get_sub_field( 'description' );
					$url         = get_sub_field( 'url' );

					if ( ! empty( $name ) ) {
						?>

						<article class="item">
							<?php if ( ! empty( $logo ) && isset( $logo ) ) { ?>
								<img class="partner-logo" src="<?php echo esc_url( $logo['sizes']['itsa-partner-logo'] ); ?>" alt="<?php echo esc_attr( $name ); ?>">
							<?php } else { ?>
								<h3 class="partner-name font-weight-600"><?php echo esc_attr( $name ); ?></h3>
							<?php } ?>

							<?php if ( ! empty( $description ) ) { ?>
								<p><?php echo esc_html( $description ); ?></p>
							<?php } ?>

							<?php if ( ! empty( $url ) ) { ?>
								<a href="<?php echo esc_url( $url ); ?>" title="<?php esc_html_e( 'Learn More', 'itsa-theme' ); ?>"><button class="has-arrow-right"><?php esc_html_e( 'Learn More', 'itsa-theme' ); ?></button></a>
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
