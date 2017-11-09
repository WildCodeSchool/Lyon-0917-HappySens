$(document).ready(function() {
    $(".switch_content").hide();
    $("ul.switch li:first").addClass("active").show();
    $(".switch_content:first").show();

    $("ul.switch li").click(function() {
        $("ul.switch li").removeClass("active");
        $(this).addClass("active");
        $(".switch_content").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });
});