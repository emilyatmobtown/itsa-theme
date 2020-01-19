<?php
/**
 * Template part for displaying the Post Archive block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$posttype  = get_field( 'post_type' );
$the_title = get_field( 'title' );

if ( is_admin() && empty( $posttype ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Post Archive..." contenteditable="false"></span></h2>
	<?php
} elseif ( ! empty( $posttype ) ) {

	$type_name = $posttype . '-type';
	$types     = get_terms(
		array(
			'taxonomy' => $type_name,
			'orderby'  => 'name',
		)
	);
	$issues    = get_terms(
		array(
			'taxonomy' => 'issue',
			'orderby'  => 'name',
		)
	);

	// Set up initial query args
	$on_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args    = array(
		'post_type'              => $posttype,
		'update_post_meta_cache' => false,
		'posts_per_page'         => 3,
		'paged'                  => $on_page,
	);

	// Use underscores for ACF field names
	// $tax_name = $posttype . '_type';
	// $types    = get_field( $tax_name );

	// Add taxonomy terms to query args if added to block
	// if ( ! empty( $types ) && isset( $types ) ) {
	// 	// Use hyphens for taxonomy names in query
	// 	$tax_name = str_replace( '_', '-', $tax_name );
	//
	// 	// Extract term names from term objects and build string for query
	// 	$type_names = array_map(
	// 		function( $type ) {
	// 			return $type->name;
	// 		},
	// 		$types
	// 	);
	//
	// 	$args['tax_query'] = array(
	// 		array(
	// 			'taxonomy' => $tax_name,
	// 			'field'    => 'slug',
	// 			'terms'    => $type_names,
	// 		),
	// 	);
	// }

	// Add issue taxonomy terms to query args if added to block
	// if ( ! empty( $issues ) && isset( $issues ) ) {
	// 	// Extract term names from term objects and build string for query
	// 	$issue_names = array_map(
	// 		function( $issue ) {
	// 			return $issue->name;
	// 		},
	// 		$issues
	// 	);
	//
	// 	$args['tax_query'][] = array(
	// 		'taxonomy' => 'issue',
	// 		'field'    => 'slug',
	// 		'terms'    => $issue_names,
	// 	);
	// }

	// Add date ordering and filtering for event posts
	if ( 'event' === $posttype ) {
		// Order by event date
		$args['meta_key'] = 'event_start_date';
		$args['order']    = 'ASC';
		$args['orderby']  = 'meta_value';

		// Filter out dates ater today
		$args['meta_query'] = array(
			array(
				'key'     => 'event_start_date',
				'value'   => date( 'Ymd' ),
				'compare' => '>',
			),
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
			<section id="post-grid-filtered" class="section block post-grid-block">
				<?php if ( ! empty( $the_title ) ) { ?>
					<header class="section-header">
						<?php if ( is_home() || is_front_page() ) { ?>
							<h3 class="section-title"><?php echo esc_attr( $the_title ); ?></h3>
						<?php } else { ?>
							<h2 class="section-title"><?php echo esc_attr( $the_title ); ?></h2>
						<?php } ?>
					</header><!-- .section-header -->
				<?php } ?>

				<form id="post-grid-filter">
					<label for="post-grid-filter-by-issue"><?php esc_html_e( 'Filter By', 'itsa-theme' ); ?>:</label>
					<?php
					if ( ! empty( $issues ) ) {
						?>
						<select name="post-grid-filter-by-issue" id="post-grid-filter-by-issue">
							<option value="0">All</option>
							<?php foreach ( $issues as $issue ) { ?>
								<option value="<?php echo esc_attr( $issue->term_id ); ?>"><?php echo esc_attr( $issue->name ); ?></option>
							<?php } ?>
						</select>
					<?php } ?>
					<input type="hidden" name="action" value="post-grid-filter" />
					<input type="hidden" name="post-type" value="<?php echo esc_attr( $posttype ); ?>" />
					<button>Apply Filters</button>
				</form>
				<div id="post-grid-filter-results" class="item-grid has-background inverse-color">
					<?php while ( $the_query->have_posts() ) { ?>
						<?php $the_query->the_post(); ?>
						<?php get_template_part( 'partials/content', $posttype ); ?>
					<?php } ?>
				</div><!-- .item-grid -->

				<?php if ( $the_query->max_num_pages > 1 ) { ?>
					<a id="post-grid-load-more" class="section-link more-link has-arrow has-arrow-down display-block">See More <span class="show-md"><?php echo esc_attr( itsa_get_post_type_plural_label( $posttype ) ); ?></span></a>
				<?php } ?>
			</section><!-- .section -->
			<script>
				var currentPageMyAjax = 1,
					postsMyAjax       = '<?php echo wp_kses_post( wp_json_encode( $the_query->query_vars ) ); ?>',
					maxPageMyAjax     =  <?php echo esc_attr( $the_query->max_num_pages ); ?>,
					ajaxUrl           = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>',
					postType          = '<?php echo esc_attr( $posttype ); ?>';
			</script>
		</div><!-- .row -->
		<?php
	}

	wp_reset_postdata();
}
