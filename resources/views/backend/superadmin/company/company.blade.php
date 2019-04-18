@extends('backend.layouts.master')
@section('content')
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.companies')}}</h3>
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
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{__('web.registered_companies')}}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            onclick="">
                            <span>
                                <i class="la la-plus"></i>
                                <span>{{__('web.new_company')}}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover" id="m_table_1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('web.company_name')}}</th>
                    <th>{{__('web.admin_name')}}</th>
                    <th>{{__('web.created_at')}}</th>
                    <th>{{__('web.status')}}</th>
                    <th>{{__('web.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $key => $account)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <a href="{{route('scompanies.show', $account->id)}}" 
                                class="m-link">
                                {{\App\Config::where('account_id', $account->id)->first()->company_name}}
                            </a>
                        </td>
                        <td>{{$account->name}}</td>
                        <td>{{$account->created_at}}</td>
                        @php
                            if ($account->status == 'trial') $font = 'info';
                            elseif ($account->status == 'active') $font = 'success';
                            else $font = 'danger';
                        @endphp
                        <td class="m--font-{{$font}}"><strong>{{__('web.'.$account->status)}}</strong></td>
                        <td nowrap>
                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="m-dropdown__wrapper" style="z-index: 101;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust" style="right: auto; left: 29.5px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">
                                                            {{__('web.quick_actions')}}
                                                        </span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('scompanies.show', $account->id)}}" class="m-nav__link">
                                                            <span class="m-nav__link-text">
                                                                    {{__('web.details')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link"
                                                            onclick="presentModal('{{route('scompanies.summary', $account->id)}}', '{{__('web.summary')}}')">
                                                            <span class="m-nav__link-text">
                                                                    {{__('web.summary')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link"
                                                            onclick="presentModal('{{route('scompanies.activity', $account->id)}}', '{{__('web.account_activity')}}')">
                                                            <span class="m-nav__link-text">
                                                                    {{__('web.account_activity')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('scompanies.payments', $account->id)}}" class="m-nav__link">
                                                            <span class="m-nav__link-text">
                                                                    {{__('web.payment_history')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link"
                                                            onclick="">
                                                            <span class="m-nav__link-text">
                                                                    {{__('web.terminate')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection