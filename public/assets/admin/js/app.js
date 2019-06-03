$(function () {
    $('.ui.dropdown').dropdown({
        on: 'hover'
    });
    $('.ui.accordion').accordion();
    $('#sidebar').addClass('visible');
    $('#sidebar').sidebar('attach events', '#sidebar-toggle', 'toggle');
    $('#sidebar').sidebar('setting', {
        dimPage: false,
        closable: false
    });
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
});
