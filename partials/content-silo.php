<?php
/**
 * Template part for displaying Silo content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'entry-content', 'full-width' ) ); ?>>
	<?php the_content(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
