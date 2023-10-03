jQuery(document).ready(function () {

    var lang = document.getElementById("lang").value;
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

    //select Category
    (function () {

        $("#category").select2({
            placeholder: Lang.get('front-end.userquizzes.datatable.title.category')+' ...',
            allowClear: true,
            ajax: {
                url: BASE_URL +'/u/usersquizzes/selectCategory',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term || '', //for search
                        page: params.page || 1 //for pagination
                    }
                },
                cache: true
            }
        });
    })();



    //share quiz
    jQuery('body').on('click', '.open-modal-share', function () {
        var quiz_slug = $(this).data('value');
        var url = BASE_URL + "/share/" + quiz_slug + "/" + lang;
        window.open(url, "_self");
    });

    //delete quiz
    jQuery('body').on('click', '.open-modal-delete', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/usersquizzes/delete/" + quiz_id;

        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.delete'),
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
                                Lang.get('front-end.quizzes.scripts.sweetalert.deleted'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.quiz.deleted'),
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

    //featured
    jQuery('body').on('change', '#toggleCheckbox', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/usersquizzes/featured/" + quiz_id;

        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.admin.featured'),
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
                    type: 'POST',

                    success: function (data) {
                        if (data.msg == 'success1') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.done'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.admin.userquiz.featured'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        } else if (data.msg == 'success2') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.done'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.admin.userquiz.unfeatured'),
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

    //open change lang
    jQuery('body').on('click', '.open-modal-edit-lang', function () {
        jQuery('#editLang').modal('show');
        var id = $(this).data('value');
        $.get('/u/usersquizzes/show/' + id, function (data) {

            $('#edit_lang_id').val(data.id);

            if (data.lang == "Arabic" || data.lang == "العربية") {
                $("div.article_Lang select").val("ar");
            } else if (data.lang == "English" || data.lang == "الانجليزية") {
                $("div.article_Lang select").val("en");
            } else {
                $("div.article_Lang select").val("non");
            }
            document.getElementById("modalTitle").innerHTML = Lang.get('front-end.quizzes.scripts.editLang') + ': ' + data.quiz_name;
        });
    });

    //open change category
    jQuery('body').on('click', '.open-modal-edit-category', function () {
        jQuery('#editCategory').modal('show');
        var id = $(this).data('value');
        $.get('/u/usersquizzes/show/' + id, function (data) {

            $('#edit_category_id').val(data.id);

            /* if (data.lang == "Arabic" || data.lang == "العربية") {
                $("div.article_Lang select").val("ar");
            } else if (data.lang == "English" || data.lang == "الانجليزية") {
                $("div.article_Lang select").val("en");
            }else{
                $("div.article_Lang select").val("non");
            } */
            document.getElementById("modalTitle2").innerHTML = Lang.get('front-end.quizzes.scripts.editCategory') + ': ' + data.quiz_name;
        });
    });

});

//edit lang
$("#btn-edit-quiz-lang").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("editQuizLangForm"));
    var type = "POST";
    var quiz_id = jQuery('#edit_lang_id').val();
    var ajaxurl = BASE_URL + "/u/usersquizzes/update_lang/" + quiz_id;
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
                    Lang.get('front-end.quizzes.scripts.sweetalert.edited'),
                    Lang.get('front-end.quizzes.scripts.sweetalert.quiz.editlang'),
                    "success"
                ).then((result) => {
                    // Reload the Page
                    location.reload();
                });
            } else {

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
$("#btn-edit-quiz-category").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("editQuizCategoryForm"));
    var type = "POST";
    var quiz_id = jQuery('#edit_category_id').val();
    var ajaxurl = BASE_URL + "/u/usersquizzes/update_status/" + quiz_id;
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
                    Lang.get('front-end.quizzes.scripts.sweetalert.edited'),
                    Lang.get('front-end.quizzes.scripts.sweetalert.quiz.editcategory'),
                    "success"
                ).then((result) => {
                    // Reload the Page
                    location.reload();
                });
            } else {

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
