var gulp  = require('gulp'),
    gutil = require('gulp-util'),
    rename = require('gulp-rename'),
    merge = require('merge-stream'),
    runSequence = require('run-sequence'),
    zip = require('gulp-zip');

const arg = (argList => {

    let arg = {}, a, opt, thisOpt, curOpt;
    for (a = 0; a < argList.length; a++) {

        thisOpt = argList[a].trim();
        opt = thisOpt.replace(/^\-+/, '');

        if (opt === thisOpt) {

            // argument value
            if (curOpt) arg[curOpt] = opt;
            curOpt = null;

        }
        else {

            // argument name
            curOpt = opt;
            arg[curOpt] = true;

        }

    }

    return arg;

})(process.argv);

gulp.task('zip', () => {
    return gulp.src( [
        '**/*',
        '!node_modules/**',
        '!scss/*',
        '!.babelrc',
        '!.idea/*',
        '!package.json',
        '!package-lock.json',
        '!webpack.config.js',
        '!.git/*',
        '!.github/*',
        '!gulpfile.js',
        '!webpack.config.js',
    ] ) // Here I'm excluding .min.js files
        .pipe(zip('jm-breaking-news.zip'))
        .pipe(gulp.dest('./'));
});