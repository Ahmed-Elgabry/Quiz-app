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

    //delete category
    jQuery('body').on('click', '.open-modal-delete', function () {
        var id = $(this).data('value');
        var url = BASE_URL + "/u/categories/delete/" + id;

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

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.articles.scripts.sweetalert.deleted'),
                                Lang.get('front-end.scripts.sweetalert.record.blocked'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        } else {
                            console.log(data);
                        }
                    },
                    error: function (er) {
                        console.log(er);
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

    //add en form
    $("#btn-create-submit").click(function (e) {
        var categories_url = BASE_URL + "/u/categories";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(document.getElementById("myenCreateForm"));
        var type = "POST";
        var ajaxurl = BASE_URL + "/u/categories/store";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function () {
                $(document).ajaxStart(KTApp.blockPage({
                    overlayColor: '#000000',
                    state: 'primary',
                    message: Lang.get('front-end.sweetalert.processing'),
                }));
            },
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    Swal.fire(
                        Lang.get('front-end.articles.scripts.sweetalert.added'),
                        Lang.get('front-end.articles.scripts.sweetalert.article.added'),
                        "success"
                    ).then((result) => {
                        // Reload the Page
                        localStorage.setItem("toastr_status", Lang.get('front-end.articles.scripts.sweetalert.article.new.added'))
                        window.open(categories_url, "_self");

                    });
                } else {

                    //toastr
                    $.each(data.error, function (key, value) {
                        toastr.error(value);
                    });

                }
            },
            error: function (data) {
                console.log(data);
            },
            complete: function (data) {
                $(document).ajaxStop(KTApp.unblockPage());
            }
        });
    });



    //edit category
    jQuery('body').on('click', '.open-modal-edit', function () {
        var category_id = $(this).data('value');
        var url = BASE_URL + "/u/categories/edit/" + category_id;
        window.open(url, "_self");
    });

    //userquizzes
    jQuery('body').on('click', '.open-modal-user-quizzes', function () {
        var category_id = $(this).data('value');
        var url = BASE_URL + "/u/categories/user-quizzes/" + category_id;
        window.open(url, "_self");
    });

    //quick quizzes
    jQuery('body').on('click', '.open-modal-quick-quizzes', function () {
        var category_id = $(this).data('value');
        var url = BASE_URL + "/u/categories/quick-quizzes/" + category_id;
        window.open(url, "_self");
    });





});

//edit form
$("#btn-edit-submit").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myEditForm"));
    var type = "POST";
    var category_id = jQuery('#category_id').val();
    var ajaxurl = BASE_URL + "/u/categories/update/" + category_id;
    formData.append('_method', 'PUT');
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $(document).ajaxStart(KTApp.blockPage({
                overlayColor: '#000000',
                state: 'primary',
                message: Lang.get('front-end.sweetalert.processing'),
            }));
        },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                Swal.fire(
                    Lang.get('front-end.categories.scripts.sweetalert.edited'),
                    Lang.get('front-end.categories.scripts.sweetalert.category.edited'),
                    "success"
                ).then((result) => {
                    // Reload the Page
                    location.reload();
                });
            } else {

                //toastr
                $.each(data.error, function (key, value) {
                    toastr.error(value);
                });

            }
        },
        error: function (data) {
            console.log(data);
        },
        complete: function (data) {
            $(document).ajaxStop(KTApp.unblockPage());
        }
    });
});

//add form
$("#btn-create-submit").click(function (e) {
    var categories_url = BASE_URL + "/u/categories";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myCreateForm"));
    var type = "POST";
    var ajaxurl = BASE_URL + "/u/categories/store";
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $(document).ajaxStart(KTApp.blockPage({
                overlayColor: '#000000',
                state: 'primary',
                message: Lang.get('front-end.sweetalert.processing'),
            }));
        },
        success: function (data) {
            if ($.isEmptyObject(data.error)) {
                Swal.fire(
                    Lang.get('front-end.articles.scripts.sweetalert.added'),
                    Lang.get('front-end.categories.scripts.sweetalert.category.added'),
                    "success"
                ).then((result) => {
                    // Reload the Page
                    localStorage.setItem("toastr_status", Lang.get('front-end.categories.scripts.sweetalert.category.new.added'))
                    window.open(categories_url, "_self");

                });
            } else {

                //toastr
                $.each(data.error, function (key, value) {
                    toastr.error(value);
                });

            }
        },
        error: function (data) {
            console.log(data);
        },
        complete: function (data) {
            $(document).ajaxStop(KTApp.unblockPage());
        }
    });
});
