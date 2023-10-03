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
                    url: BASE_URL + '/u/articles/approved', //BASE_URL >> custom var
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
            field: 'image',
            sortable: false,
            title: Lang.get('front-end.articles.datatable.title.img'),
            template: function(row) {
                return '<img alt="almiqias" src="'+row.image+'" class="" width="100px" >';
            },
        }, {
            field: 'title',
            title: Lang.get('front-end.articles.datatable.title.tilte'),
        }, {
            field: 'is_arabic',
            title: Lang.get('front-end.articles.datatable.title.language'),
            template: function(row) {
                return '<span class="kt-font-bold kt-font-primary">' + row.is_arabic + '</span>';
            }
        }, {
            field: 'status',
            title: Lang.get('front-end.articles.datatable.title.status'),
            template: function(row) {
                if(row.status == 'Pending' || row.status == 'قيد الإنتظار' ){
                    return '<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">' + row.status + '</span>';
                }else if(row.status == 'Approved' || row.status == 'تمت الموافقة'){
                    return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">' + row.status + '</span>';
                }else{
                    return '<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">' + row.status + '</span>';
                }
            }
        }, {
            field: 'writer_id ',
            title: Lang.get('front-end.articles.datatable.title.writtenby'),
            template: function(row) {
                return '<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">' + row.user.username + '</span>';
            }
        }, {
            field: 'is_featured',
            title: Lang.get('front-end.articles.datatable.title.featured'),
            template: function(row) {
                if(row.is_featured == 'مميز' || row.is_featured == 'Featured' ){
                    return '<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">' + row.is_featured + '</span>';
                }else{
                    return '-';
                }
            }
        }, {
            field: 'created_at',
            title: Lang.get('front-end.articles.datatable.title.created_at'),
        }/* , {
            field: 'updated_at',
            title: Lang.get('front-end.articles.datatable.title.updated_at'),
        } */, {
            field: 'Actions',
            title: Lang.get('front-end.users.datatable.actions'),
            sortable: false,
            width: 110,
            overflow: 'visible',
            textAlign: 'left',
	        autoHide: false,
            template: function(row) {
                if(row.status == 'Approved' || row.status == 'تمت الموافقة'){
                    var featured = '<a class="dropdown-item open-modal-featured" data-value="'+row.id+'" href="javascript:;"><i class="la la-star"></i> '+Lang.get('front-end.datatable.editFeatured')+'</a>';
                }else{
                    var featured = '';
                }
	            return '\
                <div class="dropdown">\
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">\
                        <i class="flaticon2-settings"></i>\
                    </a>\
                    <div class="dropdown-menu dropdown-menu-right">\
                        <a class="dropdown-item open-modal-edit" data-value="'+row.id+'" href="javascript:;"><i class="la la-edit"></i> '+Lang.get('front-end.datatable.edit')+'</a>\
                        <a class="dropdown-item open-modal-edit-status" data-value="'+row.id+'" href="javascript:;"><i class="la la-pencil"></i> '+Lang.get('front-end.datatable.editStatus')+'</a> '+featured+'\
                        <a class="dropdown-item open-modal-statistics" data-value="'+row.id+'" href="javascript:;"><i class="la la-bar-chart"></i> '+Lang.get('front-end.datatable.statistics')+'</a>\
                        <a class="dropdown-item open-modal-delete" data-value="'+row.id+'" href="javascript:;"><i class="la la-remove"></i> '+Lang.get('front-end.datatable.delete')+'</a>\
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

             var url = BASE_URL + "/u/articles/deleteall";
            Swal.fire({
                title: Lang.get('front-end.articles.scripts.sweetalert.deleteall'),
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
                                    Lang.get('front-end.articles.scripts.sweetalert.deleted'),
                                    Lang.get('front-end.articles.scripts.sweetalert.article.deleteall'),
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

