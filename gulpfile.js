const gulp = require( 'gulp' );
const zip = require( 'gulp-zip' );

function bundle() {
	return gulp
		.src( [
			'**/*',
			'!node_modules/**',
			'!eslintrc.js',
			'!gulpfile.js',
			'!package.json',
			'!package-lock.json',
			'!webpack.config.js',
			'!.gitignore',
		] )
		.pipe( zip( 'stylizedx.zip' ) )
		.pipe( gulp.dest( 'bundled' ) );
}

// gulp.task( 'default', gulp.series( 'bundle' ) );
exports.default = bundle;
