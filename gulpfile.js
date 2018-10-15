let gulp = require('gulp');

let sass = require('gulp-sass');
let concat = require('gulp-concat-css');
let cleanCSS = require('gulp-clean-css');
let autoprefixer = require('gulp-autoprefixer');

gulp.task('css', function () {
    return gulp.src('public_html/scss/**/*.scss')
        .pipe(sass())
        .pipe(concat("master.css"))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('public_html/css/'))
});

gulp.task('default', function () {
    gulp.watch('public_html/scss/**/*.scss', ['css']);
    // Other watchers
});