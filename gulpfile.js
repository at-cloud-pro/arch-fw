const { src, dest, watch } = require('gulp');
const sass = require('gulp-sass');
const minifyCss = require('gulp-minify-css');
const rename = require('gulp-rename');

function sassTask (cb) {
  // place code for your default task here
  return src('./assets/sass/stylesheet.sass')
    .pipe(sass())
    .on('error', sass.logError)
    .pipe(dest('./public/css'))
    .pipe(minifyCss({
      keepSpecialComments: 0,
    }))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(dest('./public/css'))
    .on('end', cb);
}

watch('assets/sass/**/*.sass', sassTask);

exports.default = sassTask;