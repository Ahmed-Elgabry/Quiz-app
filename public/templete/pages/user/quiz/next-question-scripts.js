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


    function readURL(input,imagediv,removeImage) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $("#"+imagediv).css("background-image", "url(" + e.target.result + ")");
            $("#"+removeImage).css("display", "flex");
          }
          reader.readAsDataURL(input.files[0]);
        } else {
          alert('select a file to see preview');
          var url = BASE_URL + '/assets/media/users/default-png.png';
          $("#"+imagediv).css("background-image", "+url+");
        }
      }

      $("#question_img").change(function() {
        readURL(this,'imagediv-question-img','removeImage-question-img');
      });

      $('#removeImage-question-img').on('click', function(e) {
        document.getElementById("question_img").value = null;
        var url = BASE_URL + '/assets/media/users/default-png.png';
        $("#imagediv-question-img").css("background-image", "url("+url+")");
    });

    //option1 image
    $("#option1_img").change(function () {
        readURL(this, 'imagediv-option1-img', 'removeImage-option1-img');
    });

    $('#removeImage-option1-img').on('click', function (e) {
        document.getElementById("option1_img").value = null;
        var url = BASE_URL + '/assets/media/users/default-png.png';
        $("#imagediv-option1-img").css("background-image", "url(" + url + ")");
    });

    //option2 image
    $("#option2_img").change(function () {
        readURL(this, 'imagediv-option2-img', 'removeImage-option2-img');
    });

    $('#removeImage-option2-img').on('click', function (e) {
        document.getElementById("option2_img").value = null;
        var url = BASE_URL + '/assets/media/users/default-png.png';
        $("#imagediv-option2-img").css("background-image", "url(" + url + ")");
    });

    //option3 image
    $("#option3_img").change(function () {
        readURL(this, 'imagediv-option3-img', 'removeImage-option3-img');
    });

    $('#removeImage-option3-img').on('click', function (e) {
        document.getElementById("option3_img").value = null;
        var url = BASE_URL + '/assets/media/users/default-png.png';
        $("#imagediv-option3-img").css("background-image", "url(" + url + ")");
    });

    //option4 image
    $("#option4_img").change(function () {
        readURL(this, 'imagediv-option4-img', 'removeImage-option4-img');
    });

    $('#removeImage-option4-img').on('click', function (e) {
        document.getElementById("option4_img").value = null;
        var url = BASE_URL + '/assets/media/users/default-png.png';
        $("#imagediv-option4-img").css("background-image", "url(" + url + ")");
    });

});

//add form
$("#btn-create-submit").click(function(e) {

    var quizzess_url = BASE_URL + "/u/userquiz";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    var formData = new FormData(document.getElementById("myCreateForm"));
    var type = "POST";
    var quiz_id_ = jQuery('#quiz_id').val();
    var ajaxurl = BASE_URL + "/u/userquiz/nextquestion/"+quiz_id_;
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
                    localStorage.setItem("toastr_status",Lang.get('front-end.quizzes.scripts.sweetalert.question.new.added'))
                    window.open(quizzess_url,"_self");

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
    var ajaxurl = BASE_URL + "/u/userquiz/nextquestion/"+quiz_id_;
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
                    var next_q_url = BASE_URL + "/u/userquiz/next/question/" + data;
                    localStorage.setItem("toastr_status", Lang.get('front-end.quizzes.scripts.sweetalert.question.new.added'))
                    window.open(next_q_url, "_self");

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

