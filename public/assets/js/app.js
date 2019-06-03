$(function () {
    $('.ui.dropdown').dropdown({
        on: 'hover'
    });
    $('.ui.accordion').accordion();
    $('.message .close')
        .on('click', function () {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
    $('form.loadable button').on('click', function () {
        return $(this).closest('form').addClass('loading');
    });
    $('.ui.checkbox')
        .checkbox()
    ;
    $('.ui.sticky')
        .sticky()
    ;
    $('.ui.progress')
        .progress()
    ;
    $('.menu .item')
        .tab()
    ;
});

function logout() {
    $('.logoutform').submit();
}

function goTop() {
    $('html, body').animate({scrollTop: 0}, 'fast');
}

$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        $("#go-top-button").show();
    } else {
        $("#go-top-button").hide();
    }
});