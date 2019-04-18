@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.expense_types')}}</h3>
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
                                        {{__('web.all_expense_types')}}
                                    </h3>
                                </div>
                            </div>
                            @if (Auth::user()->role == "admin")
                            <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                            onclick="presentModal('{{route('expense_types.create')}}', '{{__('web.new_expense_type')}}')">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>{{__('web.new_expense_type')}}</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="m-portlet__body">
            
                            <!--begin: Datatable -->
                            <table class="table table-striped- table-bordered table-hover" id="m_table_1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('web.name')}}</th>
                                    @if (Auth::user()->role == "admin")
                                    <th>{{__('web.actions')}}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expense_types as $key => $expense_type)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$expense_type->name}}</td>
                                        @if (Auth::user()->role == "admin")
                                        <td nowrap>
                                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" 
                                                m-dropdown-toggle="hover" aria-expanded="true">
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
                                                                            {{ __('web.quick_actions') }}
                                                                        </span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="#" class="m-nav__link"
                                                                            onclick="presentModal('{{route('expense_types.edit', $expense_type->id)}}', '{{__('web.edit_expense_type')}}')">
                                                                            <i class="m-nav__link-icon flaticon-edit"></i>
                                                                            <span class="m-nav__link-text">
                                                                                {{ __('web.edit') }}
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="#" class="m-nav__link"
                                                                            onclick="confirmModal('{{route('expense_types.delete', $expense_type->id)}}')">
                                                                            <i class="m-nav__link-icon flaticon-cancel"></i>
                                                                            <span class="m-nav__link-text">
                                                                                {{ __('web.delete') }}
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
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection