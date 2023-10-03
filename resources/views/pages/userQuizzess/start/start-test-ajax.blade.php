@if($quiz->is_private == "عام" || $quiz->is_private == "Public")
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
                    <li class="page-item @if($questions->currentPage() ==  $loop->iteration) active @endif "><a class="page-link" @if (\App::isLocale('ar')) href="{{ route('user-quiz.start_test', ['slug'=> $quiz->slug,'lang'=>'ar']) }}?page= {{ $loop->iteration }}" @else href="{{ route('user-quiz.start_test', ['slug'=> $quiz->slug,'lang'=>'en']) }}?page= {{ $loop->iteration }}" @endif> {{ $loop->iteration }}</a></li>
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

@if ($quiz->order_options && $order)
<div id="aaaaa" class="container justify-content-center">
    <div class="col-md-15 row align-items-center justify-content-center">

        @if ($question->options->count() >= $order->op1)
        <div class="col-md-3 col-sm-6 size-new">
            <div class="text-center">
                <input id="option1value" style="display: none" value="{{ $question->options[$order->op1 -1]->id }}">
                <input id="option1value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[$order->op1 -1]->id }}">
                <ul class="pagination" role="navigation">
                    <li id="bgColor1{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                        <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}} " @if ($questions->hasMorePages()) onclick="option1();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                            @else onclick="option1();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                            @endif rel="next">
                            @if (!is_null($question->options[$order->op1 -1]->option_img))
                            <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[$order->op1 -1]->option_img) }}" /><br>
                            @endif
                            <br>
                            <div style="color:black;"> <b>{{ $question->options[$order->op1 -1]->option_text }}</b></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        @if ($question->options->count() >= $order->op2)
        <div class="col-md-3 col-sm-6 size-new">
            <div class="text-center">
                <input id="option2value" style="display: none" value="{{ $question->options[$order->op2 -1]->id }}">
                <input id="option2value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[$order->op2 -1]->id }}">
                <ul class="pagination" role="navigation">
                    <li id="bgColor2{{ $questions->currentPage() }}" class="page-item " style="width:100%;">
                        <a id="a" style="width:100%;" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option2();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                            @else onclick="option2();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                            @endif rel="next">
                            @if (!is_null($question->options[$order->op2 -1]->option_img))
                            <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[$order->op2 -1]->option_img) }}" /><br>
                            @endif
                            <br>
                            <div style="color:black;"> <b>{{ $question->options[$order->op2 -1]->option_text }}</b></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        @if ($question->options->count() >= $order->op3)
        <div class="col-md-3 col-sm-6 size-new">
            <div class="text-center">
                <input id="option3value" style="display: none" value="{{ $question->options[$order->op3 -1]->id }}">
                <input id="option3value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[$order->op3 -1]->id }}">
                <ul class="pagination" role="navigation">
                    <li id="bgColor3{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                        <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3{{--   mb-4  --}}" @if ($questions->hasMorePages()) onclick="option3();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                            @else onclick="option3();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                            @endif rel="next">
                            @if (!is_null($question->options[$order->op3 -1]->option_img))
                            <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[$order->op3 -1]->option_img) }}" /><br>
                            @endif
                            <br>
                            <div style="color:black;"> <b>{{ $question->options[$order->op3 -1]->option_text }}</b></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        @if ($question->options->count() >= $order->op4)
        <div class="col-md-3 col-sm-6 size-new">
            <div class="text-center">
                <input id="option4value" style="display: none" value="{{ $question->options[$order->op4 -1]->id }}">
                <input id="option4value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[$order->op4 -1]->id }}">
                <ul class="pagination" role="navigation">
                    <li id="bgColor4{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                        <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option4();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                            @else onclick="option4();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                            @endif rel="next">
                            @if (!is_null($question->options[$order->op4 -1]->option_img))
                            <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[$order->op4 -1]->option_img) }}" /><br>
                            @endif
                            <br>
                            <div style="color:black;"><b>{{ $question->options[$order->op4 -1]->option_text }}</b> </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        <input id="pointer" style="display: none" value="{{ $questions->currentPage() }}">

    </div>

    @else
    <div id="aaaaa" class="container justify-content-center">
        @php
        $randomNumber = rand(0,3);
        @endphp

        @if($randomNumber==0)
        <div class="col-md-15 row align-items-center justify-content-center">
            @if ($question->options->count() > 0)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option1value" style="display: none" value="{{ $question->options[0]->id }}">
                    <input id="option1value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[0]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor1{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}} " @if ($questions->hasMorePages()) onclick="option1();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option1();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[0]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[0]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[0]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 1)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option2value" style="display: none" value="{{ $question->options[1]->id }}">
                    <input id="option2value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[1]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor2{{ $questions->currentPage() }}" class="page-item " style="width:100%;">
                            <a id="a" style="width:100%;" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option2();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option2();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[1]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[1]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[1]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 2)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option3value" style="display: none" value="{{ $question->options[2]->id }}">
                    <input id="option3value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[2]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor3{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3{{--   mb-4  --}}" @if ($questions->hasMorePages()) onclick="option3();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option3();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[2]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[2]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[2]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 3)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option4value" style="display: none" value="{{ $question->options[3]->id }}">
                    <input id="option4value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[3]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor4{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option4();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option4();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[3]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[3]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[3]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            <input id="pointer" style="display: none" value="{{ $questions->currentPage() }}">

        </div>
        @elseif($randomNumber==1)
        <div class="col-md-15 row align-items-center justify-content-center">
            @if ($question->options->count() > 1)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option2value" style="display: none" value="{{ $question->options[1]->id }}">
                    <input id="option2value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[1]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor2{{ $questions->currentPage() }}" class="page-item " style="width:100%;">
                            <a id="a" style="width:100%;" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option2();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option2();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[1]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[1]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[1]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 2)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option3value" style="display: none" value="{{ $question->options[2]->id }}">
                    <input id="option3value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[2]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor3{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3{{--   mb-4  --}}" @if ($questions->hasMorePages()) onclick="option3();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option3();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[2]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[2]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[2]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 3)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option4value" style="display: none" value="{{ $question->options[3]->id }}">
                    <input id="option4value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[3]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor4{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option4();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option4();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[3]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[3]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[3]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 0)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option1value" style="display: none" value="{{ $question->options[0]->id }}">
                    <input id="option1value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[0]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor1{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}} " @if ($questions->hasMorePages()) onclick="option1();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option1();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[0]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[0]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[0]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            <input id="pointer" style="display: none" value="{{ $questions->currentPage() }}">

        </div>
        @elseif($randomNumber==2)
        <div class="col-md-15 row align-items-center justify-content-center">

            @if ($question->options->count() > 2)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option3value" style="display: none" value="{{ $question->options[2]->id }}">
                    <input id="option3value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[2]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor3{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3{{--   mb-4  --}}" @if ($questions->hasMorePages()) onclick="option3();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option3();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[2]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[2]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[2]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 3)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option4value" style="display: none" value="{{ $question->options[3]->id }}">
                    <input id="option4value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[3]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor4{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option4();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option4();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[3]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[3]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[3]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 0)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option1value" style="display: none" value="{{ $question->options[0]->id }}">
                    <input id="option1value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[0]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor1{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}} " @if ($questions->hasMorePages()) onclick="option1();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option1();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[0]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[0]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[0]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 1)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option2value" style="display: none" value="{{ $question->options[1]->id }}">
                    <input id="option2value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[1]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor2{{ $questions->currentPage() }}" class="page-item " style="width:100%;">
                            <a id="a" style="width:100%;" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option2();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option2();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[1]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[1]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[1]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif


            <input id="pointer" style="display: none" value="{{ $questions->currentPage() }}">

        </div>
        @else
        <div class="col-md-15 row align-items-center justify-content-center">
            @if ($question->options->count() > 3)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option4value" style="display: none" value="{{ $question->options[3]->id }}">
                    <input id="option4value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[3]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor4{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option4();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option4();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[3]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[3]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[3]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 0)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option1value" style="display: none" value="{{ $question->options[0]->id }}">
                    <input id="option1value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[0]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor1{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}} " @if ($questions->hasMorePages()) onclick="option1();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option1();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[0]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[0]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[0]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 1)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option2value" style="display: none" value="{{ $question->options[1]->id }}">
                    <input id="option2value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[1]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor2{{ $questions->currentPage() }}" class="page-item " style="width:100%;">
                            <a id="a" style="width:100%;" class="btn-white border  d-block px-3 py-3 {{--  mb-4  --}}" @if ($questions->hasMorePages()) onclick="option2();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option2();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[1]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[1]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[1]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            @if ($question->options->count() > 2)
            <div class="col-md-3 col-sm-6 size-new">
                <div class="text-center">
                    <input id="option3value" style="display: none" value="{{ $question->options[2]->id }}">
                    <input id="option3value{{ $questions->currentPage() }}" style="display: none" value="{{ $question->options[2]->id }}">
                    <ul class="pagination" role="navigation">
                        <li id="bgColor3{{ $questions->currentPage() }}" class="page-item" style="width:100%">
                            <a id="a" style="width:100%" class="btn-white border  d-block px-3 py-3{{--   mb-4  --}}" @if ($questions->hasMorePages()) onclick="option3();this.onclick=null;" href="{{$questions->nextPageUrl()}}"
                                @else onclick="option3();this.onclick=null;" data-toggle="modal" data-target="#FinishModal"
                                @endif rel="next">
                                @if (!is_null($question->options[2]->option_img))
                                <img alt="almiqias" style="width:100%;height:210px" src="{{ asset( $question->options[2]->option_img) }}" /><br>
                                @endif
                                <br>
                                <div style="color:black;"> <b>{{ $question->options[2]->option_text }}</b></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @endif

            <input id="pointer" style="display: none" value="{{ $questions->currentPage() }}">

        </div>
        @endif

    </div>
    @endif

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

