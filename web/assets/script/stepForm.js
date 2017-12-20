function goStep1() {
    $("#step2").addClass("hide");
    $("#step3").addClass("hide");
    $("#step1").removeClass("hide");

}
function goStep2() {
    $("#step1").addClass("hide");
    $("#step3").addClass("hide");
    $("#step2").removeClass("hide");

}
function goStep3() {
    $("#step2").addClass("hide");
    $("#step1").addClass("hide");
    $("#step3").removeClass("hide");
}
