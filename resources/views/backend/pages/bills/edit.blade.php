@if (is_permitted('bill_edit'))
@extends('backend.layouts.master')
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.edit_bill')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                @if (is_permitted('bill_view'))
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('bills.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.all_bills')}}</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('bills.show', $bill->id)}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.bill_details')}}</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- END: Subheader -->
@php
    $entered_items = \App\Bill::find($bill->id)->bill_items;
@endphp
<form action="{{route('bills.update', $bill)}}" method="post" enctype="multipart/form-data" id="bill-edit-form">
    @csrf
    {{method_field('PATCH')}}
    {{ Form::hidden('account_id', Auth::user()->account_id) }}
    <input type="hidden" name="grand_total" id="grand-total" value="{{$bill->grand_total}}"> 
    <div class="m-content">
        <div class="row mb-4">
            <div class="col">
                <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill pull-right">
                    <span>
                        <i class="la la-save"></i>
                        <span>{{__('web.save')}}</span>
                    </span>
                </button>
            </div>
        </div>
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
                                <div class="form-group m-form__group" id="vendor_id-group">
                                    <label for="vendor">
                                        * {{__('web.vendor')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                        name="vendor_id" id="vendor" title="{{__('web.select_one')}}" data-live-search="true">
                                        @foreach(\App\Vendor::where('account_id', Auth::user()->account_id)->get() as $vendor)
                                            <option value="{{$vendor->id}}" <?php if ($vendor->id == $bill->vendor_id) echo 'selected'; ?>>
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
                                            name="bill_no" value="{{$bill->bill_no}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="bill-date">
                                        {{__('web.bill_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="bill_date" 
                                        id="bill-date" value="{{get_formatted_date_from_timestamp($bill->bill_date)}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="status">
                                        {{__('web.status')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                        name="status" id="status">
                                        <option value="0" <?php if ($bill->status == 0) echo 'selected'; ?>>{{__('web.unpaid')}}</option>
                                        <option value="1" <?php if ($bill->status == 1) echo 'selected'; ?>>{{__('web.partially_paid')}}</option>
                                        <option value="2" <?php if ($bill->status == 2) echo 'selected'; ?>>{{__('web.paid')}}</option>
                                    </select>
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
                                        name="po_no" value="{{$bill->po_no}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="po-date">
                                        {{__('web.po_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="po_date" 
                                        id="po-date" value="{{get_formatted_date_from_timestamp($bill->po_date)}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="due-date">
                                        {{__('web.due_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="due_date" 
                                        id="due-date" value="{{get_formatted_date_from_timestamp($bill->due_date)}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="discount-percentage">
                                        {{__('web.discount')}} %
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill" id="discount-percentage"
                                        name="discount_percentage" value="{{$bill->discount_percentage}}" onkeyup="calculateGrandTotal()">
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
                                <div class="col-lg-3 col-md-3"><span class="m--font-boldest">{{__('web.item')}}</span></div>
                                <div class="col-lg-2 col-md-2"><span class="m--font-boldest">{{__('web.category')}}</span></div>
                                <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.uom')}}</span></div>
                                <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.qty')}}</span></div>
                                <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.price')}}</span></div>
                                <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.discount')}} %</span></div>
                                <div class="col-lg-1 col-md-1"><span class="m--font-boldest">{{__('web.tax')}} %</span></div>
                                <div class="col-lg-2 col-md-2"><span class="m--font-boldest">{{__('web.total')}}</span></div>
                        </div>
                        <div class="m-divider mb-4"><span></span></div>
                        <div id="item-entry">
                            @foreach ($entered_items as $key => $entered_item)
                            <div class="entry-row">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-3">
                                        @if ($entered_item->item_type == 'product')
                                            <span>{{\App\Product::where('id', $entered_item->item_id)->first()->name}}</span>
                                        @endif
                                        @if ($entered_item->item_type == 'service')
                                            <span>{{\App\Service::where('id', $entered_item->item_id)->first()->name}}</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <span>{{\App\ExpenseType::where('id', $entered_item->expense_type_id)->first()->name}}</span>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->uom}}</span>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->qty}}</span>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->price}}</span>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->discount}}</span>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->tax == null ? 0 : $entered_item->tax}}</span>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <span>{{$entered_item->total}}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
                                    @if ($bill->attachment != null)
                                    <div class="mt-3">
                                        @php
                                            $attachment = explode('/', $bill->attachment);
                                            $attachment = end($attachment);
                                        @endphp
                                        <a href="{{route('bills.download', $bill->bill_no)}}" style="text-decoration: none;">
                                            <i class="flaticon-download"></i>
                                        </a>
                                        &nbsp; &nbsp; {{$attachment}}
                                    </div>
                                    @endif
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
                                    {{get_config('currency')}} <span id="totalSub">{{number_format($bill->grand_total - $bill->shipping_charge, 2, '.', ',')}}</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.shipping_charge')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="shipping">{{number_format($bill->shipping_charge, 2, '.', ',')}}</span>
                                </span>
                            </div>
                            @foreach (get_tax_amounts_for_bill($bill->id) as $tax_name)
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{\App\Tax::where('id', $tax_name->tax_id)->first()->name}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span>{{number_format($tax_name->amount, 2, '.', ',')}}</span>
                                </span>
                            </div>
                            @endforeach
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.discount')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    @php
                                        $discount_percentage = $bill->discount_percentage;
                                        $discount_amount = $bill->grand_total * ($discount_percentage / 100)
                                    @endphp
                                    {{get_config('currency')}} <span id="discount-amount-calculated">{{number_format($discount_amount, 2, '.', ',')}}</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.total')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="grandTotal">{{number_format($bill->grand_total, 2, '.', ',')}}</span>
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
    $(document).ready(function() {
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });

    function calculateGrandTotal() {
        var discountPercenage = parseFloat($('#discount-percentage').val());
        discountPercenage = parseFloat(discountPercenage / 100);
        var grandTotal = parseFloat($('#grand-total').val());
        var discountAmount = parseFloat(discountPercenage * grandTotal);
        $('#discount-amount-calculated').html(discountAmount.toFixed(2));
        grandTotal = parseFloat(grandTotal - discountAmount);
        $('#grand-total').val(grandTotal.toFixed(2));
        $('#grandTotal').html(grandTotal.toFixed(2));
    }

</script>
@endsection
@endif