@else
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mr-auto ml-auto align-center">
        <p class="fs-18 fw-medium">{{ __('It is a private Quiz for the user, you can not able to see it !') }}</p>
    </div>
</div>
@endif

</div>


<script>
    var option1v, element1 = document.getElementById("option1value{{ $questions->currentPage() }}");
    if (element1 != null) {
        option1v = element1.value;
    }
    var option2v, element2 = document.getElementById("option2value{{ $questions->currentPage() }}");
    if (element2 != null) {
        option2v = element2.value;
    }
    var option3v, element3 = document.getElementById("option3value{{ $questions->currentPage() }}");
    if (element3 != null) {
        option3v = element3.value;
    }
    var option4v, element4 = document.getElementById("option4value{{ $questions->currentPage() }}");
    if (element4 != null) {
        option4v = element4.value;
    }

    var bg1v = "bgColor1{{ $questions->currentPage() }}";
    var bg2v = "bgColor2{{ $questions->currentPage() }}";
    var bg3v = "bgColor3{{ $questions->currentPage() }}";
    var bg4v = "bgColor4{{ $questions->currentPage() }}";

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
            if (s == option1v && document.getElementById(bg1v) != undefined) {
                document.getElementById(bg1v).style.backgroundColor = "Gainsboro";
            }
            if (s == option2v && document.getElementById(bg2v) != undefined) {
                document.getElementById(bg2v).style.backgroundColor = "Gainsboro";
            }
            if (s == option3v && document.getElementById(bg3v) != undefined) {
                document.getElementById(bg3v).style.backgroundColor = "Gainsboro";
            }
            if (s == option4v && document.getElementById(bg4v) != undefined) {
                document.getElementById(bg4v).style.backgroundColor = "Gainsboro";
            }

        }
    }
