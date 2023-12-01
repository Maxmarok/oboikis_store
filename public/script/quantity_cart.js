$(document).ready(function() {

    $qm1 = $("#qm_1");
    $qm2 = $("#qm_2");
    $qm3 = $("#qm_3");
    $qp1 = $("#qp_1");
    $qp2 = $("#qp_2");
    $qp3 = $("#qp_3");
    $q1 = $("#q_1");
    $q2 = $("#q_2");
    $q3 = $("#q_3");

    // $q1.on("change", isright(this));

    $q1.on('input', function() {
        if ($q1.val() > 100) {
            $q1.val(100);
        };
    });

    $q2.on('input', function() {
        if ($q2.val() > 100) {
            $q2.val(100);
        };
    });

    $q3.on('input', function() {
        if ($q3.val() > 100) {
            $q3.val(100);
        };
    });

    $qm1.click(function() {
        if ($q1.val() > 1) {
            $q1.val(+$q1.val() - 1);
        }
    });
    $qp1.click(function() {
        if ($q1.val() < 100) {
            $q1.val(+$q1.val() + 1);
        }
    });


    $qm2.click(function() {
        if ($q2.val() > 1) {
            $q2.val(+$q2.val() - 1);
        }
    });
    $qp2.click(function() {
        if ($q2.val() < 100) {
            $q2.val(+$q2.val() + 1);
        }
    });


    $qm3.click(function() {
        if ($q3.val() > 1) {
            $q3.val(+$q3.val() - 1);
        }
    });
    $qp3.click(function() {
        if ($q3.val() < 100) {
            $q3.val(+$q3.val() + 1);
        }
    });

    
});