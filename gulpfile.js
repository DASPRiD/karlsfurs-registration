var gulp = require('gulp');
var realFavicon = require('gulp-real-favicon');
var fs = require('fs');

var FAVICON_DATA_FILE = 'faviconData.json';

gulp.task('generate-favicon', function(done) {
    realFavicon.generateFavicon({
        masterPicture: 'assets/favicon.svg',
        dest: 'public',
        iconsPath: '/',
        design: {
            ios: {
                pictureAspect: 'noChange',
                appName: 'Karlsfurs Suitwalk'
            },
            desktopBrowser: {},
            windows: {
                masterPicture: 'assets/monochrome-white.svg',
                pictureAspect: 'noChange',
                backgroundColor: '#6089ab',
                onConflict: 'override',
                appName: 'Karlsfurs Suitwalk'
            },
            androidChrome: {
                pictureAspect: 'noChange',
                themeColor: '#ffffff',
                manifest: {
                    name: 'Karlsfurs Suitwalk',
                    display: 'browser',
                    orientation: 'notSet',
                    onConflict: 'override',
                    declared: true
                }
            },
            safariPinnedTab: {
                masterPicture: 'assets/monochrome-black.svg',
                pictureAspect: 'silhouette',
                themeColor: '#a98b49'
            }
        },
        settings: {
            scalingAlgorithm: 'Mitchell',
            errorOnImageTooSmall: false
        },
        markupFile: FAVICON_DATA_FILE
    }, function() {
        done();
    });
});

gulp.task('inject-favicon-markups', function() {
    gulp.src(['templates/layout/default.phtml'])
        .pipe(realFavicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).favicon.html_code))
        .pipe(gulp.dest('templates/layout'));
});

gulp.task('check-for-favicon-update', function(done) {
    var currentVersion = JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).version;
    realFavicon.checkForUpdates(currentVersion, function(err) {
        if (err) {
            throw err;
        }
    });
});
