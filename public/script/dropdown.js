$(document).ready(function() {

    

    $('.menu1_click').click(function() {
        $(this).toggleClass('bg_blue');
        $(this).toggleClass('bg_pink');
        $('.dropdown_menu1_click').toggleClass('visible');
        $('.dropdown_menu_arrow1').toggleClass('tr');
    });
    $('.menu2_click').click(function() {
        $(this).toggleClass('bg_blue');
        $(this).toggleClass('bg_pink');
        $('.dropdown_menu2_click').toggleClass('visible');
        $('.dropdown_menu_arrow2').toggleClass('tr');
    });
    $('.menu3_click').click(function() {
        $(this).toggleClass('bg_blue');
        $(this).toggleClass('bg_pink');
        $('.dropdown_menu3_click').toggleClass('visible');
        $('.dropdown_menu_arrow3').toggleClass('tr');
    });
    $('.menu4_click').click(function() {
        $(this).toggleClass('bg_blue');
        $(this).toggleClass('bg_pink');
        $('.dropdown_menu4_click').toggleClass('visible');
        $('.dropdown_menu_arrow4').toggleClass('tr');
    });
    $('.menu5_click').click(function() {
        $(this).toggleClass('bg_blue');
        $(this).toggleClass('bg_pink');
        $('.dropdown_menu5_click').toggleClass('visible');
        $('.dropdown_menu_arrow5').toggleClass('tr');
    });
});

