<?php
/**
 * The template for displaying the header.
 *
 * @package ITSATheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="theme-color" content="#001940" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content">
				<?php
					// translators: This is the screen reader text to skip to the content.
					esc_html_e( 'Skip to content', 'itsa-theme' );
				?>
			</a>

			<header id="masthead" class="site-header" role="header">
				<div class="site-header-content max-width">
					<?php if ( is_home() || is_front_page() ) { ?>}
							<h1 class="site-title">
									<?php
									if ( function_exists( 'the_custom_logo' ) ) {
										the_custom_logo();
									}
									?>
									<a href="<?php bloginfo( 'home_url' ); ?>" class="screen-reader-text" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1><!-- .site-title -->
				<?php } else { ?>
					<span class="site-title">
							<?php
							if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							}
							?>
							<a href="<?php bloginfo( 'home_url' ); ?>" class="screen-reader-text" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span><!-- .site-title -->
				<?php } ?>
					<button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false">
						<div class="menu-icon" aria-hidden="true">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
						<span class="screen-reader-text">Toggle Primary Navigation</span>
					</button>
					<div class="nav-bgrd"></div>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php
						wp_nav_menu(
							array(
								'menu'       => 'Primary Menu',
								'menu_id'    => 'primary-menu',
								'menu_class' => 'header-nav',
							)
						);
						?>
					</nav><!-- #site-navigation -->
				</div><!-- .site-header-content -->
			</header><!-- #masthead -->
