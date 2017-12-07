require('es6-promise').polyfill();

var gulp          = require('gulp');
var sourcemaps    = require('gulp-sourcemaps');
var sass          = require('gulp-sass');
var autoprefixer  = require('gulp-autoprefixer');
var plumber       = require('gulp-plumber');
var gutil         = require('gulp-util');
var tinypng       = require('gulp-tinypng-compress');
var rename        = require("gulp-rename");
var uglify        = require('gulp-uglify');
var pump          = require('pump');
var browserify    = require('gulp-browserify');


var onError = function(err) {
    console.log('Gulp Error - ', gutil.colors.magenta(err.message));
    gutil.beep();
    this.emit('end');
};

gulp.task('sass', function() {
    return gulp.src('./sass/style.scss')
        .pipe(sourcemaps.init())
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(autoprefixer({
            browsers: ['last 3 versions']
        }))
        .pipe(sourcemaps.write())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./assets/dist/css'))
});

gulp.task('compressImages', function() {
    return gulp.src('./assets/dist/img/**/*')
        .pipe(tinypng({
            key: 'CWlPoU5CMtGFweqLXJQhBWSLd-Aa8hzj',
            sameDest: true,
            sigFile: './assets/dist/img/.tinypng-sigs',
            ignore: '*.svg',
            log: true
        }))
        .pipe(gulp.dest('./assets/dist/img'))
});

gulp.task('minifyJS', function (cb) {
    pump([
            gulp.src(['./assets/build/js/*.js', '!./assets/build/js/app.js'])
                .pipe(uglify())
                .pipe(rename({ suffix: '.min' })),
            gulp.dest('./assets/dist/js')
        ],
        cb
    )
});

gulp.task('runBrowserify', function() {
    // Single entry point to browserify
    gulp.src('./assets/build/js/app.js')
        .pipe(plumber({ errorHandler: onError }))
        .pipe(browserify())
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./assets/dist/js'))
});

// watch sass/js files
gulp.task('watch', function() {
    gulp.watch('./sass/**/*.scss', ['sass']);
    gulp.watch(['./assets/build/js/*.js', '!./assets/build/js/app.js'], ['minifyJS']);
    gulp.watch('./assets/build/js/app.js', ['runBrowserify']);
});

// default task
gulp.task('default', ['sass', 'watch', 'compressImages']);