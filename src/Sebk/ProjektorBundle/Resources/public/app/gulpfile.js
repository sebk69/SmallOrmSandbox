/**
 * This file is a part of SebkSmallUserBundle
 * Copyright 2015, 2016 - Sébastien Kus
 * Under GNU GPL V3 licence
 */

// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var order = require('gulp-order');
var concatCss = require('gulp-concat-css');
var addSrc = require('gulp-add-src');

// Lint Task
gulp.task('lint', function () {
    return gulp.src('js/**/*.js')
            .pipe(jshint())
            .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function () {
    return gulp.src('scss/**/*.scss')
            .pipe(sass())
            .pipe(gulp.dest('css'));
});

// Concat css
gulp.task('css', function () {
    return gulp.src('css/**/*.css')
            .pipe(concatCss("style.css"))
            .pipe(gulp.dest('dist'));
});

// Concatenate & Minify JS
gulp.task('scripts', function () {
    return gulp.src('app/config/**/*.js')
            .pipe(addSrc('app/rest/**/*.js'))
            .pipe(addSrc('app/app/**/*.js'))
            .pipe(concat('app.js'))
            .pipe(gulp.dest('dist'))
            .pipe(rename('app.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('dist'));
});

gulp.task('libs', function () {
    return gulp.src('lib/**/*.js')
            .pipe(order(["10", "20", "30"]))
            .pipe(concat('libs.js'))
            .pipe(gulp.dest('dist'))
            .pipe(rename('libs.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('dist'));
});

// Watch Files For Changes
gulp.task('watch', function () {
    gulp.watch('app/**/*.js', ['lint', 'scripts']);
    gulp.watch('lib/**/*.js', ['libs']);
    gulp.watch('scss/**/*.scss', ['sass']);
    gulp.watch('css/**/*.css', ['css']);
});

// Default Task
gulp.task('default', ['lint', 'sass', 'css', 'scripts', 'watch', 'libs']);
