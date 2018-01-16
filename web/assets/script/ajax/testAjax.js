let el = document.getElementById("test");
let link = '{{ project.slug }}';

el.addEventListener("click", function( ) {
    swal({
        title: "Vous allez rejoindre l'équipe du projet, en êtes vous sur ?",
        icon: "warning",
        buttons: {
            cancel: "Annuler",
            joinTeam: {
                text: "Rejoindre l'équipe du projet",
                value: link,
            },
        },
    })
        .then(name => {
            return fetch('/project/joinTeam/' + name, {method: "GET"});
        })
        .then((value) => {
            switch (value) {
                case "joinTeam":
                    swal({
                        title: "Bravo !",
                        text: "Vous faites desormais parti de l'équipe du projet",
                        icon: "success",
                        buttons: false,
                        timer: 1500,
                    });
                    break;
                default:
                    break;
            }
        });
//        .then((joinTeam) => {
//            if (joinTeam) {
//                swal({
//                    title: "Vous faites desormais parti de l'équipe du projet",
//                    text: " ",
//                    icon: "success",
//                    buttons: false,
//                    timer: 1500,
//                });
//            }
//        });
}, false);