@if (is_permitted('customer_view'))
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
                        <a href="{{route('customers.company_list')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.company')}}</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('customers.individual_list')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.individual')}}</span>
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
                            {{__('web.companies')}}
                        </h3>
                    </div>
                </div>
                @if (is_permitted('customer_create'))
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('customers.import_excel', 'company')}}" 
                                class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-arrow-down"></i>
                                    <span>{{__('web.import')}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item">
                            <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                onclick="presentModal('{{route('customers.create')}}', '{{__('web.new_customer')}}')">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{__('web.new_customer')}}</span>
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
                        <th>{{__('web.category')}}</th>
                        <th>{{__('web.customer_no')}}</th>
                        <th>{{__('web.company_name')}}</th>
                        <th>{{__('web.primary_contact')}}</th>
                        <th>{{__('web.email')}}</th>
                        <th>{{__('web.telephone')}}</th>
                        <th>{{__('web.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as  $key => $customer)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                @if($customer->customer_category_id != null)
                                {{\App\CustomerCategory::where('id', $customer->customer_category_id)->first()->name}}
                                @endif
                            </td>
                            <td>{{$customer->customer_no}}</td>
                            <td>
                                <a href="{{route('customers.show', $customer->id)}}" class="m-link">
                                    <span>{{$customer->company_name}}</span>
                                </a>
                            </td>
                            <td>{{ $customer->primary_contact }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->telephone }}</td>
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
                                                        @if (is_permitted('customer_view'))
                                                        <li class="m-nav__item">
                                                            <a href="{{route('customers.show', $customer->id)}}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-user"></i>
                                                                <span class="m-nav__link-text">
                                                                    {{ __('web.profile') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if (is_permitted('customer_edit'))
                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link"
                                                                onclick="presentModal('{{route('customers.edit', $customer->id)}}', '{{__('web.edit_customer')}}')">
                                                                <i class="m-nav__link-icon flaticon-edit"></i>
                                                                <span class="m-nav__link-text">
                                                                    {{ __('web.edit') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        {{-- @if (is_permitted('customer_delete'))
                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link"
                                                                onclick="confirmModal('{{route('customers.delete', $customer->id)}}')">
                                                                <i class="m-nav__link-icon flaticon-cancel"></i>
                                                                <span class="m-nav__link-text">
                                                                    {{ __('web.delete') }}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif --}}
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