</script>
<script>
    function reStart() {
        var quiz_slug = '{{ $quiz->slug }}';
        var plocale = document.getElementById("plocale").value;
        window.open("{{ URL::to('/') }}/start/" + quiz_slug + "/" + plocale, "_self");
    }
</script>
<script type="text/javascript">
    function option1() {
        var link = ' {{$questions->nextPageUrl()}} ';
        var counter = '{{ $counter }}';
        var end = document.getElementById("endquiz");
        var myEle4 = document.getElementById("aaaa");
        var myEle3 = document.getElementById("aaa");
        var myEle2 = document.getElementById("aa");
        var myEle1 = document.getElementById("a");
        if (link.length < counter) {
            document.getElementById("aaaaa").style.display = "none";
            if (myEle1) {
                myEle1.removeAttribute("href");
            }
            if (myEle2) {
                myEle2.removeAttribute("href");
            }
            if (myEle3) {
                myEle3.removeAttribute("href");
            }
            if (myEle4) {
                myEle4.removeAttribute("href");
            }
        }
        option = option + ',' + document.getElementById("option1value").value + '@' + document.getElementById("pointer").value;
        localStorage.setItem("option", JSON.stringify(option));
        document.getElementById("bgColor1{{ $questions->currentPage() }}").style.backgroundColor = "#ffc107";

    }
