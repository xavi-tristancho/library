module.exports = {
    context : __dirname + "/public/js",
    entry : "./index.js",
    output : {
        path : __dirname + "/public/js",
        filename : "bundle.js"
    },

    module : {
        loaders : [
            {test : /\.html/, loader : 'raw', exclude: /node_modules/ }
        ]
    }
};