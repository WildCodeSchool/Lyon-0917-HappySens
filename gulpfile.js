const gulp = require('gulp'); // j'appel le module gulp
const browserSync = require('browser-sync');
const reload = browserSync.reload;
const minifyCss = require('gulp-minify-css');
const notify = require("gulp-notify");
const autoprefixer = require('gulp-autoprefixer');
const sass = require('gulp-sass');
const source = './web/assets';
const rename = require('gulp-rename');

// gulp.task('browser-sync', function() {
//     browserSync({
//         port: 8000,
//         server: {
//             url: "127.0.0.1",
//         }
//     });
// });
// tache lancée par défaut avec la ligne de commande gulp
gulp.task('default', ['css', 'sass'], function() {
    gulp.watch([source + '/css/*.css'], ['css']);
    gulp.watch([source + '/sass/*.scss'], ['sass']);
    // watch permet de "watcher", oberserver les changements de fichiers
    // CSS du dossier CSS er relancer la tache "css"
    console.log("Ma tâche par default...");
});

// crée une tache CSS
gulp.task('css', function() {
    console.log("Ma tâche pour la CSS");
    //1 gulp.src () => chercher un ou plusieurs fichiers sources
    return gulp.src([source + '/css/style.css']) //src = source de fichier(s)
        .pipe(autoprefixer({
            browsers: ['> 1%', 'IE 7','Firefox <= 20', 'iOS 7']
        }))
        .pipe(minifyCss()) // compresser ma CSS par le module gulp-minify-css
        // gulp dest +> sett a préciser le repertoire de destination
        .pipe(gulp.dest(source + '/css/')) // permet d'envoyer le fichier minimifier dans le répertoire dist/css
        .pipe(notify("CSS compressée, et concatenée!"))
        .pipe(reload({stream:true, once: true})); // je relance mon naviguateur quand ma tache css est accomplie: permet de rafraichir mon naviguateur

});

// crée une tache SASS
gulp.task('sass', function() {
    return gulp.src(source + '/sass/style.scss') //src = source de fichier(s)
        .pipe(sass().on('error', sass.logError)) // compiler du SASS en CSS
        .pipe(autoprefixer({
            browsers: ['> 1%', 'IE 7','Firefox <= 20', 'iOS 7']
        }))
        .pipe(minifyCss()) // compresser ma CSS par le module gulp-minify-css
        .pipe(rename({
            suffix: '.min',
        }))
        .pipe(gulp.dest(source + '/css/')) // permet d'envoyer le fichier minimifier dans le répertoire dist/css
        .pipe(notify("SASS compilée compressée, et concatenée!"))
        .pipe(reload({stream:true, once: true}));
});
