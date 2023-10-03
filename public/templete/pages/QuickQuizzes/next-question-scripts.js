jQuery(document).ready(function () {

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


    function readURL(input, imagediv, removeImage) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#" + imagediv).css("background-image", "url(" + e.target.result + ")");
                $("#" + removeImage).css("display", "flex");
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            alert('select a file to see preview');
            var url = BASE_URL + '/assets/media/users/default-png.png';
            $("#" + imagediv).css("background-image", "+url+");
        }
    }

    //question image
    $("#question_img").change(function () {
        readURL(this, 'imagediv-question-img', 'removeImage-question-img');
    });

    $('#removeImage-question-img').on('click', function (e) {
        document.getElementById("question_img").value = null;
        var url = BASE_URL + '/assets/media/users/default-png.png';
        $("#imagediv-question-img").css("background-image", "url(" + url + ")");
    });


    $("input[name$='type_q']").click(function() {
        var type = $(this).val();
        $("div.question_div").hide();
        $("#dynamic_field_" + type).show();
    });


    //for add multi options question
    var i=1;
    $('#add').click(function(){
        var y=i+1;
        if(i<10){
        $('#dynamic_field_m').append('<div id="row'+i+'" class="form-group row"><label class="col-form-label col-lg-3 col-sm-12"> '+Lang.get('front-end.datatable.option#')+' '+y+'</label><div class="col-lg-2 col-md-9 col-sm-12"><div class="input-group"><input class="form-control" type="text" name="option_m[]"></div><span class="text-danger error-text option_m_'+i+'_error" id="option_m_'+i+'_error"></span></div><label class="col-form-label col-1">'+Lang.get('front-end.datatable.option.grade')+'</label><div class="col-lg-2 col-md-9 col-sm-12"><div class="input-group"><input class="form-control" name="option_weight[]" type="number" step="1" min="0" placeholder="'+Lang.get('front-end.datatable.option.blank')+'"></div><span class="text-danger error-text option_weight_'+i+'_error" id="option_weight_'+i+'_error"></span></div><div class="col-lg-4 col-md-3 col-sm-3"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove me-auto">-</button></div></div>');
        i++;
        }
    });
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        i--;
    });

    // survey question
    var i_=1;
    $('#add_survey').click(function(){
        var y_=i_+1;
        if(i_<10){
        $('#dynamic_field_s').append('<div id="row_'+i_+'" class="form-group row"><label class="col-form-label col-lg-3 col-sm-12"> '+Lang.get('front-end.datatable.option#')+' '+y_+'</label><div class="col-lg-2 col-md-9 col-sm-12"><div class="input-group"><input class="form-control" type="text" name="option_s[]"></div><span class="text-danger error-text option_s_'+i_+'_error" id="option_s_'+i_+'_error"></span></div><div class="col-lg-4 col-md-3 col-sm-3"><button type="button" name="remove_" id="'+i_+'" class="btn btn-danger btn_remove_ me-auto">-</button></div></div>');
        i_++;
        }
    });
    $(document).on('click', '.btn_remove_', function(){
        var button_id = $(this).attr("id");
        $('#row_'+button_id+'').remove();
        i_--;
    });

});

//add form
$("#btn-create-submit").click(function(e) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myCreateForm"));
    var type = "POST";
    var quiz_id_ = jQuery('#quiz_id').val();
    var ajaxurl = BASE_URL + "/quick-quiz/nextquestion/"+quiz_id_;
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
                    Lang.get('front-end.quizzes.scripts.sweetalert.added'),
                    Lang.get('front-end.quizzes.scripts.sweetalert.question.added'),
                        "success"
                    ).then((result) => {
                    // Reload the Page
                    /* localStorage.setItem("toastr_status",Lang.get('front-end.quizzes.scripts.sweetalert.question.new.added')); */

                    var access_url = BASE_URL + "/quick-quiz/access/"+data;
                    window.open(access_url, "_self");

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

//next question
$("#btn-next-question-submit").click(function (e) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myCreateForm"));
    var type = "POST";
    var quiz_id_ = jQuery('#quiz_id').val();
    var ajaxurl = BASE_URL + "/quick-quiz/nextquestion/"+quiz_id_;
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
                /* console.log(data); */
                Swal.fire(
                    Lang.get('front-end.quizzes.scripts.sweetalert.added'),
                    Lang.get('front-end.quizzes.scripts.sweetalert.question.added'),
                    "success"
                ).then((result) => {
                    // Reload the Page

                    var page_type = document.getElementById("page_type").value;
                    console.log(page_type);

                    if(page_type == 'quick_quiz'){
                        var next_q_url = BASE_URL + "/quick-quiz/next/" + data;
                        localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.question.new.added'))
                        window.open(next_q_url, "_self");

                    } else if(page_type == 'survey_quiz'){
                        var next_q_url = BASE_URL + "/quick-quiz/next-survey/" + data;
                        localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.question.new.added'))
                        window.open(next_q_url, "_self");
                    }else if(page_type == 'multiple_quiz'){
                        var next_q_url = BASE_URL + "/quick-quiz/next-multiple/" + data;
                        localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.question.new.added'))
                        window.open(next_q_url, "_self");

                    }

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

