@extends('layouts.profile')
@section('title' , __("Editors"))
@section('subheader')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ __('Editors') }} </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Home') }} </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{ route('editors') }}" class="kt-subheader__breadcrumbs-link">
                    {{ __('Editors') }} </a>
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
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">
                                                {{ __("Editors Table") }}
										</h3>
									</div>
								</div>
								<div class="kt-portlet__body">

									<!--begin: Search Form -->
									<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
										<div class="row align-items-center">
											<div class="col-xl-8 order-2 order-xl-1">
											<form method="get" @if (App::isLocale('ar')) action="{{ route('editors')}}" @else action="{{ route('editors')}}" @endif  class="row align-items-center">
                                                   {{--  <form method="get" @if (App::isLocale('ar')) action="{{ route('users')}}" @else action="{{ route('users')}}" @endif  > --}}

													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-input-icon kt-input-icon--left">
                                                            <input type="text" name="name" placeholder="{{ __('Search') }}" value="{{$name}}" class="form-control" >
															{{-- <input type="text" class="form-control" placeholder="Search..." id="generalSearch"> --}}
															<span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
														</div>
													</div>
													<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
														<div class="kt-form__group kt-form__group--inline">
															<div class="kt-form__label">
																<label></label>
															</div>
															<div class="kt-form__control">
																<select name="status" class="form-control">
                                                                    <option value="">{{ __('Old') }}</option>
                                                                    <option value="newest" {{$status == 'newest'? 'selected' : '' }}>{{ __('New') }}</option>
                                                                </select>
															</div>
														</div>
                                                    </div>

                                                    <button type="submit" class="btn btn-warning ml-2">{{ __('Search') }}</button>
                                                </form>
											</div>
										</div>
									</div>

									<!--end: Search Form -->
                                </div>
                                <div class="kt-portlet__body">
                                        @if(session('message_flash'))
                                        <div class="alert alert-success">
                                        {{session('message_flash')}}
                                        </div>
                                    @endif
								<div class="kt-portlet__body kt-portlet__body--fit">
                                    <!--begin: Datatable -->
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                        {{session('success')}}
                                        </div>
                                    @endif
                                    <div class="pagination">
                                        @if($status != 'newest' )
                                                    @if ($name != null)
                                                    {{$users->appends(['name' => $name])->links()}}
                                                    @else
                                                    {{$users->links()}}
                                                    @endif

                                        @elseif ($status == 'newest')
                                                    @if ($name != null)
                                                    {{$users->appends(['name' => $name,'status' => 'newest'])->links()}}
                                                    @else
                                                    {{$users->appends(['status' => 'newest'])->links()}}
                                                    @endif

                                        @endif
                                                </div>
                                    <table class="kt-datatable" id="html_table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>{{ __("Name") }}</th>
                                                <th>{{ __("Username") }}</th>
                                                <th>{{ __("Email") }}</th>
                                                <th>{{ __("Actions") }}</th>
                                                <th> </th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($users as $item )
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <span class="dropdown">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                                      <i class="la la-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" title="{{ __("show user details") }}"  href="javascript:;" data-toggle="modal" data-target="#showDetails{{$item->id}}">{{ __("show user details") }}</a>
                                                        <a class="dropdown-item"  title="{{ __("Downgrade him to User") }}" href="javascript:;"  data-toggle="modal" data-target="#DowngradeModal{{$item->id}}">{{ __('Downgrade him to User') }}</a>
                                                        <a class="dropdown-item"  title="{{ __("His Articles") }}" href="{{route('editors.his_articles' , ['id'=>$item->id ] )}}" >{{ __('His Articles') }}</a>
                                                        <a class="dropdown-item"  title="{{ __("Block") }}" href="javascript:;" data-toggle="modal" data-target="#DeleteModal{{$item->id}}">{{ __("Block") }}</a>
                                                    </div>
                                                </span>
                                                </td>
                                                    <td></td>
                                                    <td></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{-- <div class="pagination">
                                        {{$users->links()}}
                                        </div> --}}

                                        <!-- Modal -->
                                        @foreach ($users as $item)
                                        <div class="modal fade" id="DowngradeModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="#DowngradeModal{{ $item->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ __("Downgrade Editor") }} </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('editors.downgrade' , ['id'=>$item->id ] )}}" method="post">
                                                 {{ csrf_field() }}
                                                 {{ method_field('PUT') }}
                                                    <div class="modal-body">
                                                        <b>{{ __("Are you sure you want to Downgrade") }} {{ $item->username }}@if(App::isLocale('ar')) ؟ @else ? @endif </b> <br>
                                                            {{ __("He will be not able to write and edit articles.") }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __("Close") }}</button>
                                                            <button type="submit" name="" class="btn btn-danger" >{{ __("Submit") }}</button>
                                                        </div>
                                            </form>


                                            </div>
                                        </div>
                                        </div>
                                        @endforeach

                                           <!-- Modal -->
                                           @foreach ($users as $item)
                                           <div class="modal fade" id="DeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="#DeleteModal{{ $item->id }}Label" aria-hidden="true">
                                           <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                               <div class="modal-header">
                                                   <h5 class="modal-title" id="exampleModalLabel">{{ __("Block") }} </h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                   </button>
                                               </div>
                                               <form action="{{route('users.delete' , ['id'=>$item->id ] )}}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                       <div class="modal-body">
                                                        {{ __("Are you sure you want to block the user") }} {{ $item->username }}@if(App::isLocale('ar')) ؟ @else ? @endif </b> <br>
                                                       <B> {{ __("This will block his articles also.") }} </B>
                                                    </div>
                                                           <div class="modal-footer">
                                                               <button type="button" class="btn btn-light" data-dismiss="modal">{{ __("Close") }}</button>
                                                               <button type="submit" name="" class="btn btn-danger">{{ __("Block") }}</button>
                                                           </div>
                                               </form>


                                               </div>
                                           </div>
                                           </div>
                                           @endforeach



                                         @foreach ($users as $item)
                                        <div class="modal fade" id="showDetails{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="#showDetails{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="#showDetails{{ $item->id }}Label"><b>{{ __('User Details') }} :</b> {{ $item->username}}</h5>
                                                </div>
                                                        <div class="modal-body">
                                                                    <div class="row clearfix">
                                                                        <div class="col-lg-12 col-md-12  col-sm-12">
                                                                            <table class="table table-borderless">
                                                                                <tbody>
                                                                                  <tr>
                                                                                    <td>{{ __("Name") }}</td>
                                                                                    <td>{{ $item->name }}</td>
                                                                                  </tr>

                                                                                  <tr>
                                                                                    <td>{{ __("Username") }}</td>
                                                                                    <td>{{ $item->username }}</td>
                                                                                  </tr>

                                                                                  <tr>
                                                                                    <td>{{ __("Email") }}</td>
                                                                                    <td>{{ $item->email }}</td>
                                                                                  </tr>

                                                                                  <tr>
                                                                                    <td>{{ __("created_at") }}</td>
                                                                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                                                                  </tr>

                                                                                </tbody>
                                                                              </table>
                                                                        </div>
                                                                    </div>

                                                        </div>
                                                            <div class="modal-footer">
                                                                {{--  <button type="submit" class="btn btn-primary">{{ __("Submit") }}</button>  --}}
                                                                <button type="button" class="btn btn-light  ml-2" data-dismiss="modal">{{ __("Close") }}</button>
                                                            </div>
                                                </div>
                                            </div>
                                            </div>
                                            @endforeach
                                        <!--end: Datatable -->
                                </div>


							</div>
                        </div>

						<!-- end:: Content -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $(".pagination").rPage();
    });
</script>
<script src="{{ asset('assets/js/demo1/pages/crud/metronic-datatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection
