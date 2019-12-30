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

	<h1 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Add a subtitle" style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Add a Priority..." contenteditable="false"></span></h1>

	<?php
} elseif ( ! empty( $the_title ) && ! empty( $image ) ) {
	?>

	<article class="priority-block has-background has-overlay" style="background-image:url(<?php echo esc_url( $image['sizes']['itsa-section-background'] ); ?>)">
		<div class="image-placeholder has-overlay" style="background-image:url(<?php echo esc_url( $image['sizes']['itsa-section-background'] ); ?>)"></div>
		<?php if ( ! empty( $the_title ) ) { ?>
			<h3 class="priority-title font-weight-600"><?php echo esc_attr( $the_title ); ?></h3>
			<hr class="hrule">
		<?php } ?>
		<?php if ( ! empty( $fact_sheet ) ) { ?>
			<span class="display-block small-caps"><?php esc_html_e( 'Fact Sheet', 'itsa-theme' ); ?></span>
			<span class="priority-file-name"><?php echo esc_attr( $fact_sheet['title'] ); ?></span>
			<a href="<?php echo esc_url( $fact_sheet['url'] ); ?>" target="_blank"><button class="has-arrow-down"><?php esc_html_e( 'Download', 'itsa-theme' ); ?></button></a>
		<?php } ?>
	</article><!-- .priority-block -->

	<?php
}
