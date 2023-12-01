$(document).ready(function () {
    $('.show_filter_header').click(function() {
        $('#show_filter_header_text1').toggleClass('d-none');
        $('#show_filter_header_text2').toggleClass('d-none');
        $('#sf_filter').toggleClass('visible');
    });
});