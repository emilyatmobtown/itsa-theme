/* global process, module, require */

const path = require( 'path' );
const CleanWebpackPlugin = require( 'clean-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );
const WebpackBar = require( 'webpackbar' );

const isProduction = 'production' === process.env.NODE_ENV;

// Config files.
const settings = require( './webpack.settings.js' );

/**
 * Configure entries.
 */
const configureEntries = () => {
	const entries = {};

	for ( const [ key, value ] of Object.entries( settings.entries ) ) { // eslint-disable-line
		entries[ key ] = path.resolve( process.cwd(), value );
	}

	return entries;
};

module.exports = {
	entry: configureEntries(),
	output: {
		path: path.resolve( process.cwd(), settings.paths.dist.base ),
		filename: settings.filename.js,
	},

	// Console stats output.
	// @link https://webpack.js.org/configuration/stats/#stats
	stats: settings.stats,

	// External objects.
	externals: {
		jquery: 'jQuery',
	},

	// Performance settings.
	performance: {
		maxAssetSize: settings.performance.maxAssetSize,
	},

	// Build rules to handle asset files.
	module: {
		rules: [
			// Lint JS.
			{
				test: /\.js$/,
				exclude: /node_modules/,
				enforce: 'pre',
				loader: 'eslint-loader',
				options: {
					fix: true
				}
			},

			// Scripts.
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: [
								[ '@babel/preset-env', {
									'useBuiltIns': 'usage',
									'corejs': 3,
								} ]
							],
							cacheDirectory: true,
							sourceMap: ! isProduction,
						},
					},
				],
			},

			// Styles.
			{
				test: /\.(sa|sc|c)ss$/,
				include: path.resolve( process.cwd(), settings.paths.src.css ),
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
					},
					{
						loader: 'css-loader',
						options: {
							importLoaders: 2,
							sourceMap: ! isProduction,
							// We copy fonts etc. using CopyWebpackPlugin.
							url: false,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: ! isProduction,
						},
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: ! isProduction,
						}
					},
				],
			},
		],
	},

	plugins: [

		// Remove the extra JS files Webpack creates for CSS entries.
		// This should be fixed in Webpack 5.
		new FixStyleOnlyEntriesPlugin( {
			silent: true,
		} ),

		// Clean the `dist` folder on build.
		new CleanWebpackPlugin( {
			// Protect static assets from removal during watch
			cleanStaleWebpackAssets: false,
		} ),

		// Extract CSS into individual files.
		new MiniCssExtractPlugin( {
			filename: settings.filename.css,
			chunkFilename: '[id].css',
		} ),

		// Copy static assets to the `dist` folder.
		new CopyWebpackPlugin( [
			{
				from: settings.copyWebpackConfig.static.from,
				to: settings.copyWebpackConfig.static.to,
				context: path.resolve( process.cwd(), settings.paths.src.base ),
			},
			{
				from: settings.copyWebpackConfig.vendor.from,
				to: settings.copyWebpackConfig.vendor.to,
				context: path.resolve( process.cwd(), settings.paths.src.base ),
			},
		] ),

		// Lint CSS.
		new StyleLintPlugin( {
			context: path.resolve( process.cwd(), settings.paths.src.css ),
			files: '**/*.s?(a|c)ss',
		} ),

		// Fancy WebpackBar.
		new WebpackBar(),
	],
};
