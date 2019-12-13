<?php
/**
 * Template part for displaying News content
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
		<header class="row max-width entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php } ?>
	<div class="entry-content">
		<?php if ( is_singular( 'news' ) ) { ?>
			<div class="entry-meta">
			<?php if ( has_term( '', 'issue' ) ) { ?>
				<div class="entry-meta-centered">
					<div class="entry-meta-left">
						<span class="entry-meta-text">
							<?php
							// translators: This is the label for the list of Issues above a news article.
							esc_html_e( 'Issues: ', 'itsa-theme' );
							?>
						</span><!-- .entry-meta-text -->
						<?php echo get_the_term_list( $post->ID, 'issue', '<ul class="entry-categories"><li class="entry-category" rel="category tag">', ', </li><li class="entry-category">', '</li></ul>' ); ?>
						<?php } ?>
						<?php the_date( '', '<span class="entry-meta-text display-block"><time>', '</time></span>' ); ?>
					</div><!-- .entry-meta-left -->
					<span class="entry-meta-text"><?php echo esc_attr( ucwords( get_post_type() ) ); ?></span>
				</div><!-- .entry-meta-centered -->
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
			</div><!-- .entry-meta -->
		<?php } ?>
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
