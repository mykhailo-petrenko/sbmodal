var gulp    = require('gulp');
var config  = require('../config').production;
var uglify = require('gulp-uglify');
var browserifyTask = require('./browserify');

gulp.task('uglifyJs', ['browserify'], function() {
	return browserifyTask(false);
});