jQuery(document).ready(function() {

    //toastr
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };


    if(localStorage.getItem("toastr_status"))
    {
        toastr.success(localStorage.getItem("toastr_status"));
        localStorage.clear();
    }

    jQuery('body').on('click', '.open-modal-delete', function() {
        var cq_id = $(this).data('value');
        var url = BASE_URL + "/u/common_questions/delete/"+cq_id;

        Swal.fire({
            title: Lang.get('front-end.scripts.sweetalert.delete'),
            /* text: "You won't be able to revert this!", */
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: Lang.get('front-end.users.scripts.sweetalert.yes'),
            cancelButtonText: Lang.get('front-end.users.scripts.sweetalert.no'),
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    async: false,
                    dataType: "json",
                    url: url,
                    type: 'DELETE',
                    beforeSend: function() {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function(data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.scripts.sweetalert.deleted'),
                                Lang.get('front-end.scripts.sweetalert.record.blocked'),
                                    "success"
                                ).then((result) => {
                                // Reload the Page
                                location.reload();
                                });
                        }},
                    error: function(er) {},
                    complete: function(data) {
                        $(document).ajaxStop(KTApp.unblockPage());
                    }
                })
                // result.dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
            } else if (result.dismiss === 'cancel') {
                Swal.fire(
                    Lang.get('front-end.users.scripts.sweetalert.cancelled'),
                    '',
                    'error'
                )
            }
        });
    });

    //edit article
    jQuery('body').on('click', '.open-modal-edit', function() {
        var cq_id = $(this).data('value');
        var url = BASE_URL + "/u/common_questions/edit/" + cq_id;
        window.open(url,"_self");
    });


});

//add ar form
$("#btn-create-arsubmit").click(function(e) {
    var cq_url = BASE_URL + "/u/commonquestions";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myarCreateForm"));
    var type = "POST";
    var ajaxurl = BASE_URL + "/u/common_questions/store";
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            $(document).ajaxStart(KTApp.blockPage({
                overlayColor: '#000000',
                state: 'primary',
                message: Lang.get('front-end.sweetalert.processing'),
            }));
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                Swal.fire(
                    Lang.get('front-end.articles.scripts.sweetalert.added'),
                    Lang.get('front-end.scripts.sweetalert.record.added'),
                        "success"
                    ).then((result) => {
                    // Reload the Page
                    localStorage.setItem("toastr_status",Lang.get('front-end.scripts.sweetalert.record.new.added'))
                    window.open(cq_url,"_self");

                    });
            } else {

                //toastr
                $.each(data.error, function(key, value) {
                    toastr.error(value);
                });

            }
        },
        error: function(data) {
            console.log(data);
        },
        complete: function(data) {
            $(document).ajaxStop(KTApp.unblockPage());
        }
    });
});

//edit form
$("#btn-edit-submit").click(function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myEditForm"));
    var type = "POST";
    var cq_edit_id = jQuery('#cq_edit_id').val();
    var ajaxurl = BASE_URL + "/u/common_questions/update/" + cq_edit_id;
    formData.append('_method', 'PUT');
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            $(document).ajaxStart(KTApp.blockPage({
                overlayColor: '#000000',
                state: 'primary',
                message: Lang.get('front-end.sweetalert.processing'),
            }));
        },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                Swal.fire(
                    Lang.get('front-end.articles.scripts.sweetalert.edited'),
                    Lang.get('front-end.scripts.sweetalert.record.edited'),
                        "success"
                    ).then((result) => {
                    // Reload the Page
                    location.reload();
                    });
            } else {

                //toastr
                $.each(data.error, function(key, value) {
                    toastr.error(value);
                });

            }
        },
        error: function(data) {
            console.log(data);
        },
        complete: function(data) {
            $(document).ajaxStop(KTApp.unblockPage());
        }
    });
});

