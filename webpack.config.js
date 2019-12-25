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
<<<<<<< HEAD
      ])
=======
      ]),
        new HtmlWebPackPlugin([{
            template: "./src/html/index.html",
            filename: "./index.html"
        }]),
        new HtmlWebPackPlugin([{
            template: "./src/html/login.html",
            filename: "./login.html"
        }])
>>>>>>> d3e4bda2a4d7a4f07d52a86fa6a31d9acfa4a972
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
