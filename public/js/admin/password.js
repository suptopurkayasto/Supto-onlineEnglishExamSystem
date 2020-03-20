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

function updatePassword() {
    var target = $("#updatePassword");
    target.click(function() {
        $('#updatePasswordSec').toggleClass('d-none');
    })
}

$(document).ready(function () {
    "use strict";
    showPassword();
    updatePassword();
});
