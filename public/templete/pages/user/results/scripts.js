jQuery(document).ready(function() {

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
      
    if(localStorage.getItem("toastr_status"))
    {
          toastr.success(localStorage.getItem("toastr_status"));
          localStorage.clear();
    }


    jQuery('body').on('click', '.open-modal-delete', function() {
        var id = $(this).data('value');
        var url = BASE_URL + "/u/userreults/delete/"+id;

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

    jQuery('body').on('click', '.open-modal-blockall', function() {
        var url = BASE_URL + "/u/userquiz/block_all_result";

        Swal.fire({
            title: Lang.get('front-end.userresults.scripts.sweetalert.blockall'),
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
                                Lang.get('front-end.userresults.scripts.sweetalert.blocked'),
                                Lang.get('front-end.userresults.scripts.sweetalert.userresults.blocked'),
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

    jQuery('body').on('click', '.open-modal-unblockall', function() {
        var url = BASE_URL + "/u/userquiz/unblock_all_result";

        Swal.fire({
            title: Lang.get('front-end.userresults.scripts.sweetalert.unblockall'),
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
                                Lang.get('front-end.userresults.scripts.sweetalert.unblocked'),
                                Lang.get('front-end.userresults.scripts.sweetalert.userresults.unblocked'),
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




});

