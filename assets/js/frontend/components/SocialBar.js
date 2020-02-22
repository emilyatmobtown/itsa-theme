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
			console.warn( 'SocialBar: No main.' ); // eslint-disable-line
			return;
		}

		this.masthead = document.getElementById( 'masthead' );
		if ( ! this.masthead ) {
			console.warn( 'SocialBar: No masthead.' ); // eslint-disable-line
			return;
		}

		this.bar = this.main.getElementsByClassName( 'entry-meta-social' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.bar ) {
			console.log( 'SocialBar: No social bar.' ); // eslint-disable-line
			return;
		}

		this.sibling = this.bar.nextElementSibling; // eslint-disable-line
		if ( 'undefined' === typeof this.sibling ) {
			console.warn( 'SocialBar: No content. Removed social bar.' ); // eslint-disable-line
			this.removeSocialBar();
			return;
		}

		this.header = this.main.getElementsByTagName( 'header' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.header ) {
			console.warn( 'SocialBar: No header.' ); // eslint-disable-line
		}

		this.meta = this.main.getElementsByClassName( 'entry-meta' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.meta ) {
			console.warn( 'SocialBar: No meta.' ); // eslint-disable-line
		}

		this.aside = this.main.getElementsByTagName( 'aside' )[0]; // eslint-disable-line
		if ( 'undefined' === typeof this.aside ) {
			console.warn( 'SocialBar: No aside.' ); // eslint-disable-line
		}

		this.adjustLeftPosition();
		this.addResizeHandler();
		this.addScrollHandler();
	}

	/**
	 * Adds resize event listener
	 *
	 * @returns {null}
	 */
	addResizeHandler() {
		window.addEventListener( 'resize', () => {
			this.adjustLeftPosition();
		} );
	}

	/**
	 * Adds scoll event listener
	 *
	 * @returns {null}
	 */
	addScrollHandler() {
		window.addEventListener( 'scroll', () => {
			this.stickSocialBar();
		} );
	}

	/**
	 * Hides social bar
	 *
	 * @returns {null}
	 */
	removeSocialBar() {
		this.bar.remove();
	}

	/**
	 * Adjusts left position of social bar
	 *
	 * @returns {null}
	 */
	adjustLeftPosition() {
		const viewportWidth = Math.max( document.documentElement.clientWidth, window.innerWidth || 0 );

		/* CSS uses --bp-xlarge, which is 80em or 1280px */
		if ( 1280 <= viewportWidth ) {
			const scrollLeft     = window.pageXOffset || document.documentElement.scrollLeft;
			const offsetLeft     = this.sibling.getBoundingClientRect().left;
			const availableWidth = scrollLeft + offsetLeft;
			const barWidth       = this.bar.offsetWidth;
			const marginLeft     = availableWidth - barWidth;

			/* Avoid negative margin */
			this.bar.style.marginLeft = 0 < marginLeft ? `${marginLeft}px` : '0';
		} else {
			this.bar.style.marginLeft = 'auto';
		}
	}

	/**
	 * Sticks and unsticks social bar
	 *
	 * @returns {null}
	 */
	stickSocialBar() {
		const scroll              = window.scrollY;
		const addToDistanceTop    = this.masthead.offsetHeight + this.meta.offsetHeight;
		const addToDistanceBottom = addToDistanceTop + this.bar.offsetHeight + 25; /* margin-bottom on last item in entry-content */
		const distanceToTop       = this.header.offsetTop + this.masthead.offsetTop + this.meta.offsetTop - addToDistanceTop;
		const distanceToBottom    = this.aside.offsetTop - addToDistanceBottom;
		const stuckTop            = this.main.classList.contains( 'stuckTop' );
		const stuckBottom         = this.main.classList.contains( 'stuckBottom' );
		const stickToTop          = ( scroll >= distanceToTop ) && ( scroll < distanceToBottom );
		const stickToBottom       = ( scroll >= distanceToBottom );

		if ( stickToTop && ! stuckTop ) {
			this.main.classList.add( 'stuckTop' );
		} else if ( ! stickToTop && stuckTop ) {
			this.main.classList.remove( 'stuckTop' );
		}

		if ( stickToBottom && ! stuckBottom ) {
			this.main.classList.add( 'stuckBottom' );
		} else if ( ! stickToBottom && stuckBottom ) {
			this.main.classList.remove( 'stuckBottom' );
		}
	}
}
