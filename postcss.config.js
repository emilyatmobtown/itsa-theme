/**
 * Exports the PostCSS configuration.
 *
 * @return {string} PostCSS options.
 */
module.exports = ( { file, options, env } ) => ( { /* eslint-disable-line */
	plugins: {
		'postcss-import': {},
		'postcss-preset-env': {
			stage: 0,
			autoprefixer: {
				grid: true
			}
		},
		// Prefix editor styles with class `editor-styles-wrapper`.
		'postcss-editor-styles': 'editor-style.scss' === file.basename ?
			{
				scopeTo: '.editor-styles-wrapper',
				ignore: [
					':root',
					'.edit-post-visual-editor.editor-styles-wrapper',
					'.wp-toolbar',
				],
				remove: [
					'html',
					':disabled',
					'[readonly]',
					'[disabled]',
				],
				tags: [
					'a',
					'button',
					'input',
					'label',
					'select',
					'textarea',
					'form',
					'ul',
					'li',
				],
				tagSuffix:
					':not(.button):not([class^="acf-"]):not([class^="glide"]):not(.link-url):not([class^="components-"]):not([class^="editor-"]):not([class^="block-"]):not([aria-owns]):not([id^="mceu_"])'
			} : false,
		// Minify style on production using cssano.
		cssnano: 'production' === env ?
			{
				preset: [
					'default', {
						autoprefixer: false,
						calc: {
							precision: 8
						},
						convertValues: true,
						discardComments: {
							removeAll: true
						},
						mergeLonghand: false,
						zindex: false,
					},
				],
			} : false,
	},
} );
