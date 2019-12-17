<?php
/**
 * Template part for displaying page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;

global $post;
$blocks = parse_blocks( $post->post_content );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! Utility\has_block( $blocks, 'acf/header' ) ) { ?>
		<div class="row max-width">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		</div><!-- .row -->
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<div class="row max-width">
		<footer class="entry-footer">
			<h2 class="entry-footer-title font-weight-600">Related</h2>
		</footer><!-- .entry-footer -->
	</div><!-- .row -->
</article><!-- #post-<?php the_ID(); ?> -->
