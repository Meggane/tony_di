require('../css/style.css');

$(document).on('change', '.custom-file-input', function () {
    let fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
    $(this).parent('.custom-file').find('.custom-file-label').text(fileName);
});

if ($('#collapse_menu').click(function () {
    $('#menu_pages').css('visibility', 'visible');
}));