function goStep1() {
    $("#step2").addClass("hide");
    $("#step3").addClass("hide");
    $("#step1").removeClass("hide");
    $("#breadOne").addClass("active");
    $("#breadTwo").removeClass("active");
    $("#breadThree").removeClass("active");

}
function goStep2() {
    $("#step1").addClass("hide");
    $("#step3").addClass("hide");
    $("#step2").removeClass("hide");
    $("#breadTwo").addClass("active");
    $("#breadThree").removeClass("active");

}
function goStep3() {
    $("#step2").addClass("hide");
    $("#step1").addClass("hide");
    $("#step3").removeClass("hide");
    $("#breadThree").addClass("active");
    $("#breadTwo").addClass("active");

}
