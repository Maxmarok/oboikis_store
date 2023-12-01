$(document).ready(function() {
    var $g_input1 = $('.goods_input1');
    var $g_input2 = $('.goods_input2');
    var $g_input3 = $('.goods_input3');
    var $g_general_input = $('.goods_input');

    $g_general_input.click(g_selector);

    $g_input1.click(changeBG1);
    $g_input2.click(changeBG2);
    $g_input3.click(changeBG3);


    function changeBG1() {
        if ($g_input1.prop("checked")) {
            $(".change_bg1").css("background-color", "#f2fbfb");
        } else {
            $(".change_bg1").css("background-color", "#fff");
        }
    }

    function changeBG2() {
        if ($g_input2.prop("checked")) {
            $(".change_bg2").css("background-color", "#f2fbfb");
        } else {
            $(".change_bg2").css("background-color", "#fff");
        }
    }
    
    function changeBG3() {
        if ($g_input3.prop("checked")) {
            $(".change_bg3").css("background-color", "#f2fbfb");
        } else {
            $(".change_bg3").css("background-color", "#fff");
        }
    }

    function g_selector() {
        if ($g_general_input.prop("checked")) {
            $g_input1.prop("checked", true);
            $g_input2.prop("checked", true);
            $g_input3.prop("checked", true);
            changeBG1();
            changeBG2();
            changeBG3();
        } else {
            $g_input1.prop("checked", false);
            $g_input2.prop("checked", false);
            $g_input3.prop("checked", false);
            changeBG1();
            changeBG2();
            changeBG3();
        }
    }

});