new Clipboard('[data-clipboard-target]');
$('body').on('click', '[data-clipboard-target]', function () {
    $.notify({
        level: 'info',
        message: 'Copied to clipboard'
    });
});