<?php
/**
 * Template part for displaying the Featured Post Grid block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$featured_post    = get_field( 'featured_post' );
$additional_posts = get_field( 'additional_posts' );

if ( is_admin() && empty( $featured_post ) && empty( $additional_posts ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Featured Post Grid..." contenteditable="false"></span></h2>
	<?php
} elseif ( ! empty( $featured_post ) && ! empty( $additional_posts ) ) {

	?>
	<div class="row no-max-width no-padding-left no-padding-right">
		<section class="section block featured-post-grid-block">
			<div class="featured-post-grid-outer-grid inverse-color">

				<?php
				$header_image_url = Utility\get_header_image_url( $featured_post );
				$classes          = 'featured-post-grid-outer-grid-item has-overlay';
				$classes         .= ( ! empty( $header_image_url ) ) ? ' has-background' : ' block-style-solid';
				?>

				<div class="<?php echo esc_html( $classes ); ?>" style="background-image:url(<?php echo esc_url( $header_image_url ); ?>)">

					<article id="post-<?php echo esc_attr( $featured_post->ID ); ?>" class="featured-post-grid-item top-post">
						<?php itsa_the_type_and_term( $featured_post, true ); ?>
						<h3 class="featured-post-grid-title top-post-title"><?php echo esc_html( $featured_post->post_title ); ?></h3>
						<?php itsa_the_excerpt( null, false, true, $featured_post ); ?>
						<?php itsa_the_post_button( $featured_post ); ?>
					</article>

				</div><!-- .featured-post-grid-outer-grid-item -->

				<div class="featured-post-grid-outer-grid-item featured-post-grid-inner-grid block-style-solid">

					<?php foreach ( $additional_posts as $additional_post ) { ?>

						<article id="post-<?php echo esc_attr( $additional_post->ID ); ?>" class="featured-post-grid-item side-post">
							<?php itsa_the_type_and_term( $additional_post ); ?>
							<h3 class="featured-post-grid-title"><?php echo esc_html( $additional_post->post_title ); ?></h3>
							<?php itsa_the_entry_meta( $additional_post ); ?>
							<?php itsa_the_post_button( $additional_post ); ?>
						</article>

					<?php } ?>

				</div><!-- .featured-post-grid-outer-grid-item -->
			</div><!-- .outer-grid -->
		</section><!-- .section -->
	</div><!-- .row -->
	<?php
}
