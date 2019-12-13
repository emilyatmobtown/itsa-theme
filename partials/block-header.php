<?php
/**
 * Template part for displaying the Header block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$the_id    = get_the_ID() ? get_the_ID() : Utility\get_acf_post_id();
$the_title = get_field( 'title' );
if ( empty( $the_title ) ) {
	$the_wp_title = get_the_title( $the_id );
	if ( empty( $the_wp_title ) && is_admin() ) {
		$the_title = '';
	} else {
		$the_title = $the_wp_title;
	}
}
// $the_title   = empty( $the_title ) ? get_the_title( $the_id ) : $the_title;
$tagline     = get_field( 'tagline' );
$image       = get_field( 'image' );
$header_type = 'block-area-header-' . get_post_type( $the_id );
$block_style = empty( $image ) ? $header_type : $header_type . ' wp-block-cover has-background-dim reverse-color';
$button_text = get_field( 'button_text' );
$url         = get_field( 'button_page_link' );
$url         = empty( $url ) ? get_field( 'button_external_url' ) : $url;
$external    = empty( $url ) ? false : true;

?>

	<header class="<?php echo esc_attr( $block_style ); ?> block-area block-area-header" style="background-image:url(<?php echo esc_url( $image['sizes']['itsa-header'] ); ?>)">
		<div class="block-area-content">
			<?php if ( is_home( $the_id ) || is_front_page( $the_id ) ) { ?>
				<h2 class="entry-title"><span class="highlight"><?php echo esc_attr( $the_title ); ?></span></h2>
			<?php } elseif ( ! empty( $image ) ) { ?>
				<h1 class="entry-title"><span class="highlight"><?php echo esc_attr( $the_title ); ?></span></h1>
			<?php } else { ?>
				<h1 class="entry-title"><?php echo esc_attr( $the_title ); ?></h1>
			<?php } ?>
			<?php if ( ! empty( $tagline ) ) { ?>
				<span class="tagline"><?php echo esc_attr( $tagline ); ?></span>
			<?php } ?>
			<?php if ( ! empty( $button_text ) && ! empty( $url ) ) { ?>
				<a class="block-area-button-link" href="<?php echo esc_url( $url ); ?>" <?php echo $external ? 'target="_blank"' : ''; ?>><button class="block-area-button button-arrow-right"><?php echo esc_attr( $button_text ); ?></button></a>
			<?php } ?>
		</div><!-- .block-area-content -->
	</header><!-- .block-area-header -->
