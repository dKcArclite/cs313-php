$(document).ready(function () {

    $("#btnClickMe").button().click(function () {
        alert("You have cliked the click me button!");
    });

    $("#btnChangeColor").button().click(function () {
        $("#colorpicker").addClass("hidden");
        var newColor = $("#color").val();
        $('#div1').css('background-color', newColor);
    });

    $("#btn3").button().click(function () {
        if ($(this).html() == "Hide") {
            $(this).html("Show");
            $("#title3").fadeOut(3000);
            $("#div3").fadeOut(3000);
        }
        else {
            $(this).html("Hide");
            $("#title3").fadeIn(3000);
            $("#div3").fadeIn(3000);
        }
    });
});




