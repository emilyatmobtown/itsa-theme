<?php
/**
 * Template part for displaying the aside
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */
?>

<aside class="content-footer" role="complementary">

	<?php
	// Show Partner Info Block Area only on silo pages
	if ( function_exists( 'ITSACoreFunctionality\block_area' ) && 'silo' === get_post_type() ) {
		ITSACoreFunctionality\block_area()->show( 'partner-info-block' );
	}

	// Show Member Logo block everywhere except on the Membership page
	if ( function_exists( 'ITSACoreFunctionality\block_area' ) && ! is_page( 'membership' ) ) {
		ITSACoreFunctionality\block_area()->show( 'membership-call-to-action-block' );
	}

	if ( function_exists( 'ITSACoreFunctionality\block_area' ) ) {
		ITSACoreFunctionality\block_area()->show( 'quote-slider-block' );
	}

	if ( function_exists( 'ITSACoreFunctionality\block_area' ) ) {
		ITSACoreFunctionality\block_area()->show( 'member-logo-slider-block' );
	}
	?>

</aside>
