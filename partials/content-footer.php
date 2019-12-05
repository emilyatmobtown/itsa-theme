<?php
/**
 * Template part for displaying the content footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ITSATheme
 */

if ( function_exists( 'ITSACoreFunctionality\block_area' ) ) {
	ITSACoreFunctionality\block_area()->show( 'membership-call-to-action-block' );
}

if ( function_exists( 'ITSACoreFunctionality\block_area' ) ) {
	ITSACoreFunctionality\block_area()->show( 'quote-slider-block' );
}
