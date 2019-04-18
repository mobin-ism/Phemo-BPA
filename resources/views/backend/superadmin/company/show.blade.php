@extends('backend.layouts.master')
@section('content')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                {{$config->company_name}}
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('scompanies.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.companies')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="m-content">
    <div class="row mb-5">
        <div class="col-lg-2 col-md-3 col-sm-6">
            <a href="#" class="btn btn-primary m-btn m-btn--pill m-btn--air btn-block"
                onclick="presentModal('{{route('scompanies.activity', $config->account_id)}}', '{{__('web.account_activity')}}')">
                <span>
                    <span>{{__('web.account_activity')}}</span>
                </span>
            </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6">
            <a href="{{route('scompanies.payments', $config->account_id)}}" class="btn btn-success m-btn m-btn--pill m-btn--air btn-block">
                <span>
                    <span>{{__('web.payment_history')}}</span>
                </span>
            </a>
        </div>
    </div>
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">
    
                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                <a href="#"class="m-link"
                                    onclick="getSelectedUsers('customer', '{{$config->account_id}}')">
                                    {{__('web.customers')}}
                                </a>
                            </h4>
                            <h3 class="m--font-warning" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ count($customers) }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>
    
                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
    
                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                <a href="#" class="m-link"
                                onclick="getSelectedUsers('employee', '{{$config->account_id}}')">
                                    {{__('web.employees')}}
                                </a>
                            </h4>
                            <h3 class="m--font-danger" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ count($employees) }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>
    
                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
    
                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                <a href="#" class="m-link"
                                onclick="getSelectedUsers('vendor', '{{$config->account_id}}')">
                                    {{__('web.vendors')}}
                                </a>
                            </h4>
                            <h3 class="m--font-success" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ count($vendors) }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>
    
                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
    
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                <a href="#" class="m-link"
                                onclick="getSelectedUsers('user', '{{$config->account_id}}')">
                                    {{__('web.total_users')}}
                                </a>
                            </h4>
                            <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{ count($users) }}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>
    
                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div id="list">
            @include('backend.superadmin.company.users')
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var route = '{{route('scompanies.users')}}';
        function getSelectedUsers(type, account_id) {
            $('#list').addClass('opaque');
            var params = {
                '_token': '{{ csrf_token() }}',
                'account_id': account_id,
                'type': type
            };
            $.post(route, params, function(response) {
                $('#list').html(response);
                $('#list').removeClass('opaque');
            }).fail(function(response) {
                console.log(response);
                $('#list').removeClass('opaque');
            });
        }
    </script>
@endsection