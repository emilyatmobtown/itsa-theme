<?php
/**
 *
 * @package ITSATheme
 */

global $wp_query;

$types  = get_terms(
	array(
		'taxonomy' => 'news-type',
		'orderby'  => 'name',
	)
);
$issues = get_terms(
	array(
		'taxonomy' => 'issue',
		'orderby'  => 'name',
	)
);

$queried = get_queried_object();

get_header(); ?>

<main id="main" class="site-main">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="row max-width">
			<header class="entry-header">
				<h1 class="entry-title"><?php echo esc_attr( $queried->name ); ?></h1>
			</header><!-- .entry-header -->
		</div><!-- .row -->

		<div class="entry-content">
		<?php if ( have_posts() ) { ?>
			<div class="row max-width">
				<section id="post-grid-filtered" class="section block post-grid-block post-archive-block">
					<div class="cap-wrapper">
						<form id="post-grid-filter" class="post-grid-form">
							<div id="post-grid-filter-loader" class="loader-icon hidden"></div>
							<label class="small-caps label-inline-md" for="post-grid-filter-by-issue"><?php esc_html_e( 'Filter By', 'itsa-theme' ); ?>:</label>
							<?php if ( ! empty( $types ) ) { ?>
								<select class="select-inline-md" name="post-grid-filter-by-type" id="post-grid-filter-by-type">
									<option value="0">All</option>
									<?php foreach ( $types as $ptype ) { ?>
										<option value="<?php echo esc_attr( $ptype->term_id ); ?>" <?php echo esc_attr( $ptype->term_id === $queried->term_taxonomy_id ? 'selected' : '' ); ?>><?php echo esc_attr( $ptype->name ); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
							<?php if ( ! empty( $issues ) ) { ?>
								<select class="select-inline-md" name="post-grid-filter-by-issue" id="post-grid-filter-by-issue">
									<option value="0">All</option>
									<?php foreach ( $issues as $issue ) { ?>
										<option value="<?php echo esc_attr( $issue->term_id ); ?>"><?php echo esc_attr( $issue->name ); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
							<input type="hidden" name="action" value="post-grid-filter" />
							<input type="hidden" name="post-type" value="news" />
							<input type="hidden" name="filter-nonce" value="<?php echo esc_attr( wp_create_nonce( 'post-grid-filter-nonce' ) ); ?>" />
						</form>
					</div><!-- .cap-wrapper -->
					<div id="post-grid-filter-results" class="item-grid has-background inverse-color">
						<?php while ( have_posts() ) { ?>
							<?php the_post(); ?>
							<?php set_query_var( 'header_content', 'title_and_tags' ); ?>
							<?php get_template_part( 'partials/content', 'news' ); ?>
						<?php } ?>
					</div><!-- .item-grid -->

					<?php if ( $wp_query->max_num_pages > 1 ) { ?>
						<a id="post-grid-load-more" class="section-link more-link has-arrow has-arrow-down display-block">See More News</a>
						<div id="post-grid-load-more-loader" class="loader-icon hidden"></div>
					<?php } ?>

					<?php
						$script = "
						var currentPageMyAjax = 1,
							postsMyAjax       = '" . wp_json_encode( $wp_query->query_vars ) . "',
							maxPageMyAjax     =  " . $wp_query->max_num_pages . ",
							ajaxUrl           = '" . admin_url( 'admin-ajax.php' ) . "',
							postType          = 'news',
							loadMoreNonce     = '" . wp_create_nonce( 'post-grid-load-more-nonce' ) . "'";
						wp_add_inline_script( 'frontend', $script )
					?>

				</section><!-- .section -->
			</div><!-- .row -->

			<?php

		} else {

			get_template_part( 'partials/content', 'none' );

		}

			get_template_part( 'partials/aside' );

		?>
		</div><!-- .entry-content -->
	</article>
</main><!-- #main -->

<?php
get_footer();
