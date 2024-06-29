//Dakota Bourne and Matthew Reid
$(document).ready(function () {
    // affects the color on hover
    $("a.nav-link").mouseover(a => {
        // console.log("insidemouseover", a);
        a.currentTarget.style.color = "#000000";
    })
        .mouseout(a => {
            a.currentTarget.style.color = "rgba(0, 0, 0, 0.55)";
        })

    // on hover dropdown menus
    $("li.dropdown").mouseover(function () {
        $(this).find("a.dropdown-toggle").attr("aria-expanded", "true");
        const id = $(this).find("a.dropdown-toggle").attr("id");
        $(`div#${id}`).addClass("show");
        $(this).addClass("show");
    })
        .mouseout(function () {
            $(this).find("a.dropdown-toggle").attr("aria-expanded", "false");
            const id = $(this).find("a.dropdown-toggle").attr("id");
            $(`div#${id}`).removeClass("show");
            $(this).removeClass("show");
        })
});