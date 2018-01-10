import path from 'path';
import webpack from 'webpack';
import HtmlWebpackPlugin from 'html-webpack-plugin';

import packageJson from './package.json';

const main = () => {
  const entry = {
    [packageJson.name]: ['./src/js/index.js', './src/css/main.css'],
  };
  const filename = `[name].js`;

  return {
    entry,
    output: {
      filename,
      path: path.resolve(__dirname, 'example'),
    },
    plugins: [
      new HtmlWebpackPlugin({
        filename: path.resolve(__dirname, 'example/index.html'),
        template: 'example/src/index.html',
        css: ['main.css'],
      }),
    ],
    module: {
      rules: [
        {
          test: /\.js$/,
          use: ['babel-loader'],
        },
        {
          test: /\.css$/,
          use: ['style-loader', 'css-loader', 'postcss-loader'],
        },
      ],
    },
    devServer: {
      contentBase: path.join(__dirname, 'example'),
      open: true,
      openPage: 'wp-collapsible/',
      publicPath: '/wp-collapsible/',
    },
  };
};

export default main;
