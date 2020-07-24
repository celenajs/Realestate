var themename = 'divi-child';
var gulp = require( 'gulp' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    browserSync  = require( 'browser-sync' ).create(),
    reload  = browserSync.reload,
    sass  = require( 'gulp-sass' ),
    cleanCSS  = require( 'gulp-clean-css' ),
    sourcemaps  = require( 'gulp-sourcemaps' ),
    concat  = require( 'gulp-concat' ),
    imagemin  = require( 'gulp-imagemin' ),
    changed = require( 'gulp-changed' ),
    uglify  = require( 'gulp-uglify' ),
    lineec  = require( 'gulp-line-ending-corrector' );

var root  = '../' + themename + '/',
    scss  = root + 'sass/',
    themeCSS  = root + 'dist/css/',
    js  = root + 'js/',
    vendor = root + 'node_modules/',
    libs = root + 'libraries/',
    jsdist  = root + 'dist/js/';

// Watch Files
var PHPWatchFiles  = root + '**/*.php',
    libsWatchFiles  = root + 'libraries/sass/**/*.scss'
    styleWatchFiles  = root + '**/*.scss';

// Files from JS addons
var jsSRC = [
  // jsdist + 'swiper/swiper.js',
  // jsdist + 'iziModal/iziModal.min.js',
  jsdist + 'fancybox/jquery.fancybox.js',
  js + 'custom.js',
];

// Files from Styling addons
var cssSRC =  [
// themeCSS + 'fontawesome/font-awesome.css',
// themeCSS + 'bootstrap4/bootstrap.css',
// themeCSS + 'swiper/swiper.css',
// themeCSS + 'iziModal/iziModal.min.css',
themeCSS + 'fancybox/jquery.fancybox.css',
themeCSS + 'style.css',
];

var imgSRC = root + 'images/*',
    imgDEST = root + 'dist/images/';

function css() {
  return gulp.src([libsWatchFiles , scss + 'style.scss'])
  .pipe(sourcemaps.init({loadMaps: true}))
  .pipe(sass({
    outputStyle: 'expanded'
  }).on('error', sass.logError))
  .pipe(autoprefixer('last 2 versions'))
  .pipe(sourcemaps.write())
  .pipe(lineec())
  .pipe(gulp.dest(themeCSS));
}

function concatCSS() {
  return gulp.src(cssSRC)
  .pipe(sourcemaps.init({loadMaps: true, largeFile: true}))
  .pipe(concat('theme-style.min.css'))
  .pipe(cleanCSS())
  .pipe(sourcemaps.write('./maps/'))
  .pipe(lineec())
  .pipe(gulp.dest(themeCSS));
}

function javascript() {
  return gulp.src(jsSRC)
  .pipe(concat('theme.min.js'))
  .pipe(uglify())
  .pipe(lineec())
  .pipe(gulp.dest(jsdist));
}

function imgmin() {
  return gulp.src(imgSRC)
  .pipe(changed(imgDEST))
      .pipe( imagemin([
        imagemin.gifsicle({interlaced: true}),
        imagemin.jpegtran({progressive: true}),
        imagemin.optipng({optimizationLevel: 5})
      ]))
      .pipe( gulp.dest(imgDEST));
}

function start() {
  gulp.watch(styleWatchFiles, gulp.series([css, concatCSS]));
  gulp.watch(jsSRC, javascript);
  gulp.watch(imgSRC, imgmin);
  gulp.watch([PHPWatchFiles, jsdist + 'theme.min.js', themeCSS + 'theme-style.min.css']);
}

function start_sync() {
  
  browserSync.init({
    open: 'local',
    proxy: 'project.local/',
    port: 8080,
  });

  gulp.watch(styleWatchFiles, gulp.series([css, concatCSS]));
  gulp.watch(jsSRC, javascript);
  gulp.watch(imgSRC, imgmin);
  gulp.watch([PHPWatchFiles, jsdist + 'theme.min.js', themeCSS + 'theme-style.min.css']).on('change', browserSync.reload);
}

exports.css = css;
exports.concatCSS = concatCSS;
exports.javascript = javascript;
exports.start = start;
exports.start_sync = start_sync;
exports.imgmin = imgmin;

var build = gulp.parallel(start);
var build_sync = gulp.parallel(start_sync);
gulp.task('start', build);
gulp.task('start-sync', build_sync);

gulp.task('copy_libs', done => {
  // Copy all Bootstrap JS files
  // gulp.src(vendor + 'bootstrap/dist/js/**/*.js')
  // .pipe(gulp.dest(jsdist + '/bootstrap4'));

  // Copy all Bootstrap SCSS files
  // gulp.src(vendor + 'bootstrap/scss/**/*.scss')
  //   .pipe(gulp.dest(libs + '/sass/bootstrap4'));
  ////////////////// End Bootstrap 4 Assets /////////////////////////

  // Copy all Font Awesome Fonts
  // gulp.src(vendor + 'font-awesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
  //   .pipe(gulp.dest(themeCSS + '/fonts'));

  // Copy all Font Awesome SCSS files
  // gulp.src(vendor + 'font-awesome/scss/*.scss')
  //   .pipe(gulp.dest(libs + '/sass/fontawesome'));
  ////////////////// End Font Awesome Assets /////////////////////////

  // Copy all Fancy files
  gulp.src(vendor + '@fancyapps/fancybox/dist/jquery.fancybox.css')
    .pipe(gulp.dest(themeCSS + '/fancybox'));

  gulp.src(vendor + '@fancyapps/fancybox/dist/jquery.fancybox.js')
    .pipe(gulp.dest(jsdist + '/fancybox'));
  ////////////////// End Fancybox Assets /////////////////////////

  // Copy all Swiper files
  // gulp.src(vendor + 'swiper/dist/css/swiper.css')
  //   .pipe(gulp.dest(themeCSS + '/swiper'));

  // gulp.src(vendor + 'swiper/dist/js/swiper.js')
  //   .pipe(gulp.dest(jsdist + '/swiper'));
  ////////////////// End Swiper Assets /////////////////////////

  // Copy all Izimodal files
    // gulp.src(vendor + 'izimodal/css/iziModal.min.css')
    //   .pipe(gulp.dest(themeCSS + '/iziModal'));

    // gulp.src(vendor + 'izimodal/js/iziModal.min.js')
    //   .pipe(gulp.dest(jsdist + '/iziModal'));
  ////////////////// End Izimodal Assets /////////////////////////
  done();
});