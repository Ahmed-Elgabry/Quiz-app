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

    if (localStorage.getItem("toastr_error_status")) {
        toastr.error(localStorage.getItem("toastr_error_status"));
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
            var url = BASE_URL + '/assets/media/users/default2.png';
            $("#" + imagediv).css("background-image", "+url+");
        }
    }

    //quiz image
    $("#quiz_img").change(function () {
        readURL(this, 'imagediv-quiz-img', 'removeImage-quiz-img');
    });

    $('#removeImage-quiz-img').on('click', function (e) {
        document.getElementById("quiz_img").value = null;
        var url = BASE_URL + '/assets/media/users/default2.png';
        $("#imagediv-quiz-img").css("background-image", "url(" + url + ")");
    });


    var questions_counter = jQuery('#questions_counter_').val();
    //question image
    for (let i = 1; i <= questions_counter; i++) {
       $("#question_img_"+i).change(function () {
        readURL(this, 'imagediv-question-img-'+i, 'removeImage-question-img-'+i);
        });

        $('#removeImage-question-img-'+i).on('click', function (e) {
            document.getElementById("question_img_"+i).value = null;
            var url = BASE_URL + '/assets/media/users/default-png.png';
            $("#imagediv-question-img-"+i).css("background-image", "url(" + url + ")");
        });

        for (let m = 1; m <= 4; m++) {
            //option1 image
            //option{{ $x }}_img_{{ $i }}
            //imagediv-option{{ $x }}-img-{{ $i }}
            //removeImage-option{{ $x }}-img-{{ $i }}
            $("#option"+m+"_img_"+i).change(function () {
                readURL(this, 'imagediv-option'+m+'-img-'+i, 'removeImage-option'+m+'-img-'+i);
            });

            $('#removeImage-option'+m+'-img-'+i).on('click', function (e) {
                document.getElementById("option"+m+"_img_"+i).value = null;
                var url = BASE_URL + '/assets/media/users/default-png.png';
                $("#imagediv-option"+m+"-img-"+i).css("background-image", "url(" + url + ")");
            });
        }
    }
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
    var quiz_id = jQuery('#quiz_id').val();
    var ajaxurl = BASE_URL + "/u/userquiz/update2/" + quiz_id;
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
                    Lang.get('front-end.quizzes.scripts.sweetalert.edited'),
                    Lang.get('front-end.quizzes.scripts.sweetalert.quiz.edited'),
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
