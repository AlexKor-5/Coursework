const {src, dest, watch, parallel, series} = require('gulp');
const scss = require('gulp-sass');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify-es').default;
const autoprefixer = require('gulp-autoprefixer');
const imagemin = require('gulp-imagemin');
const del = require('del');

function browsersync() {
    browserSync.init({
        proxy: 'coursework', //  settings for PHP
        notify: false
    });
}

// browserSync.init({
//     server: {
//         baseDir: './'
//     },
//     browser: 'chrome',
//     notify: false
// });

function cleanDist() {
    return del('dist')
}

// Minimizing all images
function images() {
    return src('app/images/**/*')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.mozjpeg({quality: 75, progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(dest('dist/images'))   //way to save minimized images
}

//Creating minimized file Js
function scripts() {
    return src([
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'app/js/main.js',
        'app/js/submain.js'
    ])
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(dest('app/js'))
        .pipe(browserSync.stream())
}


// Convert bootstrap_scss_files into css
function styles() {
    return src([
        'app/scss/bootstrap_scss_files/bootstrap.scss',
        'app/scss/style.scss'
    ])
        .pipe(scss({outputStyle: 'expanded'}))//creating minimized file // outputStyle: 'compressed' allows css looks greate
        .pipe(concat('style.min.css'))            //renaming
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 10 version'],
            grid: true
        }))
        .pipe(dest('app/css'))                    //Enter way where it will be saved
        .pipe(browserSync.stream())
}

// Building files into "dist" folder
function build() {
    return src([
        'app/css/style.min.css',
        'app/fonts/**/*',
        'app/js/main.min.js',
        'app/*.html'
    ], {base: 'app'})
        .pipe(dest(`dist`))
}

// Watching for changes
function watching() {
    watch(['app/scss/**/*.scss'], styles);        //command to watch for all files which have ending in .bootstrap_scss_files
    watch(['app/js/**/*.js', '!app/js/main.min.js'], scripts);//watching for all js files except main.min.js
    watch(['app/*.html']).on('change', browserSync.reload);//refresh browser if html has change
    watch(['app/**/*.html']).on('change', browserSync.reload);//refresh browser if html has change
    watch(['app/**/*.php']).on('change', browserSync.reload);
}

exports.styles = styles;
// Available command "gulp styles" to convert bootstrap_scss_files into css

exports.watching = watching;
// Available command "gulp watching" to Auto convert bootstrap_scss_files into css

exports.browsersync = browsersync;
// Available command "gulp browsersync" to Auto refresh browser

// Available command "gulp scripts" to unite js files in one
exports.scripts = scripts;

// Available command "gulp images" to minimize images
exports.images = images;

// Available command "gulp cleanDist" to clean "dist" folder
exports.cleanDist = cleanDist;

// Available command "gulp build" to build project into "dist" folder
exports.build = series(cleanDist, images, build);


exports.default = parallel(styles, scripts, browsersync, watching);
// Available command "gulp" to Auto refresh browser and Auto convert bootstrap_scss_files into css, unite js files


