<div class="row justify-content-center">
    <div class="col-md-7 text-center heading-section">
        <h1 class="">{{ $quiz->quiz_name }}</h1>

        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-8 align-center ml-auto mr-auto mb-5">
            <div class="row justify-content-center">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{$questions->previousPageUrl()}}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="left-etc" hidden><a href="#">&laquo;</a></li>
                    @foreach ($questions_ as $question)
                    <li class="page-item @if($questions->currentPage() ==  $loop->iteration) active @endif "><a class="page-link" @if (\App::isLocale('ar')) href="{{ route('quick-quiz.start_test', ['slug'=> $quiz->slug,'lang'=>'ar']) }}?page= {{ $loop->iteration }}" @else href="{{ route('quick-quiz.start_test', ['slug'=> $quiz->slug,'lang'=>'en']) }}?page= {{ $loop->iteration }}" @endif> {{ $loop->iteration }}</a></li>
                    @endforeach
                    <li class="page-item"><a class="page-link" href="{{$questions->nextPageUrl()}}">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@foreach ($questions as $question)
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 align-center ml-auto mr-auto mb-5">
        <h4 class="mb-4"><strong>{{ $question->question_text }}</strong> </h4>
        @if (!is_null($question->question_img))
        <div class="post-thumb">
            <img src="{{ asset( $question->question_img) }}" alt="Almiqias">
        </div>
        <br>
        @endif
    </div>
</div>


<div id="aaaaa" class="container justify-content-center">
    <div id="aaaaa" class="container justify-content-center">

        <div class="col-md-15 row align-items-center justify-content-center">
            <?php $m = 1; ?>
            @foreach ($question->options as $item)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option{{ $m }}value" value="{{ $item->id }}" type="hidden">
                    <input id="option{{ $m }}value{{ $questions->currentPage() }}" value="{{ $item->id }}" type="hidden">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor{{ $m }}{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3" @if ($questions->hasMorePages()) onclick="option_({{ $m }});this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option_({{ $m }});this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                <div style="color:black;"> <b>{{$item->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php $m++; ?>
            @endforeach
            <input id="pointer" value="{{ $questions->currentPage() }}" type="hidden">
        </div>
    </div>

    @endforeach
    @section('modal')
    <!-- Modal -->
    <div class="modal fade window-popup popup-subscribe" id="FinishModal" tabindex="-1" role="dialog" style="padding-right: 17px;" aria-modal="true" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="email" role="tabpanel" aria-labelledby="email-tab">
                            <div class="form-group has-error">
                                {{-- <div class="form-item">
                                    <h5 class="fw-medium">{{ $quiz->quiz_name}}</h5>
                            </div> --}}
                            <div class="form-item">
                                {{-- <p class="text-danger fs-14 fw-medium"> {{ __("Are you sure you want to finish?") }}</p> <br> --}}
                                <label class="control-label" for="firstname">{{ __('Enter your name Please') }} :</label>
                                <input class="input--grey input--squared required" type="text" id="name_guest" placeholder="{{ __('Enter your name Please') }}" >
                                <p class="fs-14 fw-medium" id="p" style="color:red"> </p>
                                <div class="checkbox mb30 text-center">
                                    {{--  <label><input type="checkbox" name="is_complete" id="is_complete" >{{ __('Are you sure you want to finish?') }}</label>  --}}
                                    <p class="fs-14 fw-medium" id="p2" style="color:red"> </p>
                                </div>

                            </div>

                            <div class="form-item">
                                <button type="button" name="" class="crumina-button button--green button--l w-100" onclick="getresult()">{{ __("Submit") }}</button>
                            </div>
                        </div>

                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    {{ __("Close") }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
<h3 class="heading text-center">{{ __("Question #") }} : {{ $questions->currentPage() }} </h3>
<br>
<input id="plocale" style="display: none" @if(App::isLocale('ar')) value="ar" @else value="en" @endif>
<h3 class="heading text-center"><button id="reset" class="crumina-button button--primary button--l" onclick="reStart();">{{ __('Re-start test') }}</button></h3>

</div>

<script>
    var pointerr = "{{ $questions->currentPage() }}";

    var aans_array = null;
    var counter = '{{ $counter  }}';
    var counter1 = '{{ $counter +1 }}';

    var bb = [];
    var aa = [];
    var cc = [];

    for (var i = 0; i < counter; i++) {
        bb[i] = null;
        aa[i] = null;
        cc[i] = null;
    }

    if (option != null) {
        var aans = option.split(',');
        aans = aans.slice(1);

        for (i = 0; i < aans.length; i++) {
            var ss = aans[i];
            var res = ss.substring(ss.indexOf("@"));
            for (z = 1; z < counter1; z++) {
                var y = '@' + z;
                if (res == y) {
                    bb[z - 1] = bb[z - 1] + ',' + ss;
                    cc[z - 1] = bb[z - 1].split(',');
                }
            }
        }
        for (i = 0; i < counter; i++) {
            var ii = i + 1;
            if (cc[i] != undefined) {
                aa[i] = cc[i][cc[i].length - 1];
                var y = '@' + ii;
                aa[i] = aa[i].replace(y, '');
                ii = ii + 1;
            }
        }
        for (i = 0; i < counter; i++) {
            aans_array = aans_array + ',' + aa[i];
        }

        var ans_bg = aans_array.split(',');
        for (i = 0; i < ans_bg.length; i++) {
            var s = ans_bg[i];

            for (o = 1; o < 11; o++) {
                var text_ = "option" + o + "value{{ $questions->currentPage() }}";
                var text_bg = "bgColor" + o + "{{ $questions->currentPage() }}";

                if (document.getElementById(text_)) {
                    if (s == document.getElementById(text_).value && document.getElementById(text_bg) != undefined) {
                        document.getElementById(text_bg).style.backgroundColor = "Gainsboro";
                    }
                }
            }
        }
    }
</script>
<script>
    function reStart() {
        var slug = '{{ $quiz->slug }}';
        var plocale = document.getElementById("plocale").value;
        var url = BASE_URL + "/quick-quiz/start/" + slug + "/" + plocale; //start quiz route
        window.open(url, "_self");
    }
</script>
<script type="text/javascript">
    function option_(i) {
        option = option + ',' + document.getElementById("option" + i + "value").value + '@' + document.getElementById("pointer").value;
        {{--  console.log(option);  --}}
        localStorage.setItem("option", JSON.stringify(option));
        document.getElementById("bgColor" + i + "{{ $questions->currentPage() }}").style.backgroundColor = "#ffc107";
    }
</script>
<script>
    $(document).ready(function() {
        $(".pagination").rPage();
    });
</script>
