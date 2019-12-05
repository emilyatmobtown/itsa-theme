<?php
/**
 * The main template file
 *
 * @package ITSATheme
 */

get_header(); ?>

<main id="main" class="site-main">

<?php
if ( have_posts() ) {

	if ( is_home() && ! is_front_page() ) {
		?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
		<?php
	}

	/* Start the Loop */
	while ( have_posts() ) {
		the_post();

		get_template_part( 'partials/content', get_post_type() );

	}
} else {

	get_template_part( 'partials/content', 'none' );

}

get_template_part( 'partials/content-footer', 'none' );

?>

</main><!-- #main -->

<?php
get_footer();
