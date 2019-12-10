<?php
/**
 * Template part for displaying the Hero Image block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$image   = get_field( 'image' );
$tagline = get_field( 'tagline' );
// $the_id    = get_the_ID() ? get_the_ID() : $_POST['post_id'];
$the_title = get_the_title( $the_id );

if ( ! empty( $image ) ) {
	?>

	<div class="block-area block-area-hero-image block-area-with-overlay reverse-color">
		<div class="block-area-content no-padding">
			<img src="<?php echo esc_url( $image['sizes']['itsa-hero-image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
			<div class="block-area-text">
			</div>
		</div>
	</div>

	<?php
}
