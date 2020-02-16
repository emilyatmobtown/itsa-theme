/**
 * @module SocialBar
 *
 * @description
 *
 * Handles the fixed social bar on posts.
 *
 */
export default class SocialBar {

	/**
	 * Initialize everything
	 *
	 * @returns {null}
	 */
	constructor() {
		this.main = document.getElementById( 'main' );
		if ( ! this.main ) {
			console.error( 'SocialBar: No main.' ); // eslint-disable-line
			return;
		}

		this.masthead = document.getElementById( 'masthead' );
		if ( ! this.masthead ) {
			console.error( 'SocialBar: No masthead.' ); // eslint-disable-line
			return;
		}

		this.bar = this.main.getElementsByClassName( 'entry-meta-social' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.bar ) {
			console.error( 'SocialBar: No social bar.' ); // eslint-disable-line
			return;
		}

		this.header = this.main.getElementsByTagName( 'header' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.header ) {
			console.warning( 'SocialBar: No header.' ); // eslint-disable-line
		}

		this.meta = this.main.getElementsByClassName( 'entry-meta' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.meta ) {
			console.warning( 'SocialBar: No meta.' ); // eslint-disable-line
		}

		this.addScrollHandler();

		// window.addEventListener( 'scroll', function( socialBar ) {
		// 	socialBar.affixSocialBar( socialBar.header, socialBar.bar, socialBar.meta, );
		// } ).bind( this );
	}

	/**
	 * Toggles search
	 *
	 * @param   {element} header The header
	 * @param   {element} bar    The social bar
	 * @param   {element} meta   The meta section
	 *
	 * @returns {null}
	 */
	addScrollHandler() {
		window.addEventListener( 'scroll', () => {
			this.affixSocialBar();
		} );
	}

	/**
	 * Toggles search
	 *
	 * @param   {element} header The header
	 * @param   {element} bar    The social bar
	 * @param   {element} meta   The meta section
	 *
	 * @returns {null}
	 */
	affixSocialBar() {
		const scroll  = window.scrollY;
		const offset  = this.header.offsetTop + this.masthead.offsetTop + this.meta.offsetTop - 100;
		const affixed = this.bar.classList.contains( 'affixed' );

		if ( scroll >= offset && ! affixed ) {
			this.bar.classList.add( 'affixed' );
		} else if ( scroll <= offset && affixed ) {
			this.bar.classList.remove( 'affixed' );
		}
	}

}
