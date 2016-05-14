var gulp = require('gulp');
var config = require('../config').markup;
var browserSync  = require('browser-sync');

gulp.task('markup', function() {

	browserSync.reload();

	return gulp;
});