import Glide from '@glidejs/glide';

/**
 * @module Slider
 *
 * @description
 *
 * Member Logo Block Class
 *
 */
export default class MemberLogos {

	/**
	 * Initialize everything
	 *
	 * @returns {null}
	 */
	constructor() {

		const glides = document.querySelectorAll( '.member-logos-block .glide' );

		/**
		 * Initialize everything
		 *
		 * @returns {null}
		 */
		const snakeToCamelCase = ( s ) => {
			return s.replace(
				/-([a-z])/g,
				function( g ) {
					return g[1].toUpperCase();
				}
			);
		};

		/**
		 * Initialize everything
		 *
		 * @returns {null}
		 */
		const calculateNumberOfSlides = ( glide ) => {
			const viewWidth = glide.offsetWidth;
			const slideWidth = Number( glide.getAttribute( 'data-slide-width' ) );
			const gap = Number( glide.getAttribute( 'data-glide-gap' ) );
			return Math.ceil( viewWidth / ( slideWidth + gap ) );
		};

		/**
		 * Initialize everything
		 *
		 * @returns {null}
		 */
		const calculateGap = ( glide ) => {
			const viewWidth = glide.offsetWidth;
			const gap = 768 > viewWidth ? 20 : 30;
			return gap;
		};

		glides.forEach( item => {
			if ( item.hasAttributes() ) {
				const options = [];
				const attrs = item.attributes;
				for ( let i = 0; i < attrs.length; i++ ) {
					// Find all data-glide- attributes
					const name = attrs[i].name.split( 'data-glide-' );

					if ( name[1] !== undefined ) {
						// Camelcase the attribute name
						const cameledName = snakeToCamelCase( name[1].toString() );
						// Check if attribute value is a number
						const number = Number( attrs[i].value );
						// Assign string to options if not a number; otherwise, assign number
						options[cameledName] = Number.isNaN( number ) ? attrs[i].value : number;

						// Update gap between slides based on window width
						if ( options['gap'] !== undefined ) {
							options['gap'] = calculateGap( item );
						}

						// Update number of slides shown based on window width
						if ( options['perView'] !== undefined ) {
							options['perView'] = calculateNumberOfSlides( item );
						}

					}
				}

				const glide = new Glide( item, options ).mount();
				window.addEventListener( 'resize', function() {
					const gap = calculateGap( item );
					const numberOfSlides = calculateNumberOfSlides( item );
					glide.pause();
					glide.update( {
						perView: numberOfSlides,
						gap: gap
					} );
					glide.play();
				} );
			}
		} );
	}
}
