const gulp = require('gulp')
const sourcemaps = require('gulp-sourcemaps')
const scss = require('gulp-sass')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const gulpif = require('gulp-if')
const watch = require('gulp-watch')
const csso = require('gulp-csso')

gulp.task('styles', () => {
  return gulp.src('./scss/**/*.scss')
    .pipe(gulpif(process.env.NODE_ENV === 'development',
      sourcemaps.init()))
    .pipe(scss().on('error', scss.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(gulpif(process.env.NODE_ENV === 'production',
      csso()))
    .pipe(gulpif(process.env.NODE_ENV === 'development',
      sourcemaps.write()))
    .pipe(gulp.dest('./'))
})
gulp.task('styles:watch', function () {
  return watch('./scss/**/*.scss', {ignoreInitial: false})
    .pipe(gulpif(process.env.NODE_ENV === 'development',
      sourcemaps.init()))
    .pipe(scss().on('error', scss.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(gulpif(process.env.NODE_ENV === 'production',
      csso()))
    .pipe(gulpif(process.env.NODE_ENV === 'development',
      sourcemaps.write()))
    .pipe(gulp.dest('./'))
})
