@extends('backend.layouts.master')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.customers')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('customers.index')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.company')}}</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('customers.index')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.individual')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- <div class="content">

        <div class="row">

            <div class="vender_box">
                <h2>Customers</h2>
                <div class="big_icon">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <a href="{{route('customers.company_list')}}"><img src="{{asset('backend/assets/images/list.png')}}" alt="list"> {{ __('web.list') }}</a>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-4">
                            <a href="#"><img src="{{asset('backend/assets/images/history.png')}}" alt="history"> {{ __('web.history') }}</a>
                        </div> -->
                        @if(Auth::user()->role == "admin")
                            <div class="col-xs-12 col-sm-4">
                                <a href="{{route('customers.create')}}"><img src="{{asset('backend/assets/images/create.png')}}" alt="create"> {{ __('web.create') }}</a>
                            </div>
                        @elseif(Auth::user()->role == "employee")

                            @php

                            $permissions = json_decode(Auth::user()->userPermission->permissions);

                            @endphp

                            @if(in_array(2.1, $permissions))
                                <div class="col-xs-12 col-sm-4">
                                    <a href="{{route('customers.create')}}"><img src="{{asset('backend/assets/images/create.png')}}" alt="create"> {{ __('web.create') }}</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div> --}}

<!-- 
            <div class="col-md-2">
                <a onclick="showAjaxModal('{{route('customers.create')}}')">
                    <div class="card shadow-card btn-info">
                        <div class="card-body custom-card-body">
                            <div class="text-center">
                                <i class="icon-plus3" style="font-size: 84px;"></i>
                                <h2 class="title">{{ __('web.create') }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{route('customers.company_list')}}">
                    <div class="card shadow-card btn-danger">
                        <div class="card-body custom-card-body">
                            <div class="text-center">
                                <i class="icon-list" style="font-size: 84px;"></i>
                                <h2 class="title">{{ __('web.list') }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{route('vendors.create')}}">
                    <div class="card shadow-card bg-teal-400">
                        <div class="card-body custom-card-body">
                            <div class="text-center">
                                <i class="icon-history" style="font-size: 84px;"></i>
                                <h2 class="title">{{ __('web.history') }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div> -->
        {{-- </div> --}}

    {{-- </div> --}}

@endsection