<?php
/**
 * Template part for displaying the Call to Action block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$headline    = get_field( 'headline' );
$text        = get_field( 'text' );
$button_text = get_field( 'button_text' );
$url         = get_field( 'button_page_link' );
$url         = empty( $url ) ? get_field( 'button_external_url' ) : $url;
$external    = empty( $url ) ? false : true;
$block_style = get_field( 'block_style' );
$block_style = empty( $block_style ) ? 'block-style-solid' : $block_style;

if ( ! empty( $headline ) && ! empty( $text ) ) {
	?>

	<div class="row max-width">
		<section class="section block call-to-action-block has-background has-overlay inverse-color <?php echo esc_attr( $block_style ); ?>">
			<?php if ( ! empty( $headline ) ) { ?>
				<h2 class="font-weight-600"><?php echo esc_attr( $headline ); ?></h2>
			<?php } ?>
			<?php if ( ! empty( $text ) ) { ?>
				<div class="restricted-width"><?php echo wp_kses_post( $text ); ?></div>
			<?php } ?>
			<?php if ( ! empty( $button_text ) && ! empty( $url ) ) { ?>
				<a href="<?php echo esc_url( $url ); ?>" <?php echo $external ? 'target="_blank"' : ''; ?>><button class="has-arrow-right"><?php echo esc_attr( $button_text ); ?></button></a>
			<?php } ?>
		</section><!-- .section -->
	</div><!-- .row -->

	<?php
}
