/**
 * @module ResponsiveBackgroundImage
 *
 * @description
 *
 * Generates background image for div from hidden responsive image inside div.
 *
 */
export default class ResponsiveBackgroundImage {

	/**
	 * Initialize everything
	 *
	 * @returns {null}
	 */
	constructor( element ) {
		this.element = element;
		this.picture = element.querySelector( 'picture' );
		this.img     = this.picture.querySelector( 'img' );
		this.src     = '';

		this.img.addEventListener( 'load', () => {
			this.update();
		} );

		if ( this.img.complete ) {
			this.update();
		}
	}

	/**
	 * Replaces the image
	 *
	 * @returns {null}
	 */
	update() {
		console.log( 'here' );
		const img = this.picture.querySelector( 'img' );
		console.log( img );
		const src = typeof 'undefined' !== img.currentSrc ? img.currentSrc : img.src;
		console.log( src );
		if ( this.src !== src ) {
			this.src = src;
			this.element.style.backgroundImage = `url("${  this.src  }")`;
		}
	}
}
