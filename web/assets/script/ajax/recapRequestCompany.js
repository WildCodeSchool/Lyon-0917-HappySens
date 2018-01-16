function getUsers(idComp) {
    $.ajax({
        type: "POST",
        url: "/ajax/getUserCreated/",
        data : {'idComp' : idComp},
        success: function (response) {
            let user = JSON.parse(response.data)
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