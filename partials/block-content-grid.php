<?php
/**
 * Template part for displaying the Content Grid block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$content_type = get_field( 'content_type' );
$issues       = get_field( 'issue' );
$the_title    = get_field( 'title' );

if ( is_admin() && empty( $content_type ) ) {
	?>
	<p>Select type of content to display in grid.</p>
	<?php
} elseif ( ! empty( $content_type ) && isset( $content_type ) ) {

	// Set up initial query args
	$args = array(
		'post_type'              => $content_type,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'posts_per_page'         => 12,
	);

	// Use underscores for ACF field names
	$tax_name = $content_type . '_type';
	$types    = get_field( $tax_name );

	// Add content taxonomy terms to query args if added to block
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

	if ( $the_query->have_posts() ) {
		?>
		<div class="row max-width">
			<section class="section block content-grid-block">
				<?php if ( ! empty( $the_title ) ) { ?>
					<header class="section-header">
						<?php if ( is_home() || is_front_page() ) { ?>
							<h3 class="section-title"><?php echo esc_attr( $the_title ); ?></h3>
						<?php } else { ?>
							<h2 class="section-title"><?php echo esc_attr( $the_title ); ?></h2>
						<?php } ?>
						<a class="section-link content-grid-more-link has-arrow has-arrow-right">See All <span class="show-md"><?php echo esc_attr( ucwords( $content_type ) ); ?></span></a>
					</header><!-- .section-header -->
				<?php } ?>

				<div class="item-grid has-background inverse-color">
					<?php while ( $the_query->have_posts() ) { ?>
						<?php $the_query->the_post(); ?>

						<article class="item">
							<?php if ( ! empty( $type_names ) && isset( $type_names ) ) { ?>
								<span class="content-grid-tag"><?php echo esc_attr( $type_names[0] ); ?></span>
							<?php } ?>
							<?php if ( is_home() || is_front_page() ) { ?>
								<h4 class="item-title content-grid-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<?php } else { ?>
								<h3 class="item-title content-grid-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php } ?>

							<?php the_date( '', '<span class="content-grid-item-date"><time>', '</time></span>' ); ?>

							<?php if ( has_excerpt() ) { ?>
								<?php the_excerpt(); ?>
							<?php } else { ?>
								<p><?php echo wp_kses_post( wp_trim_words( get_the_content(), 40, '...' ) ); ?></p>
							<?php } ?>
						</article><!-- .item -->

						<?php wp_reset_postdata(); ?>
					<?php } ?>
				</div><!-- .item-grid -->
			</section><!-- .section -->
		</div><!-- .row -->
		<?php
	}
}
