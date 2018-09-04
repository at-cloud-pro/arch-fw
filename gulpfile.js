let gulp = require('gulp');

let sass = require('gulp-sass');
let concat = require('gulp-concat-css');
let cleanCSS = require('gulp-clean-css');

gulp.task('sass', function () {
    return gulp.src('assets/scss/*.scss')
        .pipe(sass()) // Converts Sass to CSS with gulp-sass
        .pipe(gulp.dest('public_html/css/all/'))
});


gulp.task('concat', function () {
    return gulp.src('public_html/css/all/*.css')
        .pipe(concat("all.css"))
        .pipe(gulp.dest('public_html/css/'));
});


gulp.task('minify', () => {
    return gulp.src('public_html/css/all.css')
        .pipe(cleanCSS({compatibility: 'ie9'}))
        .pipe(gulp.dest('public_html/css/min/'));
});

gulp.task('default', function () {
    gulp.watch('assets/scss/*.scss', ['sass']);
    gulp.watch('public_html/css/all/*.css', ['concat']);
    gulp.watch('public_html/css/styles.css', ['minify']);
    // Other watchers
});