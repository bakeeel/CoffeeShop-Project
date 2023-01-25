$(document).ready(function () {
    $(".js--scroll-to-start").click(function () {
        $("html, body").animate({
                scrollTop: $(".js--section-features").offset().top - 50
            },
            1000
        );
    });
});