// purify.js
const purify = require("purify-css")
const htmlFiles = ['*.php'];
const cssFiles = ['style/*.css'];
const opts = {
    output: 'purified.css'
};
purify(htmlFiles, cssFiles, opts, function (res) {
    log(res);
});