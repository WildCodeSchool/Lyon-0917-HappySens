function goStep1() {
    $("#step2").addClass("hide");
    $("#step3").addClass("hide");
    $("#step4").addClass("hide");
    $("#step1").removeClass("hide");
    $("#breadOne").addClass("active");
    $("#breadTwo").removeClass("active");
    $("#breadThree").removeClass("active");
    $("#breadFour").removeClass("active");

}
function goStep2() {
    $("#step1").addClass("hide");
    $("#step3").addClass("hide");
    $("#step4").addClass("hide");
    $("#step2").removeClass("hide");
    $("#breadTwo").addClass("active");
    $("#breadThree").removeClass("active");
    $("#breadFour").removeClass("active");

}
function goStep3() {
    $("#step2").addClass("hide");
    $("#step1").addClass("hide");
    $("#step4").addClass("hide");
    $("#step3").removeClass("hide");
    $("#breadOne").addClass("active");
    $("#breadThree").addClass("active");
    $("#breadTwo").addClass("active");
    $("#breadFour").removeClass("active");
}

function goStep4() {
    $("#step2").addClass("hide");
    $("#step1").addClass("hide");
    $("#step3").addClass("hide");
    $("#step4").removeClass("hide");
    $("#breadThree").addClass("active");
    $("#breadTwo").addClass("active");
    $("#breadFour").addClass("active");
}

// setup an "add a tag" link
var $addTagLink = $('<button class="btn add_tag_link hoverable blue center"><i class="material-icons">add</i>Ajouter talent</button>');
var $newLinkLi = $('<div></div>').append($addTagLink);

jQuery(document).ready(function() {
    var $collectionHolder = $('ul.userskills');
    $collectionHolder.append($newLinkLi);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $addTagLink.on('click', function(e) {
        e.preventDefault();
        addTagForm($collectionHolder, $newLinkLi);
    });
});

function addTagForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormLi = $('<li class="row"></li>').append(newForm);
    $newFormLi.prepend('<a class="remove-tag right"><i class="material-icons prefix hoverable">close</i></a>');
    $newLinkLi.before($newFormLi);

    $('.remove-tag').click(function(e) {
        e.preventDefault();
        $(this).parent().remove();
        return false;
    });
}