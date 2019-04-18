@if(is_permitted('damaged_product_view'))
@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.damaged_products')}}</h3>
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
        @if(is_permitted('damaged_product_create'))
        <div class="row mb-3">
            <div class="col">
                <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right"
                    onclick="presentModal('{{route('damaged_products.create')}}', '{{__('web.add_damaged_product')}}')">
                    <span>
                        <i class="la la-plus"></i>
                        <span>{{__('web.add_damaged_product')}}</span>
                    </span>
                </a>
            </div>
        </div>
        @endif
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head" style="border: none;">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text" onclick="toggleSection('damaged-product-filter')" style="cursor: pointer;">
                            <span class="damaged-product-filter"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.filter_options')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body damaged-product-filter m--hide">
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.product')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="product_id" id="product_id"
                                data-live-search="true">
                                <option value="">{{__('web.all')}}</option>
                                @foreach (\App\Product::where('account_id', Auth::user()->account_id)->get() as $product)
                                <option value="{{$product->id}}">
                                    {{$product->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.date')}}
                            </label>
                            <div class="input-group pull-right" id="date_range">
                                <input type="text" class="form-control m-input m-input--pill" name="date" id="date"
                                readonly placeholder="{{__('web.select_date_range')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 mt-4">
                        <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            id="damaged-product-filter-button">
                            <span>
                                <i class="la la-filter"></i>
                                <span>{{__('web.apply_filter')}}</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile" id="damaged-product-list">
            @include('backend.pages.damaged_products.list')
        </div>
    </div>

@endsection

@section('script')
    <script>
        var damagedProductFilterRoute = '{{route('damaged_products.filter')}}';
        $(document).ready(function() {
            var a = moment().subtract(29, "days"),
                t = moment();
            $("#date_range").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#date').val('');
            });
            $('#damaged-product-filter-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'date': $('#date').val(),
                    'product_id': $('#product_id').val()
                };
                $.post(damagedProductFilterRoute, filterParams, function(response) {
                    $('#damaged-product-list').html(response);
                    $('#damaged-product-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#damaged-product-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
        });
        function toggleSection(section) {
            if ($('div.' + section).hasClass('m--hide')) {
                $('div.' + section).removeClass('m--hide');
                $('span.'+ section).html('<i class="la la-minus"></i>');
            } else {
                $('div.' + section).addClass('m--hide');
                $('span.'+ section).html('<i class="la la-plus"></i>');
            }            
        }
    </script>
@endsection

@endif