@extends('layouts.profile')
@section('title' , __("Edit User Quiz"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Edit User Quiz") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter User Quiz details") }} </span>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content Head -->
@endsection
@section('content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__body">
                    {{--  <form id="myCreateForm" name="myCreateForm" novalidate enctype="multipart/form-data">  --}}
                        <form id="myEditForm" name="myEditForm"  enctype="multipart/form-data">

                            @if(session('success'))
                                <script>
                                    var session_msg = '{{session('success')}}';
                                    localStorage.setItem("toastr_status", session_msg );
                                </script>
                            @endif

                            @if(session('error'))
                                <script>
                                    var session_error_msg = '{{session('error')}}';
                                    localStorage.setItem("toastr_error_status", session_error_msg );
                                </script>
                            @endif

                        <div class="row">
                            <div class="col-xl-1"></div>
                            <div class="{{-- col-xl-8 --}}">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <h3 class="kt-section__title kt-section__title-lg">{{ __("Edit User Quiz") }}: <b> {{ $quiz->quiz_name }} </b></h3>
                                        <div class="row">
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ __("Quiz Name") }}</label>
                                                    <div class="col-xl-12">
                                                        <label class="col-form-label"></label>
                                                        <label class="col-form-label"></label>
                                                        <input class="form-control @error('quiz_name') is-invalid @enderror" type="text" name="quiz_name" value="{{old('quiz_name',$quiz->quiz_name)}}" required>
                                                        <span class="form-text text-primary">{{ __("required") }}</span>
                                                        @error('quiz_name')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ __("Quiz Grade") }}</label>
                                                    <div class="col-xl-12">
                                                        <label class="col-form-label"></label>
                                                        <label class="col-form-label"></label>
                                                        <input class="form-control @error('quiz_grade') is-invalid @enderror" type="text" step="1" min="1" name="quiz_grade" value="{{old('quiz_grade',$quiz->grade)}}" placeholder="{{ __("Leave blank to equal  100") }}" style="background-color: rgb(226, 224, 224);" readonly>
                                                        @error('quiz_grade')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 d-flex justify-content-center">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ __("Quiz Image") }}</label>
                                                    <div class="col-xl-6">
                                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_apps_user_add_avatar">
                                                            <div class="kt-avatar__holder" id="imagediv-quiz-img" style="height:100px;background-size: cover;background-image: url({{ asset($quiz->quiz_img) }});"></div>
                                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Change Image") }}">
                                                                <i class="fa fa-pen"></i>
                                                                <input type="file" name="quiz_img" id="quiz_img" accept=".png, .jpg, .jpeg">
                                                            </label>
                                                            <span class="kt-avatar__cancel" id="removeImage-quiz-img" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Delete Image") }}">
                                                                <i class="fa fa-times"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $i=1; @endphp
                                        @foreach ($questions as $question)
                                        <hr>
                                        <h3 class="kt-section__title kt-section__title-lg">{{ __("Question #") }} {{ $i }}  :  @if ($question->type == 'm')  - {{ __('multiple choices question') }} -  @else  - {{ __('survey question') }} - @endif @if( $counter >1 ) <a href="javascript:;" data-toggle="modal" onclick="deleteDataQuestion({{$question->id}})" data-target="#DeleteQuestionModal" style="color:red;"><i class="fa fa-trash" title="{{ __("Delete Question") }}"></i> {{ __("Delete Question") }} </a> @endif </h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ __("Question Name") }} </label>
                                                    <div class="col-xl-12">
                                                        <label class="col-form-label"></label>
                                                        <label class="col-form-label"></label>
                                                        <input class="form-control" type="text" name="question_text_{{ $i }}" value="{{old('question_text_'.'$i',$question->question_text)}}" placeholder="" required>
                                                        <span class="form-text text-primary">{{ __("required") }}</span>
                                                        @error('question_text_1')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xl-6 d-flex justify-content-center">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ __("Question Image") }}</label>
                                                    <div class="col-xl-6">
                                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_apps_user_add_avatar">
                                                            <div class="kt-avatar__holder" id="imagediv-question-img-{{ $i }}" @if(!is_null($question->question_img)) style="height:100px;background-size: cover;background-image: url({{ asset($question->question_img) }});" @else style="height:100px;background-size: cover;background-image: url({{ asset('assets/media/users/default-png.png') }});" @endif></div>
                                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Change Image") }}">
                                                                <i class="fa fa-pen"></i>
                                                                <input type="file" name="question_img_{{ $i }}"  id="question_img_{{ $i }}" accept=".png, .jpg, .jpeg">
                                                            </label>
                                                            <span class="kt-avatar__cancel" id="removeImage-question-img-{{ $i }}" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Delete Image") }}">
                                                                <i class="fa fa-times"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @if(!is_null($question->question_img))
                                                    <a href="javascript:;" data-toggle="modal" onclick="deleteDataQuestionImg({{$question->id}})" data-target="#DeleteQuestionImgModal" style="color:red;"><i class="fa fa-times" title="{{ __("Delete Image") }}"></i> {{ __("Delete the question image permanently") }} </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="kt-section__title kt-section__title-lg">{{ __("Question options #") }} {{ $i }} : </h3>
                                        <hr>
                                        @php $x=1; @endphp
                                        @php $counter_options = $question->options()->count(); @endphp
                                        @foreach ($question->options as $option)
                                        <div class="row">
                                            <div @if (is_null($option->option_img)) class="col-xl-6" @else class="col-xl-3" @endif>
                                                <div class="form-group">
                                                    <input type="hidden" name="option{{ $x }}_{{ $i }}" value="{{ $option->id }}">
                                                    <label class="col-form-label">{{ __("Option #") }} {{ $x }} </label>
                                                    @if( $counter_options >2 && $x != 1) <a href="javascript:;" data-toggle="modal" onclick="deleteDataOption({{$option->id}})" data-target="#DeleteOptionModal" style="color:red;">{{ __("Delete Option") }}</a> @endif</label>
                                                    <div class="col-xl-12">
                                                        <label class="col-form-label"></label>
                                                        <label class="col-form-label"></label>
                                                        <input class="form-control" type="text" name="option{{ $x }}_text_{{ $i }}" value="{{old('option'.'$x'.'_text_'.'$i',$option->option_text)}}" placeholder="">
                                                        @if($x ==1 || $x ==2)
                                                        <span class="form-text text-primary">{{ __("required") }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($question->type == 'm')
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ __("Option Grade") }}</label>
                                                    <div class="col-xl-12">
                                                        <label class="col-form-label"></label>
                                                        <label class="col-form-label"></label>
                                                        <input class="form-control" type="text" step="1" min="0" name="option{{ $x }}_weight_{{ $i }}" value="{{old('option'.'$x'.'_weight_'.'$i', $option->weight)}}" placeholder="{{ __("blank =  0") }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if (!is_null($option->option_img))
                                            <div class="col-xl-6 d-flex justify-content-center">
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ __("Option Image #") }} {{ $x }}</label>
                                                    <div class="col-xl-6">
                                                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_apps_user_add_avatar">
                                                            <div class="kt-avatar__holder" id="imagediv-option{{ $x }}-img-{{ $i }}" @if(!is_null($option->option_img)) style="height:100px;background-size: cover;background-image: url({{ asset($option->option_img) }});" @else style="height:100px;background-size: cover;background-image: url({{ asset('assets/media/users/default-png.png') }});" @endif></div>
                                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Change Image") }}">
                                                                <i class="fa fa-pen"></i>
                                                                <input type="file" name="option{{ $x }}_img_{{ $i }}" id="option{{ $x }}_img_{{ $i }}" accept=".png, .jpg, .jpeg">
                                                            </label>
                                                            <span class="kt-avatar__cancel" id="removeImage-option{{ $x }}-img-{{ $i }}" data-toggle="kt-tooltip" title="" data-original-title="{{ __("Delete Image") }}">
                                                                <i class="fa fa-times"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @if(!is_null($option->option_img))
                                                    <a href="javascript:;" data-toggle="modal" onclick="deleteDataOptionImg({{$option->id}})" data-target="#DeleteOptionImgModal" style="color:red;"><i class="fa fa-times" title="{{ __("Delete Image") }}"></i> {{ __("Delete the option image permanently") }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @php $x++; @endphp
                                        @endforeach
                                        @php $i++; @endphp
                                        @endforeach

                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-lg-15">
                                                        <button type="submit" id="btn-edit-submit" class="btn btn-success">{{ __("Submit") }}</button>
                                                        <a class="btn btn-light" href="{{route('dashboard')}}">{{ __("Cancel") }}</a>
                                                        <input type="hidden" id="quiz_id" name="quiz_id" value="{{ $quiz->id }}">
                                                        <input type="hidden" id="questions_counter_" value="{{ $counter }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</div>
<!-- end:: Content -->
@endsection
@section('modals')
    @include('pages.user.quiz.modals.delete_question')
    @include('pages.user.quiz.modals.delete_option')
    @include('pages.user.quiz.modals.delete_question_img')
    @include('pages.user.quiz.modals.delete_option_img')
@endsection
@section('js')
<script type="text/javascript">
    function deleteDataQuestion(id) {
        var id = id;
        var url = '{{ route("user_quiz.destroy_Question", ":id") }}';
        url = url.replace(':id', id);
        $("#Question").attr('action', url);
    }

    function QuestionSubmit() {
        $("#Question").submit();
    }

    function deleteDataOption(id) {
        var id = id;
        var url = '{{ route("user_quiz.destroy_Option", ":id") }}';
        url = url.replace(':id', id);
        $("#Option").attr('action', url);
    }

    function OptionSubmit() {
        $("#Option").submit();
    }

    function deleteDataQuestionImg(id) {
        var id = id;
        var url = '{{ route("user_quiz.delete_img_question", ":id") }}';
        url = url.replace(':id', id);
        $("#QuestionImg").attr('action', url);
    }

    function QuestionImgSubmit() {
        $("#QuestionImg").submit();
    }

    function deleteDataOptionImg(id) {
        var id = id;
        var url = '{{ route("user_quiz.delete_img_option", ":id") }}';
        url = url.replace(':id', id);
        $("#OptionImg").attr('action', url);
    }

    function OptionImgSubmit() {
        $("#OptionImg").submit();
    }
</script>
<script src="{{ asset('templete/pages/user/quiz/edit-scripts__updated.js') }}" type="text/javascript"></script>
@endsection
