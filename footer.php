<?php
/**
 * The template for displaying the footer.
 *
 * @package ITSATheme
 */

?>

<?php
if ( function_exists( 'ITSACoreFunctionality\block_area' ) ) {
	ITSACoreFunctionality\block_area()->show( 'quote-slider' );
}
?>

		<footer id="colophon" class="site-footer reverse-color">
			<div class="site-footer-content flex-container">
				<?php for ( $i = 1; $i <= 5; $i++ ) { ?>
					<?php if ( is_active_sidebar( 'footer-column-' . $i ) ) { ?>
						<div class="site-footer-column flex-item">
							<?php dynamic_sidebar( 'footer-column-' . $i ); ?>
						</div><!-- .site-footer-column -->
					<?php } ?>
				<?php } ?>
			</div><!-- .site-footer-content -->
		</footer><!-- #colophon -->
		</div><!-- #page -->

	<?php wp_footer(); ?>
	<script>
		new Glide('.glide').mount()
	</script>
	</body>
</html>
