@extends('layouts.profile')
@section('title' , __("Notifications"))
@section('subheader')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __('Notifications') }} </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Home') }} </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('notifications') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Notifications') }} </a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
@endsection
@section('content')
<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-bell"></i>
										</span>
										<h3 class="kt-portlet__head-title">
                                                {{ __("Notifications") }}
										</h3>
									</div>
								</div>
								{{-- <div class="kt-portlet__body">

									<!--begin: Search Form -->
									<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
										<div class="row align-items-center">
											<div class="col-xl-8 order-2 order-xl-1">
												<div class="row align-items-center">
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-input-icon kt-input-icon--left">
															<input type="text" class="form-control" placeholder="{{ __("Search") }} ..." id="generalSearch">
															<span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end: Search Form -->
                                </div> --}}
                                <div class="kt-portlet__body">
                                       {{--  @if(session('message_flash'))
                                        <div class="alert alert-success">
                                        {{session('message_flash')}}
                                        </div>
                                        @endif
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                        {{session('success')}}
                                        </div>
                                    @endif
                                    @if(session('error'))
                                    <div class="alert alert-error">
                                    {{session('error')}}
                                    </div>
                                @endif --}}
								<div class="kt-portlet__body kt-portlet__body--fit">
                                        <!--begin: Datatable -->
                                        <table class="table table-borderless">
                                            <tbody>
                                                @if (\App\Models\log::count() >0)
                                                @foreach ($log as $item )
                                                @if ($item->user && $item->article)
                                                <tr>
                                                    <td @if ($item->is_read == 1) style="background-color: lightgray;" @endif >
                                                        <a href="{{route('notifications.update_log' , ['id'=>$item->id ] )}}" >

                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">

                                                                @if ($item->event == 'A')
                                                                @if(App::isLocale('ar')) <b>{{ $item->user->username }} <i class="flaticon2-add-1 kt-font-success"></i>  {{ __("added a new article.") }} </b> @else <i class="flaticon2-add-1 kt-font-success"></i> <b>{{ $item->user->username }}  {{ __("added a new article.") }} </b> @endif

                                                                @elseif ($item->event == 'E')
                                                                @if(App::isLocale('ar')) <b> {{ $item->user->username }} <i class="flaticon2-edit kt-font-brand"></i> {{ __("updated an article.") }}</b> @else <i class="flaticon2-edit kt-font-brand"></i>  <b> {{ $item->user->username }}  {{ __("updated an article.") }}</b> @endif

                                                                @else
                                                                @if(App::isLocale('ar'))  <b> {{ $item->user->username }} <i class="flaticon2-delete kt-font-danger"></i> {{ __("deleted an article.") }}</b>@else <i class="flaticon2-delete kt-font-danger"></i> <b> {{ $item->user->username }}  {{ __("deleted an article.") }}</b> @endif
                                                                @endif

                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    {{  $item->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                  </tr>
                                                  @elseif($item->user && !$item->article)

                                                  @if ($item->event == 'D')
                                                  <tr>
                                                    <td @if ($item->is_read == 1) style="background-color: lightgray;" @endif >
                                                        <a href="{{route('notifications.update_log' , ['id'=>$item->id ] )}}" @if ($item->is_read == 1) style="background-color: lightgray;" @endif class="kt-notification__item">
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">

                                                                    @if(App::isLocale('ar'))  <b> {{ $item->user->username }} <i class="flaticon2-delete kt-font-danger"></i> {{ __("deleted an article.") }}</b>@else <i class="flaticon2-delete kt-font-danger"></i> <b> {{ $item->user->username }}  {{ __("deleted an article.") }}</b> @endif

                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    {{  $item->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                  </tr>

                                                  @endif
                                                  @endif
                                                @endforeach

                                                @else
                                                <tr>
                                                <td>
                                                <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                                    <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                                        <div class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                                            <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                                               <br>{{ __("No new notifications") }}.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                                @endif

                                            </tbody>
                                          </table>
                                          <div class="pagination">
                                            {{$log->links()}}
                                            </div>
                                        <!--end: Datatable -->
                                </div>


							</div>
                        </div>

						<!-- end:: Content -->
@endsection


@section('js')
<script src="{{ asset('assets/js/demo1/pages/crud/metronic-datatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection
