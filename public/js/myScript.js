$('.monthpicker').datetimepicker({
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 3,
    minView: 3,
    format: "MM-yyyy",
    viewMode: "months",
    minViewMode: "months",
    forceParse: 0
});

$(document).ready(function () {
    $(".date_range").daterangepicker({
        "locale":{
            format:"MM/DD/MM/YYYY"
        },
        "autoApply": true,
        "showDropdowns": true,
        "alwaysShowCalendars": true
    });
});

function confirmation_alert(targetUrl) {
    //alert(targetUrl);
    $("#dialog").dialog({
        buttons : {
            "Confirm" : function() {
                window.location.href = targetUrl;
            },
            "Cancel" : function() {
                $(this).dialog("close");
            }
        }
    });
    $("#dialog").dialog("open");
}


function alertMessage(text) {
    $('.customText').text(text);
    $('#alertError').modal('show');
}

