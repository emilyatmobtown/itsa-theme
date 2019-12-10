<?php
/**
 * Template part for displaying the content footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */
?>

<aside class="content-footer" role="complementary">

	<?php
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
