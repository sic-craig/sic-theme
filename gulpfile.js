require('es6-promise').polyfill();

var gulp          = require('gulp');
var sass          = require('gulp-sass');
var autoprefixer  = require('gulp-autoprefixer');
var plumber       = require('gulp-plumber');
var gutil         = require('gulp-util');

var onError = function(err) {
  console.log('Gulp Error - ', gutil.colors.magenta(err.message));
  gutil.beep();
  this.emit('end');
};

gulp.task('sass', function() {
   return gulp.src('./sass/style.scss')
       .pipe(plumber({ errorHandler: onError }))
       .pipe(sass())
       .pipe(autoprefixer({
           browsers: ['last 3 versions']
       }))
       .pipe(gulp.dest('./'))
});

// watch sass files
gulp.task('watch', function() {
    gulp.watch('./sass/**/*.scss', ['sass']);
});

// default task
gulp.task('default', ['sass', 'watch']);