var browserSync = require('browser-sync');
var gulp        = require('gulp');
var configBrowserSync      = require('../config').browserSync;
var configConnectPHP      = require('../config').connectPHP;
var connect     = require('gulp-connect-php');

gulp.task('browserSync', function() {

	// connect.server(configConnectPHP);

	browserSync(configBrowserSync);
});