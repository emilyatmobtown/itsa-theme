<?php
/**
 * The single news template file
 *
 * @package ITSATheme
 */

get_header(); ?>

<main id="main" class="site-main">

<?php
if ( have_posts() ) {

	/* Start the Loop */
	while ( have_posts() ) {
		the_post();

		get_template_part( 'partials/content', get_post_type() );

	}
} else {

	get_template_part( 'partials/content', 'none' );

}

get_template_part( 'partials/entry-footer' );
get_template_part( 'partials/aside' );

?>

</main><!-- #main -->

<?php
get_footer();
