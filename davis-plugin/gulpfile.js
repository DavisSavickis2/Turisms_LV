var gulp = require( 'gulp' );

var rename = require( 'gulp-rename' );
var sass = require( 'gulp-sass' );
var uglify = require( 'gulp-uglify' );
var sourcemaps = require( 'gulp-sourcemaps' );
var browserify = require( 'browserify' );
var babelify = require( 'babelify' );
var source = require( 'vinyl-source-stream' );
var buffer = require( 'vinyl-buffer' );

var browserSync = require('browser-sync').create();
var reload = browserSync.reload;
var projectURL   = 'https://test.dev';

var styleSRC = './src/scss/mystyle.scss';
var styleDIST = './assets/';
var styleWatch = './src/scss/**/*.scss';
var phpWatch     = '.src/**/*.php';

var jsSRC = 'myscript.js';
var jsFolder = 'src/js/';
var jsDIST = './assets/';
var jsWatch = './src/js/**/*.js';
var jsFILES = [jsSRC];


gulp.task('css', function (done){
	gulp.src( styleSRC )
	.pipe( sourcemaps.init() )
	.pipe( sass({
		errorLogToConsole: true,
		outputStyle: 'compressed'
	}) )
	.on( 'error', console.error.bind( console ) )
	.pipe( rename( { suffix: '.min' } ) )
	.pipe( sourcemaps.write( './' ) )
	.pipe( gulp.dest( styleDIST ) )
	.pipe( browserSync.stream() );
	done();
});

gulp.task('js', function (done) {
	jsFILES.map(function( entry ) {
		return browserify({
			entries: [jsFolder + entry]
		})
		.transform( babelify, { presets: [ '@babel/preset-env' ] } )
		.bundle()
		.pipe( source( entry ) )
		.pipe( rename({ suffix: '.min' }) )
		.pipe( buffer() )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( uglify() )
		.pipe( sourcemaps.write( './' ) )
		.pipe( gulp.dest( jsDIST ) )
	});
	done();
});


gulp.task('default', gulp.series('css','js'));


gulp.task('watch', gulp.parallel('default' , function() {
	browserSync.reload();
 	gulp.watch( styleWatch, gulp.series('css') );
 	gulp.watch( jsWatch, gulp.series('js') );
}));