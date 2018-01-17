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
var $addTagLink = $('<a href="#" class="add_tag_link">Add a tag</a>');
var $newLinkLi = $('<div></div>').append($addTagLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('ul.userskills');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addTagForm($collectionHolder, $newLinkLi);
    });


});

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-tag">x</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-tag').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}