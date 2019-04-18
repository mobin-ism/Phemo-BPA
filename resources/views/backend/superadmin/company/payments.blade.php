@extends('backend.layouts.master')
@section('content')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                {{$config->company_name}} | {{__('web.payment_history')}}
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__item">
                    <a href="{{route('scompanies.show', $config->account_id)}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{$config->company_name}}</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('scompanies.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.all_companies')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection