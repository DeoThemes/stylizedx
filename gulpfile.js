const gulp = require( 'gulp' ),
	zip = require( 'gulp-zip' ),
	wpPot = require( 'gulp-wp-pot' ),
	sort = require( 'gulp-sort' );

gulp.task( 'bundle', () => {
	return gulp
		.src( [
			'**/*',
			'!node_modules/**',
			'!bundled/**',
			'!eslintrc.js',
			'!gulpfile.js',
			'!package.json',
			'!package-lock.json',
			'!webpack.config.js',
			'!.gitignore',
		] )
		.pipe( zip( 'stylizedx.zip' ) )
		.pipe( gulp.dest( 'bundled' ) );
} );

gulp.task( 'translate', () => {
	return gulp
		.src( './**/*.php' )
		.pipe( sort() )
		.pipe(
			wpPot( {
				domain: 'stylizedx',
				package: 'stylizedx',
				bugReport: 'https://deothemes/contact/',
				lastTranslator: 'Alexander Samokhin <hello@deothemes.com>',
				team: 'DeoThemes <hello@deothemes.com>',
			} )
		)
		.pipe( gulp.dest( './languages/stylizedx.pot' ) );
} );

gulp.task( 'default', gulp.series( 'translate', 'bundle' ) );
