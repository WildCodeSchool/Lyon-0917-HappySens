function missingPassword(){
    $('#hiddenMissingPassword').removeClass('hidden');
    $('#password').addClass('hidden');
    $('#btnConnexion').addClass('hidden');
}

function findPassword(){
    $('#hiddenMissingPassword').addClass('hidden');
    $('#password').removeClass('hidden');
    $('#btnConnexion').removeClass('hidden');
    $('#hiddenNewSalary').addClass('hidden');
}


function newSalary(){
    $('#hiddenNewSalary').removeClass('hidden');
    $('#password').addClass('hidden');
    $('#btnConnexion').addClass('hidden');
}