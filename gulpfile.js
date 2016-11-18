(function () {

  'use strict';

  var gulp         = require('gulp'),
      gulpSequence = require('gulp-sequence').use(gulp),
      del          = require('del'),
      fs           = require('fs'),
      wrap         = require('gulp-wrap'),
      htmlmin      = require('gulp-htmlmin');


  gulp.task('layout', function () {
    return gulp.src(['./app/*.html', '!app/layout.html'])
      .pipe(wrap({src: './app/layout.html'}))
      .pipe(gulp.dest('./build'));
  });


  gulp.task('clean', function () {
    // Return the Promise from del()
    return del(['./build']);
  });


  gulp.task('minify', function () {
    return gulp.src('./build/*.html')
      .pipe(htmlmin({collapseWhitespace: true}))
      .pipe(gulp.dest('./build'));
  });

  gulp.task('copy', function () {
    return gulp.src(['app/**/**', '!app/*.html'])
      .pipe(gulp.dest('./build'));
  });

  gulp.task('default', gulpSequence('clean', 'layout', 'copy'));


}());
