// webpack.config.js
const path = require( 'path' );
const CopyWebpackPlugin = require('copy-webpack-plugin');
const HtmlWebPackPlugin = require("html-webpack-plugin");

module.exports = {
    context: __dirname,
    entry: './src/js/index.js',
    output: {
        path: path.resolve( __dirname, 'dist' ),
        filename: 'main.js',
    },
    devtool: "source-map",
    plugins: [
      new CopyWebpackPlugin([
          {
              from: 'src/img/*',
              to: 'img',
              flatten: true
          }
      ])
    ],
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    'style-loader',
                    'css-loader',
                    'resolve-url-loader',
                    'sass-loader?sourceMap'
                ]
            },
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader"
                }
            },
            {
                test: /\.html$/,
                use: [
                    {
                        loader: "html-loader"
                    }
                ]
            }
        ]
    }
};
