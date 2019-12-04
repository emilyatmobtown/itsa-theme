/**
 * @module RemoveBlockStyles
 *
 * @description
 *
 * Removes WP Core block styles.
 *
 */
export default class RemoveBlockStyles {

	/**
	 * Initialize everything
	 *
	 * @returns {null}
	 */
	constructor() {
		wp.domReady( () => {
			wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );
			wp.blocks.unregisterBlockStyle( 'core/image', 'circle-mask' );
			wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );
			wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
			wp.blocks.unregisterBlockStyle( 'core/pullquote', 'solid-color' );
			wp.blocks.unregisterBlockStyle( 'core/separator', 'wide' );
			wp.blocks.unregisterBlockStyle( 'core/separator', 'dots' );
			wp.blocks.unregisterBlockStyle( 'core/table', 'stripes' );
			wp.blocks.unregisterBlockStyle( 'core/social-links', 'logos-only' );
			wp.blocks.unregisterBlockStyle( 'core/social-links', 'pill-shape' );
		} );
	}
}
