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

	// Add date ordering and filtering for event posts
	if ( 'event' === $posttype ) {
		// Order by event date. Include all dates in descending order for archive
		$args['meta_key'] = 'event_start_date';
		$args['orderby']  = 'meta_value';
	}

	// Add query arg for multiple taxonomies
	if ( ! empty( $issues ) && isset( $issues ) && ! empty( $types ) && isset( $types ) ) {
		$args['tax_query']['relation'] = 'AND';
	}
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		?>
		<div class="row max-width">
			<section id="post-grid-filtered" class="section block post-grid-block post-archive-block">
				<div class="cap-wrapper">
					<?php if ( ! empty( $the_title ) ) { ?>
						<header class="section-header">
							<?php if ( is_home() || is_front_page() ) { ?>
								<h3 class="section-title"><?php echo esc_attr( $the_title ); ?></h3>
							<?php } else { ?>
								<h2 class="section-title"><?php echo esc_attr( $the_title ); ?></h2>
							<?php } ?>
						</header><!-- .section-header -->
					<?php } ?>

					<form id="post-grid-filter" class="post-grid-form">
						<div id="post-grid-filter-loader" class="loader-icon hidden"></div>
						<label class="small-caps label-inline-md" for="post-grid-filter-by-issue"><?php esc_html_e( 'Filter By', 'itsa-theme' ); ?>:</label>
						<?php if ( ! empty( $types ) ) { ?>
							<select class="select-inline-md" name="post-grid-filter-by-type" id="post-grid-filter-by-type">
								<option value="0">All</option>
								<?php foreach ( $types as $ptype ) { ?>
									<option value="<?php echo esc_attr( $ptype->term_id ); ?>"><?php echo esc_attr( $ptype->name ); ?></option>
								<?php } ?>
							</select>
						<?php } ?>
						<?php if ( ! empty( $issues ) ) { ?>
							<select class="select-inline-md" name="post-grid-filter-by-issue" id="post-grid-filter-by-issue">
								<option value="0">All</option>
								<?php foreach ( $issues as $issue ) { ?>
									<option value="<?php echo esc_attr( $issue->term_id ); ?>"><?php echo esc_attr( $issue->name ); ?></option>
								<?php } ?>
							</select>
						<?php } ?>
						<input type="hidden" name="action" value="post-grid-filter" />
						<input type="hidden" name="post-type" value="<?php echo esc_attr( $posttype ); ?>" />
						<input type="hidden" name="filter-nonce" value="<?php echo esc_attr( wp_create_nonce( 'post-grid-filter-nonce' ) ); ?>" />
					</form>
				</div><!-- .cap-wrapper -->
				<div id="post-grid-filter-results" class="item-grid has-background inverse-color">
					<?php while ( $the_query->have_posts() ) { ?>
						<?php $the_query->the_post(); ?>
						<?php get_template_part( 'partials/content', $posttype ); ?>
					<?php } ?>
				</div><!-- .item-grid -->

				<?php if ( $the_query->max_num_pages > 1 ) { ?>
					<a id="post-grid-load-more" class="section-link more-link has-arrow has-arrow-down display-block">See More <?php echo esc_attr( itsa_get_post_type_plural_label( $posttype ) ); ?></a>
					<div id="post-grid-load-more-loader" class="loader-icon hidden"></div>
				<?php } ?>
			</section><!-- .section -->
			<?php
				$script = "
				var currentPageMyAjax = 1,
					postsMyAjax       = '" . wp_json_encode( $the_query->query_vars ) . "',
					maxPageMyAjax     =  " . $the_query->max_num_pages . ",
					ajaxUrl           = '" . admin_url( 'admin-ajax.php' ) . "',
					postType          = '" . $posttype . "',
					loadMoreNonce     = '" . wp_create_nonce( 'post-grid-load-more-nonce' ) . "'";
				wp_add_inline_script( 'frontend', $script )
			?>
		</div><!-- .row -->
		<?php
	}

	wp_reset_postdata();
}
