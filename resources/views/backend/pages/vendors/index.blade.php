@if (is_permitted('vendor_view'))
@extends('backend.layouts.master')
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.vendors')}}</h3>
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
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('web.all_vendors')}}
                        </h3>
                    </div>
                </div>
                @if (is_permitted('vendor_create'))
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                onclick="presentModal('{{route('vendors.create')}}', '{{__('web.new_vendor')}}')">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{__('web.new_vendor')}}</span>
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
                        <th>{{__('web.contact_person')}}</th>
                        <th>{{__('web.company_phone')}}</th>
                        <th>{{__('web.contact_email')}}</th>
                        <th>{{__('web.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $key => $vendor)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                <a href="{{route('vendors.show', $vendor->id)}}" class="m-link">
                                    <span>{{$vendor->name}}</span>
                                </a>
                            </td>
                            <td>{{ $vendor->contact_person }}</td>
                            <td>{{ $vendor->company_phone }}</td>
                            <td>{{ $vendor->contact_email }}</td>
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
                                                        @if (is_permitted('vendor_view'))
                                                        <li class="m-nav__item">
                                                            <a href="{{route('vendors.show', $vendor->id)}}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-user"></i>
                                                                <span class="m-nav__link-text">
                                                                    {{ __('web.profile') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if (is_permitted('vendor_edit'))
                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link"
                                                                onclick="presentModal('{{route('vendors.edit', $vendor->id)}}', '{{__('web.edit_vendor')}}')">
                                                                <i class="m-nav__link-icon flaticon-edit"></i>
                                                                <span class="m-nav__link-text">
                                                                    {{ __('web.edit') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif
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
@endif