const path = require( 'path' );
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const devMode = process.env.NODE_ENV !== 'production';

const entryPoint = {
    admin                    : './src/admin/index.js',
    'frontend/clear-cart'    : './src/frontend/clear-cart.js',
    'blocks/clear-cart-block': './src/blocks/clear-cart-button/index.js'
}

const trademateConfig = {
    entry   : entryPoint,
    mode    : devMode ? 'development' : 'production',
    output  : {
        path    : path.resolve( __dirname, './assets/js' ),
        filename: devMode ? '[name].js': '[name].min.js',
        clean: !devMode
    },
    module  : {
        rules   : [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [ '@babel/preset-env', '@babel/preset-react' ]
                    }
                }
            },
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader'
                ]
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(png|jpe?g|gif|svg|eot|ttf|woff|woff2)$/, // Use built-in asset/resource
                type: 'asset/resource',
                generator: {
                    filename: '../resources/[name][ext]' // Optional: customize output path for assets
                }
            }
        ]
    },
    externals: {
        '@wordpress/blocks': ['wp', 'blocks'],
        '@wordpress/i18n': ['wp', 'i18n'],
        '@wordpress/components': ['wp', 'components'],
        '@wordpress/element': ['wp', 'element'],
        '@wordpress/block-editor': ['wp', 'blockEditor'],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: devMode ? '../css/[name].css' : '../css/[name].min.css', // Ensure CSS files are placed in the correct directory
        })
    ]
}

module.exports = trademateConfig;