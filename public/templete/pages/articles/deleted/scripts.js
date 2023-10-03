jQuery(document).ready(function() {

    jQuery('body').on('click', '.open-modal-restore', function() {
        var article_id = $(this).data('value');
        var url = BASE_URL + "/u/articles/trashed/restore/"+article_id;

        Swal.fire({
            title: Lang.get('front-end.articles.scripts.sweetalert.restore'),
            type: 'info',
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
                    type: 'PUT',
                    processData: false,
                    contentType: false,

                    success: function(data) {
                        if (data) {
                            Swal.fire(
                                Lang.get('front-end.articles.scripts.sweetalert.restored'),
                                Lang.get('front-end.articles.scripts.sweetalert.article.restored'),
                                    "success"
                                ).then((result) => {
                                // Reload the Page
                                location.reload();
                                });
                        }},
                    error: function(er) {}
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

    jQuery('body').on('click', '.open-modal-forcedelete', function() {
        var user_id = $(this).data('value');
        console.log(user_id);
        var url = BASE_URL + "/u/articles/trashed/delete/"+user_id;

        Swal.fire({
            title: Lang.get('front-end.articles.scripts.sweetalert.forcedelete'),
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
                                Lang.get('front-end.users.scripts.sweetalert.forcedeleted'),
                                Lang.get('front-end.articles.scripts.sweetalert.article.forcedeleted'),
                                    "success"
                                ).then((result) => {
                                // Reload the Page
                                location.reload();
                                });
                        }},
                    error: function(er) {}
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
