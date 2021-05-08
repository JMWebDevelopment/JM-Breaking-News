const path = require( 'path' );
const webpack = require( 'webpack' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );

// Set different CSS extraction for editor only and common block styles
const blocksCSSPlugin = new MiniCssExtractPlugin( {
    filename: './blocks/css/blocks.style.css',
} );
const editBlocksCSSPlugin = new MiniCssExtractPlugin( {
    filename: './blocks/css/blocks.editor.css',
} );

// Configuration for the ExtractTextPlugin.
const extractConfig = {
    use: [
        { loader: 'raw-loader' },
        {
            loader: 'postcss-loader',
            options: {
				plugins: [ require( 'autoprefixer' ) ],
				minimize: true,
            },
        },
        {
            loader: 'sass-loader',
            query: {
                outputStyle:
                    'nested',
            },
        },
    ],
};

module.exports = {
    entry: {
        './public/js/editor.blocks' : './public/block/index.js',
        //'./assets/js/frontend.blocks' : './blocks/frontend.js',
    },
    output: {
        path: path.resolve( __dirname ),
        filename: '[name].js',
    },
    watch: true,
    devtool: false,
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                },
            },
            {
                test: /style\.s?css$/,
                use: [MiniCssExtractPlugin.loader, 'sass-loader'],
            },
            {
                test: /editor\.s?css$/,
                use: [MiniCssExtractPlugin.loader, 'sass-loader'],
            },
        ],
    },
    plugins: [
        blocksCSSPlugin,
        editBlocksCSSPlugin,
        /*new BrowserSyncPlugin({
            // Load localhost:3333 to view proxied site
            host: 'localhost',
            port: '3000',
            // Change proxy to your local WordPress URL
            proxy: 'http://jacobmartella.dev.cc'
        }),*/
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: JSON.stringify('development')
            }
        })
    ],
};
