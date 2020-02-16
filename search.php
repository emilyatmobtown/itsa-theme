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
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/SearchResultsPage">
		<div class="row max-width">
			<header class="entry-header">
				<h1 class="entry-title">
					<?php if ( have_posts() ) { ?>

						<?php
						/* translators: the search query */
						printf( esc_html__( 'Search Results for: %s', 'itsa-theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
						?>

				<?php } else { ?>

						<?php
						/* translators: the search query - no results found */
						printf( esc_html__( 'No Results Found for: %s', 'itsa-theme' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
						?>
				<?php } ?>

				</h1>
			</header><!-- .entry-header -->
		</div><!-- .row -->
		<?php if ( have_posts() ) { ?>

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

		<?php } else { ?>

			<div class="row max-width">
				<h2><?php esc_html_e( 'Please search again:', 'isa-theme' ); ?></h2>
				<div id="site-search-results-page" class="search-form-wrapper">
					<?php get_search_form(); ?>
				</div><!-- .search-form-wrapper -->
			</div><!-- .row -->

		<?php } ?>
	</article>
	<?php get_template_part( 'partials/aside' ); ?>
</main>
<?php
get_footer();
