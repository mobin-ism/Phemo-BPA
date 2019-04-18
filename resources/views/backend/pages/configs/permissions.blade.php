@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.system_preferences')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                @include('backend.partials.settings')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.user_permissions')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row mb-5">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group m-form__group">
                                    <label for="user-id">
                                        {{__('web.employee')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="user_id"
                                        id="user-id" data-live-search="true" title="{{__('web.select_one')}}">
                                        @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                                        <option value="{{$employee->user_id}}">
                                            {{$employee->user->name}} - {{$employee->position}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                                <button type="button" class="btn btn-brand m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air"
                                    id="configure-button">
                                    <span>
                                        <i class="la la-cog"></i>
                                        <span>{{__('web.configure')}}</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="row" id="permission-list">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var permissionListRoute = '{{route('configs.permission_list')}}';
        $(document).ready(function() {
            $('#configure-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'user_id': $('#user-id').val()
                };
                $.post(permissionListRoute, filterParams, function(response) {
                    $('#permission-list').html(response);
                    $('#configure-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#configure-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
        });
    </script>
@endsection