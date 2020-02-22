<?php
/**
 * Template part for displaying related posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$args = array(
	'post_type'      => array( 'news', 'event', 'advocacy-material' ),
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'post__not_in'   => array( $post->ID ),
	'orderby'        => 'rand',
	'tax_query'      => array(),
);

$taxonomies = get_object_taxonomies( $post );

foreach ( $taxonomies as $the_taxonomy ) {
	$terms = get_the_terms( $post_id, $taxonomy );

	if ( empty( $terms ) ) {
		continue;
	}

	$term_list           = wp_list_pluck( $terms, 'slug' );
	$args['tax_query'][] = array(
		'taxonomy' => $the_taxonomy,
		'field'    => 'slug',
		'terms'    => $term_list,
	);
}

if ( count( $args['tax_query'] ) > 1 ) {
	$args['tax_query']['relation'] = 'OR';
}

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
	?>

	<section class="section related-posts">
	<h2 class="entry-footer-title font-weight-600"><?php esc_html_e( 'Related', 'itsa-theme' ); ?></h2>
	<div class="item-grid no-wrap has-background inverse-color">
		<?php while ( $the_query->have_posts() ) { ?>
			<?php $the_query->the_post(); ?>
			<?php set_query_var( 'header_content', 'title_and_tags' ); ?>
			<?php get_template_part( 'partials/content', get_post_type() ); ?>
		<?php } ?>
	</div><!-- .item-grid -->

	<?php
}

wp_reset_postdata();
