"use strict";
// Class definition

var category_id = document.getElementById("category_id").value;
var KTDatatableRecordSelectionDemo = function() {
    // Private functions
    var options = {
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: BASE_URL + '/u/categories/quick-quizzes/'+category_id,
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
            field: 'quiz_name',
            title: Lang.get('front-end.user.results.datatable.title.quiz_name'),
        }, {
            field: 'user.username',
            title: Lang.get('front-end.quickquizzes.datatable.title.owner_name'),
            template: function(row) {
                return '<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">' + row.owner_name + '</span>';
            }

        }, {
            field: 'category.name',
            title: Lang.get('front-end.userquizzes.datatable.title.category'),
            /* template: function(row) {
                if(row.category){
                    return '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">' + row.category.name + '</span>';
                }
            } */
        }, {
            field: 'lang',
            title: Lang.get('front-end.articles.datatable.title.language'),
            template: function(row) {
                if(row.lang == "Arabic" || row.lang == "العربية"){
                    return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">' + row.lang + '</span>';
                }else if(row.lang == "English" || row.lang == "الانجليزية"){
                    return '<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">' + row.lang + '</span>';
                }
            }
        }, {
            /* sortable: false, */
            field: 'is_featured',
            title: Lang.get('front-end.articles.datatable.title.featured'),
            template: function(row) {
                if(row.is_featured == 1){
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
        }, {
            field: 'created_at',
            title: Lang.get('front-end.articles.datatable.title.created_at'),
        },  {
            field: 'Actions',
            title: Lang.get('front-end.users.datatable.actions'),
            sortable: false,
            width: 110,
            overflow: 'visible',
            textAlign: 'left',
	        autoHide: false,
            template: function(row) {


                return '\
                <div class="dropdown">\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">\
                        <i class="flaticon2-settings"></i>\
                    </a>\
                    <div class="dropdown-menu dropdown-menu-right">\
                        <a class="dropdown-item open-modal-share" data-value="'+row.slug+'" href="javascript:;"><i class="la flaticon-reply"></i> '+Lang.get('front-end.datatable.quiz.share')+'</a>\
                        <a class="dropdown-item open-modal-edit-category" data-value="'+row.id+'" href="javascript:;"><i class="la la-pencil"></i> '+Lang.get('front-end.datatable.category')+'</a>\
                        <a class="dropdown-item open-modal-edit-lang" data-value="'+row.id+'" href="javascript:;"><i class="la la-language"></i> '+Lang.get('front-end.datatable.language')+'</a>\
                        <a class="dropdown-item open-modal-delete" data-value="'+row.id+'" href="javascript:;"><i class="la  la-remove"></i> '+Lang.get('front-end.datatable.delete')+'</a>\
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

             var url = BASE_URL + "/u/quick-quizzes/deleteall";
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
                        error: function(er) {}
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

