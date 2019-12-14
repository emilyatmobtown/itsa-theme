/* global module */

// Webpack settings exports.
module.exports = {
	entries: {
		// JS files.
		'admin': './assets/js/admin/admin.js',
		'blocks': './assets/js/blocks/blocks.js',
		'frontend': './assets/js/frontend/frontend.js',
		'shared': './assets/js/shared/shared.js',
		'styleguide': './assets/js/styleguide/styleguide.js',
		'blocks-editor': './inc/blocks/blocks-editor.js',

		// CSS files.
		'admin-style': './assets/css/admin/admin-style.scss',
		'editor-style': './assets/css/frontend/editor-style.scss',
		'shared-style': './assets/css/shared/shared-style.scss',
		'style': './assets/css/frontend/style.scss',
		'styleguide-style': './assets/css/styleguide/styleguide.scss'
	},
	filename: {
		js: 'js/[name].js',
		css: 'css/[name].css'
	},
	paths: {
		src: {
			base: './assets/',
			css: './assets/css/',
			js: './assets/js/'
		},
		dist: {
			base: './dist/',
			clean: ['./images', './css', './js', './vendor']
		},
	},
	stats: {
		// Copied from `'minimal'`.
		all: false,
		errors: true,
		maxModules: 0,
		modules: true,
		warnings: true,
		// Our additional options.
		assets: true,
		errorDetails: true,
		excludeAssets: /\.(jpe?g|png|gif|svg|woff|woff2)$/i,
		moduleTrace: true,
		performance: true
	},
	copyWebpackConfig: {
		static: {
			from: '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
			to: '[path][name].[ext]'
		},
		vendor: {
			from: 'vendor/*.{js,css}',
			to: '[path][name].[ext]'
		}
	},
	BrowserSyncConfig: {
		host: 'localhost',
		port: 3000,
		proxy: 'http://itsa.test',
		open: false,
		files: [
			'**/*.php',
			'dist/js/**/*.js',
			'dist/css/**/*.{css,scss}',
			'dist/svg/**/*.svg',
			'dist/images/**/*.{jpg,jpeg,png,gif}',
			'dist/fonts/**/*.{eot,ttf,woff,woff2,svg}',
			'dist/vendor/**/*.{js,css}'
		]
	},
	performance: {
		maxAssetSize: 100000
	},
	manifestConfig: {
		basePath: ''
	},
};
