function missingPassword(){
    $('#hiddenMissingPassword').removeClass('hide');
    $('#password').addClass('hide');
    $('#btnConnexion').addClass('hide');
}

function findPassword(){
    $('#hiddenMissingPassword').addClass('hide');
    $('#password').removeClass('hide');
    $('#btnConnexion').removeClass('hide');
    $('#hiddenNewSalary').addClass('hide');
}


function newSalary(){
    $('#hiddenNewSalary').removeClass('hide');
    $('#password').addClass('hide');
    $('#btnConnexion').addClass('hide');
}