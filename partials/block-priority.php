<?php
/**
 * Template part for displaying the Call to Action block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

$the_title  = get_field( 'title' );
$fact_sheet = get_field( 'fact_sheet' );
$image      = get_field( 'image' );

if ( is_admin() && empty( $the_title ) ) {
	?>

	<p>Add a Priority...</p>

	<?php
} elseif ( ! empty( $the_title ) && ! empty( $image ) ) {
	?>

	<article class="priority-block has-background has-overlay" style="background-image:url(<?php echo esc_url( $image['sizes']['itsa-header'] ); ?>)">
		<div class="image-placeholder has-overlay" style="background-image:url(<?php echo esc_url( $image['sizes']['itsa-header'] ); ?>)"></div>
		<?php if ( ! empty( $the_title ) ) { ?>
			<h3 class="priority-title font-weight-600"><?php echo esc_attr( $the_title ); ?></h3>
			<hr class="hrule">
		<?php } ?>
		<?php if ( ! empty( $fact_sheet ) ) { ?>
			<span class="display-block small-caps">Fact Sheet</span>
			<span class="priority-file-name"><?php echo esc_attr( $fact_sheet['title'] ); ?></span>
			<a href="<?php echo esc_url( $fact_sheet['url'] ); ?>" target="_blank"><button class="has-arrow-down">Download</button></a>
		<?php } ?>
	</article><!-- .priority-block -->

	<?php
}
