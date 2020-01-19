<?php
/**
 * Template part for displaying Silo content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

use ITSATheme\Utility;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-width' ); ?>>
	<?php if ( ! Utility\has_block( 'acf/header' ) ) { ?>
		<div class="row max-width">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		</div><!-- .row -->
	<?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
