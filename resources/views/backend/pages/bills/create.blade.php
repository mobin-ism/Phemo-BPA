@if (is_permitted('bill_create'))
@extends('backend.layouts.master')
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.new_bill')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('bills.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.all_bills')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END: Subheader -->
<form action="{{route('bills.store')}}" method="post" enctype="multipart/form-data" id="bill-create-form">
    @csrf
    {{ Form::hidden('account_id', Auth::user()->account_id) }}
    <input type="hidden" name="grand_total" id="grand_total" value=""> 
    <div class="m-content">
        <div class="row">
            <div class="col">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.bill_information')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group @if($errors->has('vendor_id')) has-danger @endif" id="vendor_id-group">
                                    <label for="vendor">
                                        * {{__('web.vendor')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                        name="vendor_id" id="vendor" title="{{__('web.select_one')}}" data-live-search="true">
                                        @foreach(\App\Vendor::where('account_id', Auth::user()->account_id)->get() as $vendor)
                                            <option value="{{$vendor->id}}">
                                                {{$vendor->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="bill-no">
                                        {{__('web.bill_no')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill" id="bill-no"
                                            name="bill_no" value="{{serialized_code('bill')}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="bill-date">
                                        {{__('web.bill_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="bill_date" 
                                        id="bill-date" readonly value="{{get_formatted_date_from_timestamp(strtotime(date('d-m-Y')))}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="po-no">
                                        {{__('web.po_no')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill" id="po-no"
                                        name="po_no">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="po-date">
                                        {{__('web.po_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="po_date" 
                                        id="po-date" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="due-date">
                                        {{__('web.due_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="due_date" 
                                        id="due-date" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.items')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body bill-entry-titles">
                        <div class="row mb-4">
                            <div class="col-lg-2 col-md-2"><span class="m--font-boldest">{{__('web.item')}}</span></div>
                            <div class="col-lg-2 col-md-2"><span class="m--font-boldest">{{__('web.category')}}</span></div>
                            <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.uom')}}</span></div>
                            <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.qty')}}</span></div>
                            <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.price')}}</span></div>
                            <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.discount')}} %</span></div>
                            <div class="col-lg-2 col-md-2"><span class="m--font-boldest">{{__('web.tax')}}</span></div>
                            <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.total')}}</span></div>
                            <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.actions')}}</span></div>
                        </div>
                        <div class="m-divider mb-4"><span></span></div>
                        <div id="item-entry">
                            @include('backend.pages.bills.partials.entry')
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-accent m-btn m-btn--custom m-btn--icon m-btn--pill"
                                    id="add-button" onclick="addItemEntry()">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{__('web.add_more_item')}}</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.additional_information')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group m-form__group" id="shipping_charge-group">
                                    <label for="shipping-charge">
                                        {{__('web.shipping_charge')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill" id="shipping-charge"
                                        name="shipping_charge" value="0" onkeyup="calculateGrandTotal()">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group m-form__group">
                                    <label for="attachment">
                                        {{__('web.attachment')}}
                                    </label>
                                    <div></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="attachment" name="attachment"
                                            accept="application/pdf, image/*">
                                        <label class="custom-file-label" for="attachment">
                                            {{__('web.choose_file')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.summary')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget13">
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.sub_total')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="totalSub">0.0</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.shipping_charge')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="shipping">0.0</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.total')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="grandTotal">0.0</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill pull-right">
                    <span>
                        <i class="la la-save"></i>
                        <span>{{__('web.save')}}</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')
@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>

    var itemRow = 1;
    $(document).ready(function() {
        $('#add-button').prop('disabled', !0);
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });

    function itemChanged(item, count) {
        var url = '{{route('bills.item_info')}}';
        var data = {
            '_token': '{{ csrf_token() }}',
            'item': item,
            'itemRow': itemRow
        };
        $.post(url, data, function(response) {
            $('#item-entry > #'+ count).html(response);
            $('.m_selectpicker').selectpicker();
            $('#add-button').prop('disabled', 0);
            calculateItemPrice(itemRow);
            $('#item-entry > #'+ count).find('select').first().prop('disabled', !0);
            $('#item-entry > #'+ count).find('input[type=hidden]').first().val(item);
        }).fail(function(response) {
            console.log(response);
        });
    }

    function addItemEntry() {
        itemRow++;
        var url = '{{route('bills.item_blank')}}';
        var data = {
            '_token': '{{ csrf_token() }}',
            'itemRow': itemRow
        };
        $.post(url, data, function(response) {
            $('#item-entry').append(response);
            $('.m_selectpicker').selectpicker();
            $('#add-button').prop('disabled', !0);
        }).fail(function(response) {
            console.log(response);
        });
    }

    function calculateItemPrice(item) {
        var quantity = parseFloat($('#qty-'+item).val());
        var price = parseFloat($('#price-'+item).val());
        var discount = parseFloat($('#discount-'+item).val());
        var tax = $('#tax-'+item).val();
        tax = tax == '' ? 0.0 : tax;
        var itemPrice = parseFloat((price * quantity));
        var itemTax =  itemPrice * parseFloat((tax / 100.0));
        var itemDiscount = itemPrice * parseFloat((discount / 100.0));
        var subTotal = itemPrice + itemTax - itemDiscount;
        $('#total-'+item).val(subTotal.toFixed(2));
        handleTax(item, tax);
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var grandTotal = 0.0;
        var values = $("input[name='total[]']").map(function() {
            return $(this).val();
        }).get();
        for (var i = 0; i < values.length; i++) {
            grandTotal += parseFloat(values[i]);
        }
        $('#totalSub').html(grandTotal.toFixed(2));
        var shippingCharge = parseFloat($('#shipping-charge').val());
        grandTotal = shippingCharge + grandTotal;
        $('#shipping').html(shippingCharge.toFixed(2));
        $('#grandTotal').html(grandTotal.toFixed(2));
        $('#grand_total').val(grandTotal.toFixed(2));
    }

    function handleTax(item, tax) {
        var currency = '{{get_config('currency')}}';
        var tax_id = $('#tax-'+item).find('option:selected').data('tax-id');
        if (tax_id) {
            $('#tax-id-'+item).val(tax_id);
        }
    }

    function deleteEntry(item) {
        var entries = document.getElementsByName('total[]');
        if (entries.length > 1) {
            $('#'+item).fadeOut('fast', function() {
                $('#'+item).remove();
                calculateGrandTotal();
                return false;
            });
        }
    }

</script>
@endsection
@endif
