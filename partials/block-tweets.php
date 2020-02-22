<?php
/**
 * Template part for displaying the Tweets block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$handle        = get_theme_mod( 'twitter_handle' );
$tweet_classes = explode( ' ', 'item has-background has-overlay block-style-solid' );

if ( is_admin() && empty( $handle ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Go to Customizer > Social and enter Twitter handle to view tweets." style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Go to Customizer > Social and enter Twitter handle to view tweets." contenteditable="false"></span></h2>
	<?php
} elseif ( ! empty( $handle ) ) {

	?>
	<div class="row max-width">
		<section class="section block tweets-block">
			<div class="item-grid no-wrap has-background inverse-color">

				<?php ITSACoreFunctionality\display_tweets( $handle, $tweet_classes ); ?>

			</div><!-- .item-grid -->
		</section><!-- .section -->
	</div><!-- .row -->
	<?php
}
