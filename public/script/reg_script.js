$(document).ready(function() {
    $('.entity_block1').on("click", function() {
        $('.entity_block2').addClass("bg_white");
        $('.entity_block2').addClass("blue_color");
        $('.entity_block2').removeClass("bg_blue");
        $('.entity_block2').removeClass("white_color");
        $('.entity_block1').addClass("bg_blue");
        $('.entity_block1').addClass("white_color");
        $('.entity_block1').removeClass("bg_white");
        $('.entity_block1').removeClass("blue_color"); 
    });
    $('.entity_block2').on("click", function() {
        $('.entity_block1').addClass("bg_white");
        $('.entity_block1').addClass("blue_color");
        $('.entity_block1').removeClass("bg_blue");
        $('.entity_block1').removeClass("white_color");
        $('.entity_block2').addClass("bg_blue");
        $('.entity_block2').addClass("white_color");
        $('.entity_block2').removeClass("bg_white");
        $('.entity_block2').removeClass("blue_color"); 
    });
    $('.choice_elem2').on("click", function() {
        $('.reciever_block_e2_1').addClass("d-none");
        $('.reciever_block_e2_2').addClass("d-block");
        $('.reciever_block_e2_2').removeClass("d-none");
    });
    $('.choice_elem1').on("click", function() {
        $('.reciever_block_e2_2').addClass("d-none");
        $('.reciever_block_e2_1').addClass("d-block");
        $('.reciever_block_e2_1').removeClass("d-none");
    });
});