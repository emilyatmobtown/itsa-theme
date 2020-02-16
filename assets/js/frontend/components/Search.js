/**
 * @module Search
 *
 * @description
 *
 * Handles toggling the search form for large screens.
 *
 */
export default class Search {

	/**
	 * Initialize everything
	 *
	 * @returns {null}
	 */
	constructor() {
		this.container = document.getElementById( 'site-search-top' );
		if ( ! this.container ) {
			console.error( 'Search: No search container.' ); // eslint-disable-line
			return;
		}

		this.input = this.container.getElementsByTagName( 'input' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.input ) {
			console.error( 'Search: No search input.' ); // eslint-disable-line
			return;
		}

		this.button = this.container.getElementsByTagName( 'span' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.button ) {
			console.error( 'Search: No search button.' ); // eslint-disable-line
			return;
		}
		this.toggleSearch( this.container, this.input, this.button );
	}

	/**
	 * Toggles search
	 *
	 * @param   {element} container The header
	 * @param   {element} input     The search input element
	 * @param   {element} button    The search toggling button
	 *
	 * @returns {null}
	 */
	toggleSearch( container, input, button ) {
		button.onclick = function() {
			if ( -1 !== container.className.indexOf( 'search-toggled' ) ) {
				container.className = container.className.replace( ' search-toggled', '' );
			} else {
				container.className += ' search-toggled';
			}
		};
	}

}
