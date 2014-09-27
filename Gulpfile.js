var gulp = require('gulp');
var sass =  require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

// function named css
gulp.task('css', function() {
// source scss(sass) files
gulp.src('app/assets/scss/*.scss')
	.pipe(sass({ includePaths : ['app/assets/scss'] }))
	// destination folder
	.pipe(gulp.dest('public/css'));
});


// set gulp to watch so it will do things automatically
gulp.task('watch', function() {
	// watch folder, run 'css' function defined above 
	gulp.watch('app/assets/scss/**/*.scss', ['css']);
});

//make the default task the 'watch' function defined above
gulp.task('default', ['watch']);
