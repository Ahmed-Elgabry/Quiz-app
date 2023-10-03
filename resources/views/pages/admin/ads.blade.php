@extends('layouts.profile')
@section('title' , __("Ads"))
@section('subheader')
<!-- begin:: Content Head -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __("Ads") }}
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{ __("Enter Ads details") }} </span>
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
                    <form id="myEditForm" name="myEditForm"  novalidate  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="kt-section__body">
                                                <a @if(App::isLocale('ar')) href="{{route('home', ['lang' => 'ar'])}}" @else href="{{route('home', ['lang' => 'en'])}}"@endif><h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in Home Page") }}:</h3></a>
                                                </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                                <div class="col-12 col-sm-8 ">
                                                <div class="col-lg-9 col-xl-9">
                                                        <textarea type="text" rows="4" name= "Home1"  value ="" class="form-control" > {{$Ads->Home1}}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                            <div class="col-12 col-sm-8 ">
                                            <div class="col-lg-9 col-xl-9">
                                                    <textarea type="text" rows="4" name= "Home2"  value ="" class="form-control" > {{$Ads->Home2}}</textarea>
                                                </div>
                                            </div>
                                         </div>


                                            <div class="kt-section__body">
                                                <a @if(App::isLocale('ar')) href="{{route('all_usersquizzes', ['lang' => 'ar'])}}" @else href="{{route('all_usersquizzes', ['lang' => 'en'])}}"@endif><h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in Quizzes Pages") }}:</h3></a>
                                            </div>

                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                                    <div class="col-12 col-sm-8 ">
                                                    <div class="col-lg-9 col-xl-9">
                                                            <textarea type="text" rows="4" name= "quizzes1"  value ="" class="form-control" > {{$Ads->quizzes1}}</textarea>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                                <div class="col-12 col-sm-8 ">
                                                <div class="col-lg-9 col-xl-9">
                                                        <textarea type="text" rows="4" name= "quizzes2"  value ="" class="form-control" > {{$Ads->quizzes2}}</textarea>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="kt-section__body">
                                            <a @if(App::isLocale('ar')) href="{{route('all_articles', ['lang' => 'ar'])}}" @else href="{{route('all_articles', ['lang' => 'en'])}}"@endif><h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in Articles Pages") }}:</h3></a>
                                            </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                            <div class="col-12 col-sm-8 ">
                                            <div class="col-lg-9 col-xl-9">
                                                    <textarea type="text" rows="4" name= "articles1"  value ="" class="form-control" > {{$Ads->articles1}}</textarea>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                        <div class="col-12 col-sm-8 ">
                                        <div class="col-lg-9 col-xl-9">
                                                <textarea type="text" rows="4" name= "articles2"  value ="" class="form-control" > {{$Ads->articles2}}</textarea>
                                            </div>
                                        </div>
                                </div>


                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in show Article Page") }}:</h3>
                                    </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                    <div class="col-12 col-sm-8 ">
                                    <div class="col-lg-9 col-xl-9">
                                            <textarea type="text" rows="4" name= "view_article1"  value ="" class="form-control" > {{$Ads->view_article1}}</textarea>
                                        </div>
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                <div class="col-12 col-sm-8 ">
                                <div class="col-lg-9 col-xl-9">
                                        <textarea type="text" rows="4" name= "view_article2"  value ="" class="form-control" > {{$Ads->view_article2}}</textarea>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 3</label>
                            <div class="col-12 col-sm-8 ">
                            <div class="col-lg-9 col-xl-9">
                                    <textarea type="text" rows="4" name= "view_article3"  value ="" class="form-control" > {{$Ads->view_article3}}</textarea>
                                </div>
                            </div>
                    </div>




                                        <div class="kt-section__body">
                                            <a @if(App::isLocale('ar')) href="{{route('about', ['lang' => 'ar'])}}" @else href="{{route('about', ['lang' => 'en'])}}"@endif><h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in About Page") }}:</h3></a>
                                                </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                                <div class="col-12 col-sm-8 ">
                                                <div class="col-lg-9 col-xl-9">
                                                        <textarea type="text" rows="4" name= "about1"  value ="" class="form-control" > {{$Ads->about1}}</textarea>
                                                    </div>
                                                </div>
                                        </div>

                                    <div class="kt-section__body">
                                        <a @if(App::isLocale('ar')) href="{{route('contact', ['lang' => 'ar'])}}" @else href="{{route('contact', ['lang' => 'en'])}}"@endif><h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in Contact Page") }}:</h3></a>
                                            </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                            <div class="col-12 col-sm-8 ">
                                            <div class="col-lg-9 col-xl-9">
                                                    <textarea type="text" rows="4" name= "contact1"  value ="" class="form-control" > {{$Ads->contact1}}</textarea>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in doing Quiz Page") }}:</h3>
                                            </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                            <div class="col-12 col-sm-8 ">
                                            <div class="col-lg-9 col-xl-9">
                                                    <textarea type="text" rows="4" name= "do_quiz1"  value ="" class="form-control" > {{$Ads->do_quiz1}}</textarea>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                        <div class="col-12 col-sm-8 ">
                                        <div class="col-lg-9 col-xl-9">
                                                <textarea type="text" rows="4" name= "do_quiz2"  value ="" class="form-control" > {{$Ads->do_quiz2}}</textarea>
                                            </div>
                                        </div>
                                </div>

                                <div class="kt-section__body">
                                        <h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in guest result Page") }}:</h3>
                                        </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1 </label>
                                        <div class="col-12 col-sm-8 ">
                                        <div class="col-lg-9 col-xl-9">
                                                <textarea type="text" rows="4" name= "guest_result1"  value ="" class="form-control" > {{$Ads->guest_result1}}</textarea>
                                            </div>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                    <div class="col-12 col-sm-8 ">
                                    <div class="col-lg-9 col-xl-9">
                                            <textarea type="text" rows="4" name= "guest_result2"  value ="" class="form-control" > {{$Ads->guest_result2}}</textarea>
                                        </div>
                                    </div>
                            </div>

                            <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in see & share all Results Page") }}:</h3>
                                    </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                    <div class="col-12 col-sm-8 ">
                                    <div class="col-lg-9 col-xl-9">
                                            <textarea type="text" rows="4" name= "results1"  value ="" class="form-control" > {{$Ads->results1}}</textarea>
                                        </div>
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                <div class="col-12 col-sm-8 ">
                                <div class="col-lg-9 col-xl-9">
                                        <textarea type="text" rows="4" name= "results2"  value ="" class="form-control" > {{$Ads->results2}}</textarea>
                                    </div>
                                </div>
                        </div>

                            <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in Quick Access Page") }}:</h3>
                                    </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                    <div class="col-12 col-sm-8 ">
                                    <div class="col-lg-9 col-xl-9">
                                            <textarea type="text" rows="4" name= "quick_access1"  value ="" class="form-control" > {{$Ads->quick_access1}}</textarea>
                                        </div>
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                                <div class="col-12 col-sm-8 ">
                                <div class="col-lg-9 col-xl-9">
                                        <textarea type="text" rows="4" name= "quick_access2"  value ="" class="form-control" > {{$Ads->quick_access2}}</textarea>
                                    </div>
                                </div>
                        </div>

                        <div class="kt-section__body">
                                <h3 class="kt-section__title kt-section__title-lg">{{ __("Ads in Share Quiz Page") }}:</h3>
                                </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 1</label>
                                <div class="col-12 col-sm-8 ">
                                <div class="col-lg-9 col-xl-9">
                                        <textarea type="text" rows="4" name= "share_quiz1"  value ="" class="form-control" > {{$Ads->share_quiz1}}</textarea>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">{{ __("Ads #") }} 2</label>
                            <div class="col-12 col-sm-8 ">
                            <div class="col-lg-9 col-xl-9">
                                    <textarea type="text" rows="4" name= "share_quiz2"  value ="" class="form-control" > {{$Ads->share_quiz2}}</textarea>
                                </div>
                            </div>
                    </div>
                                        </div>
                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-5">
                                                            <button type="submit" id="btn-edit-submit" class="btn btn-success">{{ __("Submit") }}</button>
                                                            <a class="btn btn-light" href= "{{route('dashboard')}}">{{ __("Cancel") }}</a>
                                                            {{--  <input type="hidden" id="cq_edit_id" name="cq_edit_id" value="{{ $Ads->id }}">  --}}
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
            <!--end::Portlet-->
        </div>
    </div>
</div>
<!-- end:: Content -->
@endsection
@section('js')
<script src="{{ asset('templete/pages/admin/settings/ads/scripts.js') }}" type="text/javascript"></script>
@endsection

