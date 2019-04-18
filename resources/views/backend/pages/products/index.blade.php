@if (is_permitted('product_view'))
@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.products')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                    <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                        <i class="la la-plus m--hide"></i>
                        <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        <li class="m-nav__section m-nav__section--first">
                                            <span class="m-nav__section-text">
                                                {{__('web.export_options')}}
                                            </span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{route('products.pdf')}}" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="m-nav__link-text">{{__('web.pdf')}}</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{route('products.excel')}}" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-file-excel-o"></i>
                                                <span class="m-nav__link-text">{{__('web.excel')}}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('web.all_products')}}
                        </h3>
                    </div>
                </div>
                @if (is_permitted('product_create'))
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('products.import_excel')}}"
                                class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-arrow-down"></i>
                                    <span>{{__('web.import')}}</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item">
                            <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                onclick="presentModal('{{route('products.create')}}', '{{__('web.new_product')}}')">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>{{__('web.new_product')}}</span>
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
                        <th>{{__('web.code')}}</th>
                        <th>{{__('web.name')}}</th>
                        <th>{{__('web.unit_of_measure')}}</th>
                        <th>{{__('web.sales_price')}}</th>
                        <th>{{__('web.quantity')}}</th>
                        <th>{{__('web.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                <a href="#" onclick="presentModal('{{route('products.show', $product->id)}}', '{{__('web.product_details')}}')"
                                    class="m-link">
                                    {{$product->code}}
                                </a>
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->unit_of_measure_id > 0 ? $product->unit_of_measure->name : ''}}</td>
                            <td>{{get_config('currency')}} {{number_format($product->sales_price, 2, '.', ',')}}</td>
                            <td>{{$product->quantity}}</td>
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
                                                        @if (is_permitted('product_view'))
                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link"
                                                                onclick="presentModal('{{route('products.show', $product->id)}}', '{{__('web.product_details')}}')">
                                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                                <span class="m-nav__link-text">
                                                                        {{__('web.details')}}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if (is_permitted('product_edit'))
                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link"
                                                                onclick="presentModal('{{route('products.edit', $product->id)}}', '{{__('web.edit_product')}}')">
                                                                <i class="m-nav__link-icon flaticon-edit"></i>
                                                                <span class="m-nav__link-text">
                                                                        {{__('web.edit')}}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if (is_permitted('product_delete'))
                                                        <li class="m-nav__item">
                                                            <a href="#" class="m-nav__link"
                                                                onclick="confirmModal('{{route('products.delete', $product->id)}}')">
                                                                <i class="m-nav__link-icon flaticon-cancel"></i>
                                                                <span class="m-nav__link-text">
                                                                        {{__('web.delete')}}
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
