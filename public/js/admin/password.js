/*Nina Kong*/

function showPassword() {
    var target = $("#showHide");
    target.click(function() {
        if ($("#password, #password_confirmation").attr("type")=="password") {
            $("#password, #password_confirmation").attr("type", "text");
        } else {
            $("#password, #password_confirmation").attr("type", "password");
        }
    })
}

$(document).ready(function () {
    "use strict";
    showPassword();
});
