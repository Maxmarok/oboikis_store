$(document).ready(function() {

    $rsv1 = $(".rs_value1");
    $rsv2 = $(".rs_value2");
    $v_max = 700;
    $v1 = 0;
    $v2 = $v_max;
    $rsv1.val($v1);
    $rsv2.val($v2);
    
    new RangeSlider(".range_slider", {
        values: [$v1, $v2],
        min: 0,
        max: $v_max,
        pointRadius: 8,
        colors: {
            points: "#00ADB5",
            rail: "#EDEDED80",
            tracks: "#00ADB5"
        }
    });

    $('select').niceSelect();
    // .onChange(values =>  {$rsv1.val(values[0]), $rsv2.val(values[1])});
});