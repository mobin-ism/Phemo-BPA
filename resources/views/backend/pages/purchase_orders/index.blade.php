@extends('backend.layouts.master')
@section('content')
    
    <!-- <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> {{ __('web.customers') }}</h4>
    
            </div>
    
        </div>
    </div> -->

    <div class="content">

        <div class="row">

            <div class="vender_box">
                <h2>Purchase Order</h2>
                <div class="big_icon">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <a href="{{route('purchase_orders.list')}}"><img src="{{asset('backend/assets/images/list.png')}}" alt="list"> {{ __('web.list') }}</a>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-4">
                            <a href="#"><img src="{{asset('backend/assets/images/history.png')}}" alt="history"> {{ __('web.history') }}</a>
                        </div> -->
                        @if(Auth::user()->role == "admin")
                        <div class="col-xs-12 col-sm-4">
                            <a href="{{route('purchase_orders.create')}}"><img src="{{asset('backend/assets/images/create.png')}}" alt="create"> {{ __('web.create') }}</a>
                        </div>
                        @elseif(Auth::user()->role == "employee")

                            @php

                            $permissions = json_decode(Auth::user()->userPermission->permissions);

                            @endphp

                            @if(in_array(7.1, $permissions))
                                <div class="col-xs-12 col-sm-4">
                                    <a href="{{route('purchase_orders.create')}}"><img src="{{asset('backend/assets/images/create.png')}}" alt="create"> {{ __('web.create') }}</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

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
        </div>

    </div>

@endsection