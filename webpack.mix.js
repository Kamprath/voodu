let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
	// .extract(['vue']) // separate vendor and app code. JS must be loaded in order of manifest.js -> vendor.js -> app.js
	.sourceMaps()
	.less('resources/assets/less/app.less', 'public/css');

// suffix paths with a cache-breaking version string
mix.version();