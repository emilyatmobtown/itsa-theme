<?php
/**
 * Template part for displaying search content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'item', 'has-background', 'has-overlay', 'block-style-solid', 'search-item' ) ); ?> itemscope itemtype="https://schema.org/Thing">
	<?php the_title( '<h2 class="entry-title item-title">', '</h2>' ); ?>

	<div class="entry-content" itemprop="description">
		<?php itsa_the_excerpt( null, false, true ); ?>
		<?php itsa_the_post_button(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
