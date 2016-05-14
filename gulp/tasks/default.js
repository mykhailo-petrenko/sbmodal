var gulp = require('gulp');

gulp.task('default', [], function() { // 'iconFont'
    gulp.start('sass', 'watch');
});