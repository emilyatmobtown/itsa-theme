<?php
/**
 * The template for displaying search results pages.
 *
 * @package ITSATheme
 */

global $wp_query;
global $paged;

get_header(); ?>
<main id="main" class="site-main">
	<?php if ( have_posts() ) { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/SearchResultsPage">
			<div class="row max-width">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php
						/* translators: the search query */
						printf( esc_html__( 'Search Results for: %s', 'itsa-theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
						?>
					</h1>
				</header><!-- .entry-header -->
			</div><!-- .row -->
				<div class="row max-width">
					<section class="section block post-grid-block">
						<div class="item-grid has-background inverse-color">
							<?php while ( have_posts() ) { ?>
								<?php the_post(); ?>
								<?php get_template_part( 'partials/content', 'search' ); ?>
							<?php } ?>
						</div>
						<?php
							the_posts_navigation(
								array(
									'prev_text'          => __( 'Previous', 'itsa-theme' ),
									'next_text'          => __( 'Next', 'itsa-theme' ),
									'screen_reader_text' => __( 'Search Navigation', 'itsa-theme' ),
								)
							);
						?>
					</section>
				</div><!-- .row -->

		</article>
	<?php } else { ?>
		<?php get_template_part( 'partials/content', 'none' ); ?>
	<?php } ?>
	<?php get_template_part( 'partials/aside' ); ?>
</main>
<?php
get_footer();
