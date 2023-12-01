$(document).ready(function() {

    var owl1 = $('.slider1');
    var owl2 = $('.slider2');
    var owl3 = $('.slider3');
    var owl4 = $('.slider4');
    
    var viewport = $(window).width();
    var itemCount1 = $('.slider4').length;

    var smallScreen = window.matchMedia("(max-width: 900px)");

    if (smallScreen.matches) {
        owl1.owlCarousel({
            items: 1,
            margin: 15,
            mouseDrag: false,
            dots: true
        });

        owl2.owlCarousel({
            items: 1,
            margin: 15,
            mouseDrag: false,
            dots: true
        });

        owl3.owlCarousel({
            items: 1,
            margin: 15,
            mouseDrag: false,
            dots: true
        });

        owl4.owlCarousel({
            items: 1,
            margin: 15,
            mouseDrag: false,
            dots: true
        });
    } 

    owl1.owlCarousel({
        items: 4,
        margin: 15,
        mouseDrag: false,
        dotsEach: false,
        dots: true
    });
    
    owl2.owlCarousel({
        items: 4,
        margin: 15,
        mouseDrag: false,
        dotsEach: false,
        dots: true
    });
    
    owl3.owlCarousel({
        items: 4,
        margin: 15,
        mouseDrag: false,
        dotsEach: false,
        dots: true
    });

    owl4.owlCarousel({
        items: 4,
        loop: true,
        margin: 15,
        mouseDrag: false,
        dotsEach: false,
        dots: true
    });

    // $(window).on('load', function() {
    //     if (itemCount1 > 4) {
    //         // $('.nextButton1').css('svg', 'circle', 'fill: #000');
    //     }
    //     console.log(itemCount1);
    // });

    $('.nextButton1').click(function() {
        owl1.trigger('next.owl.carousel');
    });
    $('.prevButton1').click(function() {
        owl1.trigger('prev.owl.carousel');
    });
    $('.nextButton1_m').click(function() {
        owl1.trigger('next.owl.carousel');
    });
    $('.prevButton1_m').click(function() {
        owl1.trigger('prev.owl.carousel');
    });

    $('.nextButton2').click(function() {
        owl2.trigger('next.owl.carousel');
    });
    $('.prevButton2').click(function() {
        owl2.trigger('prev.owl.carousel');
    });
    $('.nextButton2_m').click(function() {
        owl2.trigger('next.owl.carousel');
    });
    $('.prevButton2_m').click(function() {
        owl2.trigger('prev.owl.carousel');
    });

    $('.nextButton3').click(function() {
        owl3.trigger('next.owl.carousel');
    });
    $('.prevButton3').click(function() {
        owl3.trigger('prev.owl.carousel');
    });
    $('.nextButton3_m').click(function() {
        owl3.trigger('next.owl.carousel');
    });
    $('.prevButton3_m').click(function() {
        owl3.trigger('prev.owl.carousel');
    });

    $('.nextButton4').click(function() {
        owl4.trigger('next.owl.carousel');
    });
    $('.prevButton4').click(function() {
        owl4.trigger('prev.owl.carousel');
    });
    
});
