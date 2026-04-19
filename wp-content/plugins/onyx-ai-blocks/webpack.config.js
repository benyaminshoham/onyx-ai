const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const path = require( 'path' );

const blocks = [
	'hero',
	'audience-fork',
	'pillars',
	'proof-strip',
	'service-card',
	'recorded-card',
	'section-label',
	'tag-badge',
	'cta-button',
	'testimonial',
	'newsletter-optin',
	'about-teaser',
	'faq-accordion',
];

const entry = blocks.reduce( ( acc, block ) => {
	acc[ block ] = path.resolve( __dirname, `src/${ block }/index.js` );
	return acc;
}, {} );

// Replace the default MiniCssExtractPlugin so CSS lands at build/<block>/index.css
// matching the "style": "file:./index.css" references in each block.json.
const plugins = defaultConfig.plugins.map( ( plugin ) => {
	if ( plugin instanceof MiniCssExtractPlugin ) {
		return new MiniCssExtractPlugin( {
			filename: '[name]/index.css',
			chunkFilename: '[name]/index.css',
		} );
	}
	return plugin;
} );

module.exports = {
	...defaultConfig,
	entry,
	output: {
		...defaultConfig.output,
		path: path.resolve( __dirname, 'build' ),
		filename: '[name]/index.js',
	},
	plugins,
};
