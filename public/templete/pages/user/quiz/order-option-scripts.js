jQuery(document).ready(function () {

    //toastr
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    if (localStorage.getItem("toastr_status")) {
        toastr.success(localStorage.getItem("toastr_status"));
        localStorage.clear();
    }

    if (localStorage.getItem("toastr_error_status")) {
        toastr.error(localStorage.getItem("toastr_error_status"));
        localStorage.clear();
    }


    $('select').on('change', function (event) {
        var prevValue = $(this).data('previous');
        $('select').not(this).find('option[value="' + prevValue + '"]').show();
        var value = $(this).val();
        $(this).data('previous', value);
        $('select').not(this).find('option[value="' + value + '"]').hide();
    });

});
