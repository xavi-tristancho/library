module.exports = {
    context : __dirname + "/app",
    entry : "./index.js",
    output : {
        path : __dirname + "/app",
        filename : "bundle.js"
    },
    devtool: 'eval',
    module : {
        loaders : [
            {test : /\.html/, loader : 'raw', exclude: /node_modules/ }
        ]
    }
};