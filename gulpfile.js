require('no-pollution');
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
// const { src, dest } = require('gulp');
const concat = require('gulp-concat');
const deletefile = require('gulp-delete-file');
const bowerPath = './resources/assets/bower/vendor';
const bundledCss = './public/css/all.css';

// compiles scss into css
function style() {
	// 1. where is my scss file
	return (
		gulp
			.src('./resources/assets/sass/**/*.scss')
			// 2. pass that file through sass compiler
			.pipe(sass())
			// 3  where do i save the compiled CSS?
			.pipe(gulp.dest('./resources/assets/css/'))
	);
}

function cssBundle() {
	return (
		gulp
			// css files to be bundled
			.src([
				'./resources/assets/bower/vendor/slick-carousel/slick/slick.css',
				'./resources/assets/css/app.css',
			])
			// bundle the css above
			.pipe(concat('all.css'))
			// save to dest path
			.pipe(gulp.dest('./public/css/'))
	);
}

function jsBundle() {
	return (
		gulp
			// js files to be bundled
			.src([
				// Jquery
				bowerPath + '/jquery/dist/jquery.min.js',
				// foundation Js
				bowerPath + '/foundation-sites/dist/js/foundation.min.js',
				// slick js
				bowerPath + '/slick-carousel/slick/slick.min.js',
				// our own js file
				'./resources/assets/js/app.js',
				'./resources/assets/js/admin/*.js',
				// js init file
				'./resources/assets/js/init.js',
			])
			// bundle the css above
			.pipe(concat('all.js'))
			// save to dest path
			.pipe(gulp.dest('./public/js/'))
	);
}

function deleteCssBundle() {
	return gulp.src(['./public/css/all.css']).pipe(deletefile());
}

function watch() {
	gulp.watch('./resources/assets/sass/**/*.scss', style);
	gulp.watch('./resources/assets/sass/**/*.scss', cssBundle);
	gulp.watch('./resources/assets/js/**/*.js', jsBundle);
}

exports.style = style;
exports.watch = watch;
exports.cssBundle = cssBundle;
exports.jsBundle = jsBundle;
exports.deleteCssBundle = deleteCssBundle;
