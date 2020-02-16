<?php
/**
 * The template for displaying the search form.
 *
 * @package ITSATheme
 */

?>

<div itemscope itemtype="http://schema.org/WebSite">
	<form role="search" id="searchform" class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<meta itemprop="target" content="<?php echo esc_url( home_url() ); ?>/?s={s}" />
		<label for="search-field" class="screen-reader-text">
			<?php echo esc_html_e( 'Search for:', 'itsa-theme' ); ?>
		</label>
		<input class="input-text search-input display-inline-block" itemprop="query-input" type="search" id="search-field" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_e( 'Search', 'itsa-theme' ); ?>" name="s" /><span id="search-toggle" class="search-button search-toggle"></span><input type="submit" class="submit search-button search-submit" aria-label="<?php echo esc_attr_e( 'Submit', 'itsa-theme' ); ?>" value="">
	</form>
</div>
