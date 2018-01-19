function joinProject(title) {
   var $joinProject= $("<span>Vous êtes dans l'équipe du projet " + title + "</span>");
   Materialize.toast($joinProject, 4000);
}

function quitProject(title) {
   var $joinProject= $("<span>Vous n'êtes plus dans l'équipe de " + title +"</span>");
   Materialize.toast($joinProject, 4000);
}

