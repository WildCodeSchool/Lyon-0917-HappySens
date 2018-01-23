// *****************************************
//      This is for the step form
// *****************************************
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
    if(animating) return false;
    animating = true;
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    next_fs.show();
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            scale = 1 - (1 - now) * 0.2;
            left = (now * 50)+"%";
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
        easing: 'easeInOutBack'
    });
});

$(".previous").click(function(){
    if(animating) return false;
    animating = true;
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    previous_fs.show();
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            scale = 0.8 + (1 - now) * 0.2;
            left = ((1-now) * 50)+"%";
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        },
        duration: 800,
        complete: function(){
            current_fs.hide();
            animating = false;
        },
        easing: 'easeInOutBack'
    });
});

// *****************************************
// This is for add input skill in User forms
// setup an "add a tag" link
// *****************************************
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