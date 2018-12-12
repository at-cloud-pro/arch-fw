/*
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   2.5.1
 * @link      https://github.com/archi-tektur/ArchFW/
 */

let gulp = require('gulp')

let sass = require('gulp-sass')
let concat = require('gulp-concat-css')
let cleanCSS = require('gulp-clean-css')
let autoprefixer = require('gulp-autoprefixer')

gulp.task('css', function () {
  return gulp.src('public_html/scss/**/*.scss')
    .pipe(sass())
    .pipe(concat('master.css'))
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(gulp.dest('public_html/css/'))
})

gulp.task('default', () => {
  gulp.watch('public_html/scss/**/*.scss', function () {
    return gulp.src('public_html/scss/**/*.scss')
      .pipe(sass())
      .pipe(concat('master.css'))
      .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      }))
      .pipe(cleanCSS({ compatibility: 'ie8' }))
      .pipe(gulp.dest('public_html/css/'))
  })
})