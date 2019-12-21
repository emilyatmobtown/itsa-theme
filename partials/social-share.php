<?php
/**
 * Template part for displaying the social share
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */
?>

<div class="entry-meta-social reverse-color">
	<span class="entry-meta-text">
		<?php
		// translators: This is the Share label for the list of social sharing icons.
		esc_html_e( 'Share', 'itsa-theme' );
		?>
	</span>
	<a class="icon social-icon twitter-icon" href="#"><span class="screen-reader-text">Twitter</span></a>
	<a class="icon social-icon facebook-icon" href="#"><span class="screen-reader-text">Facebook</span></a>
	<a class="icon social-icon instagram-icon" href="#"><span class="screen-reader-text">Instagram</span></a>
</div><!-- .entry-meta-social -->
