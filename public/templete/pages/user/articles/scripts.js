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

    //edit article
    jQuery('body').on('click', '.open-modal-edit', function() {
        var article_id = $(this).data('value');
        var url = BASE_URL + "/u/userarticles/edit/" + article_id;
        window.open(url,"_self");
    });


    //delete article
    jQuery('body').on('click', '.open-modal-delete', function() {
        var article_id = $(this).data('value');
        var url = BASE_URL + "/u/userarticles/delete/"+article_id;

        Swal.fire({
            title: Lang.get('front-end.articles.scripts.sweetalert.delete'),
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

                    success: function(data) {
                        if (data.msg == 'success') {
                            Swal.fire(
                                Lang.get('front-end.articles.scripts.sweetalert.deleted'),
                                Lang.get('front-end.articles.scripts.sweetalert.article.deleted'),
                                    "success"
                                ).then((result) => {
                                // Reload the Page
                                location.reload();
                                });
                        }else{
                            console.log(data);
                        }},
                    error: function(er) {console.log(er);}
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
$("#btn-edit-submit").click(function(e) {
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
                    Lang.get('front-end.articles.scripts.sweetalert.article.edited'),
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

//add ar form
$("#btn-create-submit").click(function(e) {
    var articles_url = BASE_URL + "/u/userarticles";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myCreateForm"));
    var type = "POST";
    var ajaxurl = BASE_URL + "/u/userarticles/store";
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
                    Lang.get('front-end.articles.scripts.sweetalert.article.added'),
                        "success"
                    ).then((result) => {
                    // Reload the Page
                    localStorage.setItem("toastr_status",Lang.get('front-end.articles.scripts.sweetalert.article.new.added'))
                    window.open(articles_url,"_self");

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
