<?php
/**
 * Template part for displaying the Post Slider block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$posttype  = get_field( 'post_type' );
$issues    = get_field( 'issue' );
$the_title = get_field( 'title' );
$alignment = get_field( 'alignment' );

if ( is_admin() && empty( $posttype ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Post Slider..." contenteditable="false"></span></h2>
	<?php
} elseif ( ! empty( $posttype ) ) {

	// Set up initial query args
	$args = array(
		'post_type'              => $posttype,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'posts_per_page'         => 5,
	);

	// Use underscores for ACF field names
	$tax_name = $posttype . '_type';
	$types    = get_field( $tax_name );

	// Add taxonomy terms to query args if added to block
	if ( ! empty( $types ) && isset( $types ) ) {
		// Use hyphens for taxonomy names in query
		$tax_name = str_replace( '_', '-', $tax_name );

		// Extract term names from term objects and build string for query
		$type_names = array_map(
			function( $type ) {
				return $type->name;
			},
			$types
		);

		$args['tax_query'] = array(
			array(
				'taxonomy' => $tax_name,
				'field'    => 'slug',
				'terms'    => $type_names,
			),
		);
	}

	// Add issue taxonomy terms to query args if added to block
	if ( ! empty( $issues ) && isset( $issues ) ) {
		// Extract term names from term objects and build string for query
		$issue_names = array_map(
			function( $issue ) {
				return $issue->name;
			},
			$issues
		);

		$args['tax_query'][] = array(
			'taxonomy' => 'issue',
			'field'    => 'slug',
			'terms'    => $issue_names,
		);
	}

	// Add query arg for multiple taxonomies
	if ( ! empty( $issues ) && isset( $issues ) && ! empty( $types ) && isset( $types ) ) {
		$args['tax_query']['relation'] = 'AND';
	}
	$the_query = new WP_Query( $args );
	$count     = $the_query->post_count;

	if ( $the_query->have_posts() ) {
		?>
		<div class="row max-width">
			<section class="section block post-slider-block <?php echo esc_attr( $alignment ); ?>">
				<?php if ( ! empty( $the_title ) ) { ?>
					<header class="section-header">
						<?php if ( is_home() || is_front_page() ) { ?>
							<h3 class="section-title"><?php echo esc_attr( $the_title ); ?></h3>
						<?php } else { ?>
							<h2 class="section-title"><?php echo esc_attr( $the_title ); ?></h2>
						<?php } ?>
						<a class="section-link more-link has-arrow has-arrow-right" href="<?php echo esc_url( itsa_get_archive_url( $posttype ) ); ?>">See All<span class="hidden-sm"> <?php echo esc_attr( itsa_get_post_type_plural_label( $posttype ) ); ?></span></a>
					</header><!-- .section-header -->
				<?php } ?><!-- .section -->

				<div class="glide slider inverse-color">
					<div class="glide__track slider-track" data-glide-el="track">
						<ul class="glide__slides slides">
							<?php while ( $the_query->have_posts() ) { ?>
								<?php $the_query->the_post(); ?>
									<li class="glide__slide slide">
										<?php set_query_var( 'header_content', 'full_header' ); ?>
										<?php get_template_part( 'partials/content', $posttype ); ?>
									</li>
							<?php } ?>
						</ul>
					</div><!-- .glide__track -->
					<div class="glide__bullets slider-bullets" data-glide-el="controls[nav]">
						<?php for ( $i = 0; $i < $count; $i++ ) { ?>
							<button class="glide__bullet slider-bullet" data-glide-dir="=<?php echo esc_attr( $i ); ?>" aria-hidden="true"></button>
						<?php } ?>
					</div><!-- .glide__bullets -->
				</div><!-- .glide -->
			</section><!-- .section -->
		</div><!-- .row -->
		<?php
	}

	wp_reset_postdata();
}