</script>

<script type="text/javascript">
    function option2() {
        var link = ' {{$questions->nextPageUrl()}} ';
        var counter = '{{ $counter }}';
        var end = document.getElementById("endquiz");
        var myEle4 = document.getElementById("aaaa");
        var myEle3 = document.getElementById("aaa");
        var myEle2 = document.getElementById("aa");
        var myEle1 = document.getElementById("a");
        if (link.length < counter) {
            document.getElementById("aaaaa").style.display = "none";
            if (myEle1) {
                myEle1.removeAttribute("href");
            }
            if (myEle2) {
                myEle2.removeAttribute("href");
            }
            if (myEle3) {
                myEle3.removeAttribute("href");
            }
            if (myEle4) {
                myEle4.removeAttribute("href");
            }
        }
        option = option + ',' + document.getElementById("option2value").value + '@' + document.getElementById("pointer").value;
        localStorage.setItem("option", JSON.stringify(option));
        document.getElementById("bgColor2{{ $questions->currentPage() }}").style.backgroundColor = "#ffc107";

    }
</script>
<script type="text/javascript">
    function option3() {
        var link = ' {{$questions->nextPageUrl()}} ';
        var counter = '{{ $counter }}';
        var end = document.getElementById("endquiz");
        var myEle4 = document.getElementById("aaaa");
        var myEle3 = document.getElementById("aaa");
        var myEle2 = document.getElementById("aa");
        var myEle1 = document.getElementById("a");
        if (link.length < counter) {
            document.getElementById("aaaaa").style.display = "none";
            if (myEle1) {
                myEle1.removeAttribute("href");
            }
            if (myEle2) {
                myEle2.removeAttribute("href");
            }
            if (myEle3) {
                myEle3.removeAttribute("href");
            }
            if (myEle4) {
                myEle4.removeAttribute("href");
            }
        }
        option = option + ',' + document.getElementById("option3value").value + '@' + document.getElementById("pointer").value;
        localStorage.setItem("option", JSON.stringify(option));
        document.getElementById("bgColor3{{ $questions->currentPage() }}").style.backgroundColor = "#ffc107";

    }
</script>

<script type="text/javascript">
    function option4() {
        var link = ' {{$questions->nextPageUrl()}} ';
        var counter = '{{ $counter }}';
        var end = document.getElementById("endquiz");
        var myEle4 = document.getElementById("aaaa");
        var myEle3 = document.getElementById("aaa");
        var myEle2 = document.getElementById("aa");
        var myEle1 = document.getElementById("a");
        if (link.length < counter) {
            document.getElementById("aaaaa").style.display = "none";
            if (myEle1) {
                myEle1.removeAttribute("href");
            }
            if (myEle2) {
                myEle2.removeAttribute("href");
            }
            if (myEle3) {
                myEle3.removeAttribute("href");
            }
            if (myEle4) {
                myEle4.removeAttribute("href");
            }
        }
        option = option + ',' + document.getElementById("option4value").value + '@' + document.getElementById("pointer").value;
        localStorage.setItem("option", JSON.stringify(option));
        document.getElementById("bgColor4{{ $questions->currentPage() }}").style.backgroundColor = "#ffc107";

    }
</script>
<script>
    $(document).ready(function() {
        $(".pagination").rPage();
    });
</script>
