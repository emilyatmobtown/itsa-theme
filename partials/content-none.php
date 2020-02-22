<?php
/**
 * Template part for displaying the response to no results found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row max-width">
		<h2><?php esc_html_e( 'So sorry!', 'isa-theme' ); ?></h2>
		<p><?php esc_html_e( 'We could not find what you\'re looking for. Please try again.', 'isa-theme' ); ?></p>
		<div id="site-search-404-page" class="search-form-wrapper">
			<?php get_search_form(); ?>
		</div><!-- .search-form-wrapper -->
	</div><!-- .row -->
</article>
