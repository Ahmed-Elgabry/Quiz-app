jQuery(document).ready(function() {

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

    //toastr
    if(localStorage.getItem("toastr_status"))
    {
          toastr.success(localStorage.getItem("toastr_status"));
          localStorage.clear();
    }

    //open statistics modal
    jQuery('body').on('click', '.open-modal-statistics', function() {
        jQuery('#statisticsArticle').modal('show');
        var article_id = $(this).data('value');
        $.get('/u/articles/show/' + article_id, function(data) {
            $('#s_views').html(data.statistics.views);
            document.getElementById("statisticsmodalTitle").innerHTML = Lang.get('front-end.datatable.statistics') + ': '+data.title;
        });
    });

    //open edit featured modal
    jQuery('body').on('click', '.open-modal-featured', function() {
        jQuery('#editFeatured').modal('show');
        var article_id = $(this).data('value');
        $.get('/u/articles/show/' + article_id, function(data) {
            $('#edit_featured_article_id').val(data.id);

            if (data.is_featured == 'مميز' || data.is_featured == 'Featured') {
                $("div.article_featured select").val('1');
            }else{
                $("div.article_featured select").val('0');
            }
            document.getElementById("featuredmodalTitle").innerHTML = Lang.get('front-end.articles.scripts.editFeatured') + ': '+data.title;
        });
    });

    //open edit status modal
    jQuery('body').on('click', '.open-modal-edit-status', function() {
        jQuery('#editStatus').modal('show');
        var article_id = $(this).data('value');
        $.get('/u/articles/show/' + article_id, function(data) {

            $('#edit_status_article_id').val(data.id);

            if (data.status == 'قيد الإنتظار' || data.status == 'Pending') {
                $("div.article_status select").val("P");
            } else if (data.status == 'تمت الموافقة' || data.status == 'Approved') {
                $("div.article_status select").val("A");
            }else{
                $("div.article_status select").val("R");
            }
            document.getElementById("modalTitle").innerHTML = Lang.get('front-end.articles.scripts.editStatus') + ': '+data.title;
        });
    });



    //edit article
    jQuery('body').on('click', '.open-modal-edit', function() {
        var article_id = $(this).data('value');
        var url = BASE_URL + "/u/articles/edit/" + article_id;
        window.open(url,"_self");
    });


    //delete article
    jQuery('body').on('click', '.open-modal-delete', function() {
        var article_id = $(this).data('value');
        var url = BASE_URL + "/u/articles/delete/"+article_id;

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
    var ajaxurl = BASE_URL + "/u/articles/update/" + article_id;
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
$("#btn-create-arsubmit").click(function(e) {
    var articles_url = BASE_URL + "/u/articles";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myarCreateForm"));
    var type = "POST";
    var ajaxurl = BASE_URL + "/u/articles/store";
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

//add en form
$("#btn-create-ensubmit").click(function(e) {
    var articles_url = BASE_URL + "/u/articles";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myenCreateForm"));
    var type = "POST";
    var ajaxurl = BASE_URL + "/u/articles/store/en";
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


//edit status form
$("#btn-edit-article-status").click(function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("editArticleStatusForm"));
    var type = "POST";
    var article_id = jQuery('#edit_status_article_id').val();
    var ajaxurl = BASE_URL + "/u/articles/update_status/" + article_id;
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

//edit status form
$("#btn-edit-article-featured").click(function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("editArticleFeaturedForm"));
    var type = "POST";
    var article_id = jQuery('#edit_featured_article_id').val();
    var ajaxurl = BASE_URL + "/u/articles/update_featured/" + article_id;
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
