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












////////////////     Form 2.0     ///////////////////
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
    if(animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50)+"%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
                'transform': 'scale('+scale+')',
                'position': 'absolute'
            });
            next_fs.css({'left': left, 'opacity': opacity});
        },
        duration: 800,
        complete: function(){
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$(".previous").click(function(){
    if(animating) return false;
    animating = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        },
        duration: 800,
        complete: function(){
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});












// setup an "add a tag" link
var $addTagLink = $('<button class="btn add_tag_link hoverable blue center"><i class="material-icons left">add</i>Ajouter talent</button>');
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