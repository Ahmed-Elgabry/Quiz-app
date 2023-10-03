jQuery(document).ready(function () {

    function readURL(input, imagediv, removeImage_) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#" + imagediv).css("background-image", "url(" + e.target.result + ")");
                $("#" + removeImage_).css("display", "flex");
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            alert('select a file to see preview');
            var url = BASE_URL + '/assets/media/users/default-png.png';
            $("#" + imagediv).css("background-image", "+url+");
        }
    }

    $("#quiz_img").change(function () {
        readURL(this, 'imagediv-quiz-img', 'removeImage-quiz-img');
    });

    $('#removeImage-quiz-img').on('click', function (e) {
        document.getElementById("quiz_img").value = null;
        var url = BASE_URL + '/assets/media/users/default-png.png';
        $("#imagediv-quiz-img").css("background-image", "url(" + url + ")");
    });



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

    //options order toggle
    jQuery('body').on('change', '#toggleCheckbox', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/order_options/" + quiz_id;

        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.change'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },
                    success: function (data) {
                        if (data.msg == 'success1') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.done'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.random'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.random'));
                                location.reload();
                            });
                        }else if (data.msg == 'success2') {
                            /* Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.done'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.random'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.random'));
                                location.reload();
                            }); */
                            /* localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.order_answer.particular')); */
                            var url2 = BASE_URL + "/u/userquiz/order_options2/"+quiz_id;
                            window.open(url2, "_self");
                        } else {
                            console.log(data);
                        }
                    },
                    error: function (er) {
                        console.log(er);
                    },
                    complete: function (data) {
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

    // show options order page
    jQuery('body').on('click', '.open-modal-order-options', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/order_options2/"+quiz_id;
        window.open(url, "_self");
    });

    // shown result
    jQuery('body').on('click', '.open-modal-shown-result', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/shown_result/" + quiz_id;
        window.open(url, "_self");
    });

    //edit
    jQuery('body').on('click', '.open-modal-edit', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/edit/" + quiz_id;
        window.open(url, "_self");
    });

    //add new question
    jQuery('body').on('click', '.open-modal-add-next-question', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/next/question/" + quiz_id;
        window.open(url, "_self");
    });


    //share quiz
    jQuery('body').on('click', '.open-modal-share', function () {
        var quiz_slug = $(this).data('value');
        var url = BASE_URL + "/share/" + quiz_slug + "/" + lang;
        window.open(url, "_self");
    });

    //delete quiz
    jQuery('body').on('click', '.open-modal-delete', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/delete/" + quiz_id;

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
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },
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
                    },
                    complete: function (data) {
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

    //open modal try quiz
    jQuery('body').on('click', '.open-modal-try-quiz', function () {
        var quiz_slug = $(this).data('value');
        var url = BASE_URL + "/start/" + quiz_slug + "/" + lang;
        window.open(url, "_self");

        /* jQuery('#showDetails').modal('show');
        var quiz_id = $(this).data('value');
        $.get('/u/userquiz/show/' + quiz_id, function (data) {
            $('#quizIdforTry').val(data.id);
            document.getElementById("quizIdforTry").innerHTML = data.id;
            document.getElementById("modalTitle").innerHTML = data.quiz_name;
            document.getElementById("red_msg").innerHTML = '';
        }); */
    });

    // do try quiz
    jQuery('body').on('click', '.open-modal-do-try-quiz', function () {
        var guest = document.getElementById("guest").value;
        var quiz_id = jQuery('#quizIdforTry').val();
        var message = document.getElementById("red_msg");
        message.innerHTML = "";
        var url = BASE_URL + "/start/" + quiz_id + "/" + guest + "/" + lang;
        if (guest == null || guest == "") {
            message.innerHTML = Lang.get('front-end.quizzes.scripts.tryquiz');
        } else {
            window.open(url, "_self");
        }
    });

    // block sharing results
    jQuery('body').on('click', '.open-modal-block-sharing-results', function () {

        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/block_result/" + quiz_id;
        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.block_sharing_result'),
            text: Lang.get('front-end.quizzes.scripts.sweetalert.text.block_sharing_result'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.blocked'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.block_sharing_result.blocked'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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

    // unblock sharing results
    jQuery('body').on('click', '.open-modal-unblock-sharing-results', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/unblock_result/" + quiz_id;

        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.unblock_sharing_result'),
            text: Lang.get('front-end.quizzes.scripts.sweetalert.text.unblock_sharing_result'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.unblocked'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.unblock_sharing_result.unblocked'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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

    //results
    jQuery('body').on('click', '.open-modal-results', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userreults/" + quiz_id;
        window.open(url, "_self");
    });

    //make it public
    jQuery('body').on('click', '.open-modal-make-it-public', function () {

        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/public_quiz/" + quiz_id;
        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.make_it_public'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.public'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.make_it_public.done'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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

    // make it private
    jQuery('body').on('click', '.open-modal-make-it-private', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/private_quiz/" + quiz_id;

        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.make_it_private'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.private'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.make_it_private.done'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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

    // hide result
    jQuery('body').on('click', '.open-modal-hide-result', function () {

        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/hide_result/" + quiz_id;
        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.hide_result'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.hidden'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.hide_result.hidden'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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

    //  unhide result
    jQuery('body').on('click', '.open-modal-unhide-result', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/unhide_result/" + quiz_id;

        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.unhide_result'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.unhidden'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.unhide_result.unhidden'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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


    // hide result
    jQuery('body').on('click', '.open-modal-hide-result-counter', function () {

        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/hide_result_counter/" + quiz_id;
        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.hide_result_counter'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.hidden'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.hide_result_counter.hidden'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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

    //  unhide result counter
    jQuery('body').on('click', '.open-modal-unhide-result-counter', function () {
        var quiz_id = $(this).data('value');
        var url = BASE_URL + "/u/userquiz/unhide_result_counter/" + quiz_id;

        Swal.fire({
            title: Lang.get('front-end.quizzes.scripts.sweetalert.unhide_result_counter'),
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
                    type: 'GET',
                    beforeSend: function () {
                        $(document).ajaxStart(KTApp.blockPage({
                            overlayColor: '#000000',
                            state: 'primary',
                            message: Lang.get('front-end.sweetalert.processing'),
                        }));
                    },

                    success: function (data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.quizzes.scripts.sweetalert.unhidden'),
                                Lang.get('front-end.quizzes.scripts.sweetalert.unhide_result_counter.unhidden'),
                                "success"
                            ).then((result) => {
                                // Reload the Page
                                location.reload();
                            });
                        }
                    },
                    error: function (er) {},
                    complete: function (data) {
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
    var article_id = jQuery('#article_id').val();
    var ajaxurl = BASE_URL + "/u/userarticles/update/" + article_id;
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
                    Lang.get('front-end.articles.scripts.sweetalert.edited'),
                    Lang.get('front-end.articles.scripts.sweetalert.article.edited'),
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

//add ar form
$("#btn-create-submit").click(function (e) {
    var quizzess_url = BASE_URL + "/u/userquiz";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myCreateForm"));
    var type = "POST";
    var ajaxurl = BASE_URL + "/u/userquiz/store";
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
                    Lang.get('front-end.quizzes.scripts.sweetalert.added'),
                    Lang.get('front-end.quizzes.scripts.sweetalert.quiz.added'),
                    "success"
                ).then((result) => {
                    // Reload the Page
                    localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.quiz.new.added'))
                    window.open(quizzess_url, "_self");

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
