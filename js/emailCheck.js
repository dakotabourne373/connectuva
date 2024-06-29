//Dakota Bourne and Matthew Reid

function emailCheck() {
    let e = $("#email");
    let submit = $("#submit");
    let ehelp = $("#ehelp");

    if (e.val().match(/[a-z][a-z][a-z]?[0-9][a-z][a-z]?[a-z]?@virginia.edu/) === null) {
        ehelp.text("Email must be a valid uva email with computing ID");
        e.addClass("is-invalid");
        submit.prop("disabled", true);
    } else {
        ehelp.text("");
        e.removeClass("is-invalid");
        submit.prop("disabled", false);
    }
}

$("#email").keyup(function () {
    emailCheck();
})