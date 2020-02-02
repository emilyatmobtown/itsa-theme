<?php
/**
 * Template part for displaying the Tweets block
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

$handle     = get_theme_mod( 'twitter_handle' );
$max_tweets = 3;

if ( is_admin() && empty( $handle ) ) {
	?>
	<h2 role="textbox" aria-multiline="true" class="rich-text editor-rich-text__editable block-editor-rich-text__editable" contenteditable="true" aria-label="Go to Customizer > Social and enter Twitter handle to view tweets." style="white-space: pre-wrap;">﻿<span data-rich-text-placeholder="Go to Customizer > Social and enter Twitter handle to view tweets." contenteditable="false"></span></h2>
	<?php
} elseif ( ! empty( $handle ) ) {

	?>
	<div class="row max-width">
		<section class="section block tweets-block">
			<div class="item-grid no-wrap has-background inverse-color">

				<?php for ( $i = 0; $i < $max_tweets; $i++ ) { ?>

						<article class="item has-background has-overlay block-style-solid">
							<p class="tweet-text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
							<a class="small-caps display-block tweet-link tweet-date" target="_blank">January 1, 2020</a>
						</article>

				<?php } ?>

			</div><!-- .item-grid -->
		</section><!-- .section -->
	</div><!-- .row -->
	<?php
}
