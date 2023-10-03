$(window).on('hashchange', function () {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getData(page);

        }

    }
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        var page = $(this).attr('href').split('page=')[1];

        getData(page);

    });

});

function getData(page) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '?page=' + page,
        type: "get",
        datatype: "html",
        beforeSend: function () {
            $(document).on('click', '#tag_container', function () {
                $.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    },
                    /* overlayColor: '#000000',
                    state: 'primary', */
                    message: Lang.get('front-end.sweetalert.processing'),
                });

            });
        },
        success: function (questions) {
            $("#tag_container").empty().html(questions);
            $('html,body').animate({
                scrollTop: $("#tag_container").offset().top
            });
        },
        error: function (data) {
            console.log(data);
        },
        complete: function (data) {
            $(document).on('click', '#tag_container', function () {
                $.unblockUI();
            });
        }
    });


    /* $.ajax({
        url: '?page=' + page,
        type: "get",
        datatype: "html",
    }).done(function(questions) {
        $("#tag_container").empty().html(questions);
        $('html,body').animate({
            scrollTop: $("#tag_container").offset().top
        });
    }).fail(function(jqXHR, ajaxOptions, thrownError) {
        alert('No response from server');
    }); */
}

localStorage.removeItem('option');

var option = JSON.parse(localStorage.getItem("option"));

function getresult() {
    var guest = document.getElementById("name_guest").value;
    var message = document.getElementById("p");
    message.innerHTML = "";

    var message2 = document.getElementById("p2");
    message2.innerHTML = "";

    if ($('input[type="checkbox"]').prop("checked") == true) {
        /* console.log("Checkbox is checked."); */
        if (guest == null || guest == "") {
            message.innerHTML = Lang.get('front-end.userQuizzess.starttest.verification');
        } else {

            var ans = option.split(',');
            ans = ans.slice(1); //for first null
            var ans_array = null;

            var counter = document.getElementById("counter_").value;
            /* var counter1 = '{{ $counter +1 }}'; */

            var b = [];
            var a = [];
            var c = [];

            for (var i = 0; i < counter; i++) {
                b[i] = null;
                a[i] = null;
                c[i] = null;
            }

            for (i = 0; i < ans.length; i++) {
                var s = ans[i];
                var ress = s.substring(s.indexOf("@"));
                for (z = 1; z < counter + 1; z++) {
                    var y = '@' + z;
                    if (ress == y) {
                        b[z - 1] = b[z - 1] + ',' + s;
                        c[z - 1] = b[z - 1].split(',');
                    }
                }
            }
            for (i = 0; i < counter; i++) {
                var ii = i + 1;
                if (c[i] != undefined) {
                    a[i] = c[i][c[i].length - 1];
                    var y = '@' + ii;
                    a[i] = a[i].replace(y, '');
                    ii = ii + 1;
                } else {
                    a[i] = '';
                }
            }

            for (i = 0; i < counter; i++) {
                ans_array = ans_array + ',' + a[i];
            }
            var ans_array1 = ans_array.split(',');
            ans_array1 = ans_array1.slice(1);

            var quiz_slug = document.getElementById("quiz_slug").value;
            var plocale = document.getElementById("plocale").value;

            var url = BASE_URL + "/quick-quiz/store/" + quiz_slug + "/" + guest + "/" + ans_array1 + "/" + plocale;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                async: false,
                dataType: "json",
                url: url,
                type: 'post',
                beforeSend: function () {
                    $(document).on('click', '#tag_container', function () {
                        $.blockUI({
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            },
                            message: Lang.get('front-end.sweetalert.processing'),
                        });
                    });
                },

                success: function (data) {
                    var url2 = BASE_URL + "/quick-quiz/result/" + data.slug + "/" + plocale;
                    window.open(url2, "_self");
                },
                error: function (er) {
                    console.log(er);
                },
                complete: function (data) {
                    $(document).on('click', '#tag_container', function () {
                        $.unblockUI();
                    });
                }
            });
        }
    } else if ($('input[type="checkbox"]').prop("checked") == false) {
        /* console.log("Checkbox is unchecked."); */
        message2.innerHTML = Lang.get('front-end.userQuizzess.starttest.verification.wrong');
    }

}

function pass() {
    option = option + ',' + "null";
    localStorage.setItem("option", JSON.stringify(option));
}

function prev() {
    option = option + ',' + "prev";
    localStorage.setItem("option", JSON.stringify(option));
}
