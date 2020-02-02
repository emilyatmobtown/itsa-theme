<?php
/**
 * Template part for displaying News content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$classes          = array( 'item', 'has-background', 'has-overlay' );
$header_image_url = Utility\get_header_image_url();

if ( empty( $header_image_url ) ) {
	$classes[] = 'block-style-solid';
}

if ( ! is_singular( 'advocacy-material' ) ) {
	$terms     = get_the_terms( $post->ID, 'advocacy-material-type' );
	$term_name = ( ! empty( $terms ) && isset( $terms ) ) ? $terms[0]->name : itsa_get_post_type_plural_label( 'advocacy-material' );
}
?>

<!-- Background image for post slider large view -->
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?> style="background-image:url(<?php echo esc_url( $header_image_url ); ?>)">

	<!-- Background image for post slider mobile view -->
	<div class="image-placeholder has-overlay" style="background-image:url(<?php echo esc_url( $header_image_url ); ?>)"></div>

	<?php if ( ! empty( $term_name ) ) { ?>
		<span class="entry-tag"><?php echo esc_attr( $term_name ); ?></span>
	<?php } ?>

	<?php if ( ! Utility\has_block( 'acf/header' ) ) { ?>
		<?php if ( is_singular( 'advocacy-material' ) ) { ?>
			<div class="row max-width">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title item-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			</div><!-- .row -->
		<?php } else { ?>
			<?php the_title( '<h2 class="entry-title item-title">', '</h2>' ); ?>
		<?php } ?>
	<?php } ?>

	<div class="entry-content">
		<?php if ( is_singular( 'advocacy-material' ) ) { ?>
			<?php the_content(); ?>
		<?php } else { ?>
			<?php itsa_the_excerpt( null, true, true ); ?>
			<?php itsa_the_post_button(); ?>
		<?php } ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
