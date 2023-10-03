jQuery(document).ready(function() {


    //open add modal
    jQuery('body').on('click', '.open-modal-show', function() {
        jQuery('#showDetails').modal('show');
        var user_id = $(this).data('value');
        $.get('/u/users/show/' + user_id, function(data) {
            /* jQuery('#name').val(data.name); */
            $('#name').html(data.name);
            $('#username').html(data.username);
            $('#email').html(data.email);
            $('#created_at').html(data.created_at);
            document.getElementById("modalTitle").innerHTML = Lang.get('front-end.users.scripts.showdetails') + ': '+data.name;
        });
    });

    jQuery('body').on('click', '.open-modal-block', function() {
        var user_id = $(this).data('value');
        console.log(user_id);
        var url = BASE_URL + "/u/users/delete/"+user_id;

        Swal.fire({
            title: Lang.get('front-end.users.scripts.sweetalert.block'),
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
                                Lang.get('front-end.users.scripts.sweetalert.blocked'),
                                Lang.get('front-end.users.scripts.sweetalert.user.blocked'),
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

    jQuery('body').on('click', '.open-modal-upgrade', function() {
        var user_id = $(this).data('value');
        var url = BASE_URL + "/u/users/upgrade/"+user_id;

        Swal.fire({
            title: Lang.get('front-end.users.scripts.sweetalert.grant'),
            text: Lang.get('front-end.users.scripts.sweetalert.grant.text'),
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
                                Lang.get('front-end.users.scripts.sweetalert.granted'),
                                Lang.get('front-end.users.scripts.sweetalert.user.granted'),
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

