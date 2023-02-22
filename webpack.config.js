const  path = require('path')
const TerserPlugin = require("terser-webpack-plugin");
const dev = process.env.NODE_ENV === "dev"

module.exports = {
    mode: "development",
    entry: './resources/js/src/app.js',
    watch: dev,
    output: {
        path: path.resolve("./public/vendors/js"),
        filename: "app.js",
        library: "app",
        libraryTarget: "umd"
    },
    devtool: dev ? "cheap-module-source-map" : "source-map",
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use:["babel-loader"]
            },
            {
                test: /\.css$/,
                use: ["style-loader", "css-loader"]
            }
        ]
    },
    optimization: {
        minimize: !dev,
        minimizer: [new TerserPlugin({
            terserOptions:{
                sourceMap: true,
            },
        })
        ],
    },
}
