$(document).ready(function () {
    $('.nav_element').click('on', function() {
        $('.nav_element_line1').toggleClass('nav_element_rotate1');
        $('.nav_element_line2').toggleClass('nav_element_rotate2');
        $('.menu2').toggleClass('menu2_open');
        $('body').toggleClass('overflow-hidden');
    });
});