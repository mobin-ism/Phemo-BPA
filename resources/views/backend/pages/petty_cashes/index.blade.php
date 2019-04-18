@extends('backend.layouts.master')
@section('content')
    
    <!-- <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> {{ __('web.products') }}</h4>
    
            </div>
    
        </div>
    </div> -->

    <div class="content">

        <div class="row">
            <div class="vender_box">
                <h2>Petty Cashes</h2>
                <div class="big_icon">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <a href="{{route('petty_cashes.list')}}"><img src="{{asset('backend/assets/images/list.png')}}" alt="list"> {{ __('web.list') }}</a>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-4">
                            <a href="#"><img src="{{asset('backend/assets/images/history.png')}}" alt="history"> {{ __('web.history') }}</a>
                        </div> -->
                        @if(Auth::user()->role == "admin")
                        <div class="col-xs-12 col-sm-4">
                            <a href="{{route('petty_cashes.create')}}"><img src="{{asset('backend/assets/images/create.png')}}" alt="create"> {{ __('web.create') }}</a>
                        </div>
                        @elseif(Auth::user()->role == "employee")

                            @php

                            $permissions = json_decode(Auth::user()->userPermission->permissions);

                            @endphp

                            @if(in_array(11.1, $permissions))
                                <div class="col-xs-12 col-sm-4">
                                    <a href="{{route('petty_cashes.create')}}"><img src="{{asset('backend/assets/images/create.png')}}" alt="create"> {{ __('web.create') }}</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection