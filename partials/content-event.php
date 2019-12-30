<?php
/**
 * Template part for displaying News content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

global $post;
$blocks  = parse_blocks( $post->post_content );
$classes = array( 'item', 'has-background', 'has-overlay' );

$header_image_url = '';
$header_block     = Utility\get_block( $blocks, 'acf/header' );

if ( ! empty( $header_block ) && isset( $header_block ) ) {
	$header_image_url = Utility\get_header_image_url( $header_block );
}

if ( empty( $header_image_url ) ) {
	$classes[] = 'block-style-solid';
}

if ( ! is_singular( 'event' ) ) {
	$terms     = get_the_terms( $post->ID, 'event-type' );
	$term_name = ( ! empty( $terms && isset( $terms ) ) ) ? $terms[0]->name : itsa_get_tax_plural_label( 'event' );
} else {
	$registration_url = get_field( 'event_url' );
}
?>

<!-- Background image for post slider large view -->
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> style="background-image:url(<?php echo esc_url( $header_image_url ); ?>)">

	<!-- Background image for post slider mobile view -->
	<div class="image-placeholder has-overlay" style="background-image:url(<?php echo esc_url( $header_image_url ); ?>)"></div>

	<?php if ( ! empty( $term_name ) ) { ?>
		<span class="entry-tag"><?php echo esc_attr( $term_name ); ?></span>
	<?php } ?>

	<?php if ( empty( $header_block ) ) { ?>
		<div class="row max-width">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title item-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		</div><!-- .row -->
	<?php } ?>

	<div class="entry-content">
		<?php if ( is_singular( 'event' ) ) { ?>
			<?php the_content(); ?>
		<?php } else { ?>
			<?php itsa_the_excerpt( '', true, true ); ?>
			<?php if ( ! empty( $registration_url ) ) { ?>
				<a href="<?php echo esc_url( $registration_url ); ?>" title="Register"><button class="has-arrow-right"><?php esc_html_e( 'Register', 'itsa-theme' ); ?></button></a>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><button class="has-arrow-right"><?php esc_html_e( 'Read More', 'itsa-theme' ); ?></button></a>
			<?php } ?>
		<?php } ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
