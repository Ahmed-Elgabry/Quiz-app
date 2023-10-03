"use strict";
// Class definition

var KTDatatableRecordSelectionDemo = function() {
    // Private functions
    var options = {
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: BASE_URL + '/u/userquiz',
                    method: 'GET',
                },
                map: function (data) {
                    return data.data;
                }
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: true, // enable/disable datatable scroll both horizontal and
            // vertical when needed.
            height: 500, // datatable's body's fixed height
            footer: false // display/hide footer
        },

        // column sorting
        sortable: true,

        pagination: true,

        // columns definition

        columns: [{
            field: 'id',
            title: '#',
            sortable: false,
            width: 20,
            selector: {
                class: 'kt-checkbox--solid'
            },
            textAlign: 'center',
        }, {
            sortable: false,
            field: 'quiz_img',
            title: Lang.get('front-end.articles.datatable.title.img'),
            template: function(row) {
                return '<img alt="almiqias" src="'+row.quiz_img+'" class="" width="50px" >';
            },
        }, {
            field: 'quiz_name',
            title: Lang.get('front-end.user.results.datatable.title.quiz_name'),
        }, {
            field: 'is_private',
            title: Lang.get('front-end.user.quiz.datatable.title.public_private'),
            template: function(row) {
                if(row.is_private == "عام" || row.is_private == "Public"){
                    return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">' + row.is_private + '</span>';
                }else{
                    return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">' + row.is_private + '</span>';
                }
            }
        }, {
            field: 'results_share',
            title: Lang.get('front-end.user.quiz.datatable.title.Sharing_results'),
            template: function(row) {
                if(row.results_share == "مشاركة" || row.results_share == "Shared"){
                    return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">' + row.results_share + '</span>';
                }else{
                    return '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">' + row.results_share + '</span>';
                }
            }
        }, {
            field: 'hide_result',
            title: Lang.get('front-end.user.quiz.datatable.title.hiding_result'),
            template: function(row) {
                if(row.hide_result == "مخفية" || row.hide_result == "Hidden"){
                    return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">' + row.hide_result + '</span>';

                }else{
                    return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">' + row.hide_result + '</span>';
                }
            }
        } , {
            /* sortable: false, */
            field: 'order_options',
            title: Lang.get('front-end.user.quiz.datatable.title.option_order'),
            template: function(row) {
                if(row.order_options == 1){
                    var checked = "checked";

                }else{
                    var checked = "";
                }
                return '\<div class="col-3">\
                            \<span class="kt-switch kt-switch--icon">\
                                \<label>\
                                    \<input type="checkbox" id="toggleCheckbox" data-value="'+row.id+'" name="" '+checked+'>\
                                    \<span></span>\
                                \</label>\
                            \</span>\
                        \</div>';
            }
        } , {
            field: 'created_at',
            title: Lang.get('front-end.articles.datatable.title.created_at'),
        }, {
            field: 'Actions2',
            title: '...',
            sortable: false,
            width: 110,
            overflow: 'visible',
            textAlign: 'left',
	        autoHide: false,
            template: function(row) {


            return '\<button class="btn btn-sm btn-clean btn-icon btn-icon-sm open-modal-edit" data-value="'+row.id+'" title="'+Lang.get('front-end.datatable.edit')+'"><i class="la la-edit"></i></button>\
            \<button class="btn btn-sm btn-clean btn-icon btn-icon-sm open-modal-add-next-question" data-value="'+row.id+'" title="'+Lang.get('front-end.datatable.add_next_question')+'"><i class="la la-plus-circle"></i></button>\
                \<button class="btn btn-sm btn-clean btn-icon btn-icon-sm open-modal-delete" data-value="'+row.id+'" title="'+Lang.get('front-end.datatable.delete')+'"><i class="la la-remove"></i></button>\
            ';

            },
        }, {
            field: 'Actions',
            title: Lang.get('front-end.users.datatable.actions'),
            sortable: false,
            width: 110,
            overflow: 'visible',
            textAlign: 'left',
	        autoHide: false,
            template: function(row) {

                if(row.results_share == "مشاركة" || row.results_share == "Shared"){
                    var sharing_result = '<a class="dropdown-item open-modal-block-sharing-results" data-value="'+row.id+'" href="javascript:;"><i class="la la-eye-slash"></i> '+Lang.get('front-end.datatable.quiz.block_sharing_result')+'</a>';
                }else{
                    var sharing_result = '<a class="dropdown-item open-modal-unblock-sharing-results" data-value="'+row.id+'" href="javascript:;"><i class="la la-eye"></i> '+Lang.get('front-end.datatable.quiz.unblock_sharing_result')+'</a>';

                }

                if(row.is_private == "عام" || row.is_private == "Public"){
                    var private_public = '<a class="dropdown-item open-modal-make-it-private" data-value="'+row.id+'" href="javascript:;"><i class="la flaticon-alert-off"></i> '+Lang.get('front-end.datatable.private')+'</a>';
                }else{
                    var private_public = '<a class="dropdown-item open-modal-make-it-public" data-value="'+row.id+'" href="javascript:;"><i class="la flaticon-alert"></i> '+Lang.get('front-end.datatable.public')+'</a>';
                }

                if(row.hide_result == "مخفية" || row.hide_result == "Hidden"){
                    var hidding_result = '<a class="dropdown-item open-modal-unhide-result" data-value="'+row.id+'" href="javascript:;"><i class="la la-eye"></i> '+Lang.get('front-end.datatable.unhide_result')+'</a>';
                }else{
                    var hidding_result = '<a class="dropdown-item open-modal-hide-result" data-value="'+row.id+'" href="javascript:;"><i class="la la-eye-slash"></i> '+Lang.get('front-end.datatable.hide_result')+'</a>';
                }

                if(row.hide_result_counter == "مقفل" || row.hide_result_counter == "Locked"){
                    var hide_result_counter = '<a class="dropdown-item open-modal-unhide-result-counter" data-value="'+row.id+'" href="javascript:;"><i class="la la-eye"></i> '+Lang.get('front-end.datatable.unhide_result_counter')+'</a>';
                }else{
                    var hide_result_counter = '<a class="dropdown-item open-modal-hide-result-counter" data-value="'+row.id+'" href="javascript:;"><i class="la la-eye-slash"></i> '+Lang.get('front-end.datatable.hide_result_counter')+'</a>';
                }


                if(row.order_options == 1){
                    var order_options = '<a class="dropdown-item open-modal-order-options" data-value="'+row.id+'" href="javascript:;"><i class="la flaticon2-menu-4"></i> '+Lang.get('front-end.datatable.options_order')+'</a>';
                }else{
                    var order_options ="";
                }

                return '\
                <div class="dropdown">\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">\
                        <i class="flaticon2-settings"></i>\
                    </a>\
                    <div class="dropdown-menu dropdown-menu-right">\
                        <a class="dropdown-item open-modal-try-quiz" data-value="'+row.slug+'" href="javascript:;"><i class="la flaticon-list"></i> '+Lang.get('front-end.datatable.quiz.try')+'</a>\
                        <a class="dropdown-item open-modal-share" data-value="'+row.slug+'" href="javascript:;"><i class="la flaticon-reply"></i> '+Lang.get('front-end.datatable.quiz.share')+'</a>\
                        <a class="dropdown-item open-modal-results" data-value="'+row.id+'" href="javascript:;"><i class="la flaticon-statistics"></i> '+Lang.get('front-end.datatable.results')+'</a>'+sharing_result+private_public+hidding_result+hide_result_counter+'\
                        <a class="dropdown-item open-modal-shown-result" data-value="'+row.id+'" href="javascript:;"><i class="la la-diamond"></i> '+Lang.get('front-end.datatable.add_shown_result')+'</a>'+order_options+'\
                    </div>\
                </div>';


            },
        }],
        translate: {
            records: {
                processing: Lang.get('front-end.users.datatable.translate.records.processing'),
                noRecords: Lang.get('front-end.users.datatable.translate.records.noRecords')
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: Lang.get('front-end.users.datatable.translate.toolbar.pagination.items.default.first'),
                            prev: Lang.get('front-end.users.datatable.translate.toolbar.pagination.items.default.prev'),
                            next: Lang.get('front-end.users.datatable.translate.toolbar.pagination.items.default.next'),
                            last: Lang.get('front-end.users.datatable.translate.toolbar.pagination.items.default.last'),
                            more: Lang.get('front-end.users.datatable.translate.toolbar.pagination.items.default.more'),
                            input: Lang.get('front-end.users.datatable.translate.toolbar.pagination.items.default.input'),
                            select: Lang.get('front-end.users.datatable.translate.toolbar.pagination.items.default.select'),
                        },
                        info: Lang.get('front-end.users.datatable.translate.toolbar.pagination.info')
                    }
                }
            }
        }

    };

    // basic demo
    var localSelectorDemo = function() {

        options.search = {
            input: $('#generalSearch'),
        };

        var datatable = $('#local_record_selection').KTDatatable(options);

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });

        $('#kt_form_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
        });

        $('#kt_form_status,#kt_form_type').selectpicker();

        datatable.on(
            'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
            function(e) {
                var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
                var count = checkedNodes.length;
                $('#kt_datatable_selected_number').html(count);
                if (count > 0) {
                    $('#kt_datatable_group_action_form').collapse('show');
                } else {
                    $('#kt_datatable_group_action_form').collapse('hide');
                }
            });

        $('#kt_modal_fetch_id').on('show.bs.modal', function(e) {
            var ids = datatable.rows('.kt-datatable__row--active').
            nodes().
            find('.kt-checkbox--single > [type="checkbox"]').
            map(function(i, chk) {
                return $(chk).val();
            });
            var c = document.createDocumentFragment();
            for (var i = 0; i < ids.length; i++) {
                var li = document.createElement('li');
                li.setAttribute('data-id', ids[i]);
                li.innerHTML = 'Selected record ID: ' + ids[i];
                c.appendChild(li);
            }
            $(e.target).find('.kt-datatable_selected_ids').append(c);
        }).on('hide.bs.modal', function(e) {
            $(e.target).find('.kt-datatable_selected_ids').empty();
        });

        $("#btn-ids").click(function (e) {

            var ids = datatable.rows('.kt-datatable__row--active').
            nodes().
            find('.kt-checkbox--single > [type="checkbox"]').
            map(function(i, chk) {
                return $(chk).val();
            });

            var all_ids = [];
            for (var i = 0; i < ids.length; i++) {
                console.log('ids '+ids[i]);
                all_ids.push(ids[i]);
                console.log(all_ids);
            }

             var url = BASE_URL + "/u/userquiz/deleteall";
            Swal.fire({
                title: Lang.get('front-end.quizzes.scripts.sweetalert.deleteall'),
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
                        data: {id:all_ids},
                        type: 'POST',
                        beforeSend: function () {
                            $(document).ajaxStart(KTApp.blockPage({
                                overlayColor: '#000000',
                                state: 'primary',
                                message: Lang.get('front-end.sweetalert.processing'),
                            }));
                        },
                        success: function(data) {

                            if (data.msg == 'success') {
                                Swal.fire(
                                    Lang.get('front-end.quizzes.scripts.sweetalert.deleted'),
                                    Lang.get('front-end.quizzes.scripts.sweetalert.quiz.deleteall'),
                                    "success"
                                    ).then((result) => {
                                    // Reload the Page
                                    location.reload();
                                    });
                            }
                        },
                        error: function(er) {},
                        complete: function (data) {
                            $(document).ajaxStop(KTApp.unblockPage());
                        }
                    });
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


    };

    return {
        // public functions
        init: function() {
            localSelectorDemo();
           // serverSelectorDemo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableRecordSelectionDemo.init();
});

