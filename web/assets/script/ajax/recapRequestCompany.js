function getUsers(idComp) {
    $.ajax({
        type: "POST",
        url: "/ajax/getUserCreated/",
        data : {'idComp' : idComp},
        success: function (response) {
            var user = JSON.parse(response.data)
            for(let i = 0; i < user.length; i++) {
                if (user[i].isTrait === false) {
                    iconStatus = '<p class="secondary-content black-text"><i class="material-icons orange-text">update</i></p>';
                } else {
                    iconStatus = '<p class="secondary-content black-text"><i class="material-icons green-text">check_circle</i></p>';
                }
                html = '<li class="collection-item avatar">' +
                    '<img src="/assets/images/placeholder.png" alt="" class="circle">' +
                    '<span class="title">' + user[i].nom + user[i].prenom + '</span>' +
                    '<p>' + user[i].email + '</p>' +
                    iconStatus +
                    '</li>';
                if (user[i].isTrait === false) {
                    $('#listWaitUser').append(html);
                    $('#createdPlaceholder').removeClass('hide');
                    $('#waitingPlaceholder').addClass('hide');
                    delete html;
                } else {
                    $('#listCreatedUser').append(html);
                    $('#createdPlaceholder').addClass('hide');
                    $('#waitingPlaceholder').removeClass('hide');
                    delete html;
                }
            }
        },
        error: function () {
            html = '<li class="collection-item error">Erreur lors de la reception des données utilisateurs</li>';
            $('#listWaitUser').append(html);
        }
    })
}
function newLikeProject(id, nameProject) {
    var like= $('<span>+1 pour le projet ' + nameProject + '</span>');
    $.ajax({
        type: "POST",
        url: "/project/likeProject/",
        data : {'id' : id},
        success: function (response) {
            var user = JSON.parse(response);
            location.reload();
            Materialize.toast(like, 4000);
        },
        error: function () {
            var user = JSON.parse(response.likeFailed);
        }
    })
}

function dislikeProject(id, nameProject) {
    var like= $("<span>Vous n'aimez plus " + nameProject + "</span>");
    $.ajax({
        type: "POST",
        url: "/project/dislikeProject/",
        data : {'id' : id},
        success: function () {
            location.reload();
            Materialize.toast(like, 4000);
        }
    })
}