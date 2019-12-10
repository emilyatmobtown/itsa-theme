<?php
/**
 * The template for displaying the footer.
 *
 * @package ITSATheme
 */

?>

		<footer id="colophon" class="site-footer reverse-color">
			<div class="site-footer-content max-width">
				<div class="flex-container">
					<?php for ( $i = 1; $i <= 5; $i++ ) { ?>
						<?php if ( is_active_sidebar( 'footer-column-' . $i ) ) { ?>
							<div class="site-footer-column flex-item">
								<?php dynamic_sidebar( 'footer-column-' . $i ); ?>
							</div><!-- .site-footer-column -->
						<?php } ?>
					<?php } ?>
				</div><!--.flex-container-->
			</div><!-- .site-footer-content -->
		</footer><!-- #colophon -->
		</div><!-- #page -->

	<?php wp_footer(); ?>
	<script>
	</script>
	</body>
</html>
