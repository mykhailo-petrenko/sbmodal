var gulp         = require('gulp');
var sass         = require('gulp-sass');
var handleErrors = require('../util/handleErrors');
var config       = require('../config').sass;
var autoprefixer = require('gulp-autoprefixer');
var minify       = require('gulp-cssnano');

gulp.task('minifyCss', function () {
  return gulp.src(config.src)
    .pipe(sass(config.settings))
    .on('error', handleErrors)
    .pipe(autoprefixer({ browsers: ['last 2 version'] }))
    .pipe(minify())
    .pipe(gulp.dest(config.dest));
});