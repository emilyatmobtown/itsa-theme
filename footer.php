<?php
/**
 * The template for displaying the footer.
 *
 * @package ITSATheme
 */

?>

			<footer id="site-footer" class="site-footer inverse-color">
				<div class="row max-width site-footer-content">
					<?php for ( $i = 1; $i <= 5; $i++ ) { ?>
						<?php if ( is_active_sidebar( 'footer-column-' . $i ) ) { ?>
							<div class="site-footer-column flex-item">
								<?php dynamic_sidebar( 'footer-column-' . $i ); ?>
							</div><!-- .site-footer-column -->
						<?php } ?>
					<?php } ?>
				</div><!-- .site-footer-content -->
			</footer><!-- .site-footer -->
		</div><!-- #page -->

	<?php wp_footer(); ?>
	</body>
</html>
