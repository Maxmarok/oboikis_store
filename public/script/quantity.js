$(document).ready(function() {

    var $qMinus = $('.q-minus');
    var $qPlus = $('.q-plus');
    var $quantity = $('.quantity');

    $qMinus.click(quantityMinus);
    $qPlus.click(quantityPlus);

    $quantity.on('input', function() {
        if ($quantity.val() > 100) {
            $quantity.val(100);
        };
    });

    function quantityMinus() {
        if ($quantity.val() > 1) {
            $quantity.val(+$quantity.val() - 1);
        }
    }

    function quantityPlus() {
        if ($quantity.val() < 100) {
            $quantity.val(+$quantity.val() + 1);
        }
    }
    
});