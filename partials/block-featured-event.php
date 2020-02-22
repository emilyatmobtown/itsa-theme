<?php
/**
 * Template part for displaying the Featured Event block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$the_title              = get_field( 'title' );
$show_additional_events = get_field( 'show_additional_events' );
$featured_event         = get_field( 'featured_event' );

$args      = array(
	'p'                      => $featured_event,
	'post_type'              => 'event',
	'no_found_rows'          => true,
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
	'posts_per_page'         => 1,
);
$the_query = new WP_Query( $args );

if ( is_admin() && empty( $featured_event ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Featured Event..." contenteditable="false"></span></h2>
	<?php
} elseif ( $the_query->have_posts() ) {
	?>

	<div class="row max-width">
		<section class="section block featured-event-block">
			<?php if ( ! empty( $the_title ) ) { ?>
				<header class="section-header">
					<?php if ( is_home() || is_front_page() ) { ?>
						<h3 class="section-title"><?php echo esc_attr( $the_title ); ?></h3>
					<?php } else { ?>
						<h2 class="section-title"><?php echo esc_attr( $the_title ); ?></h2>
					<?php } ?>
					<a class="section-link more-link has-arrow has-arrow-right" href="<?php echo esc_url( itsa_get_archive_url( 'event' ) ); ?>">See All<span class="hidden-sm"> Events</span></a>
				</header><!-- .section-header -->
			<?php } ?><!-- .section -->

			<?php

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				set_query_var( 'header_content', 'full_header' );
				get_template_part( 'partials/content', 'event' );
			}

			wp_reset_postdata();

			if ( $show_additional_events ) {

				$args = array(
					'post__not_in'           => array( $featured_event ),
					'post_type'              => 'event',
					'no_found_rows'          => true,
					'update_post_meta_cache' => false,
					'update_post_term_cache' => false,
					'posts_per_page'         => 2,
					'meta_key'               => 'event_start_date',
					'order'                  => 'ASC',
					'orderby'                => 'meta_value',
					'meta_query'             => array(
						array(
							'key'     => 'event_start_date',
							'value'   => gmdate( 'Ymd' ),
							'compare' => '>',
						),
					),
				);

				$the_query = new WP_Query( $args );

				if ( $the_query->have_posts() ) {
					?>

					<div class="item-grid has-background inverse-color">

						<?php while ( $the_query->have_posts() ) { ?>
							<?php $the_query->the_post(); ?>
							<?php set_query_var( 'header_content', 'title_and_tags' ); ?>
							<?php get_template_part( 'partials/content', 'event' ); ?>
						<?php } ?>

					</div><!-- .item-grid -->

					<?php
				}
			}

			?>
		</section><!-- .section -->
	</div><!-- .row -->

	<?php

}
