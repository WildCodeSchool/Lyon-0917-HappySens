function like() {
   var $like= $('<span>+1 pour le projet @name.projet</span>');
   Materialize.toast($like, 4000);
}

function joinProject() {
   var $joinProject= $("<span>Vous êtes dans l'équipe du projet @name.projet</span>");
   Materialize.toast($joinProject, 4000);
}

