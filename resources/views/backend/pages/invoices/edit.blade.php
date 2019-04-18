@if (is_permitted('invoice_edit'))
@extends('backend.layouts.master')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.edit_invoice')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('invoices.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.invoices')}}</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('invoices.show', $invoice)}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.invoice_details')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<form action="{{route('invoices.update', $invoice)}}" method="post" id="quote-update-form">
    @csrf
    {{method_field('PATCH')}}
    {{ Form::hidden('account_id', Auth::user()->account_id) }}
    <input type="hidden" name="grand_total" id="grand_total" value="{{$invoice->grand_total}}">
    <div class="m-content">
        <div class="row">
            <div class="col">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.invoice_information')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="customer_id-group">
                                    <label for="customer">
                                        * {{__('web.customer')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                        name="customer_id" id="customer" title="{{__('web.select_one')}}" data-live-search="true">
                                        @foreach(\App\Customer::where('account_id', Auth::user()->account_id)->get() as $customer)
                                            <option value="{{$customer->id}}" <?php if ($invoice->customer_id == $customer->id) echo 'selected';?>>
                                                {{$customer->customer_type == 'company' ? $customer->company_name : $customer->customer_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="invoice_no-group">
                                    <label for="invoice-no">
                                        * {{__('web.invoice_no')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill" id="invoice-no"
                                            name="invoice_no" value="{{$invoice->invoice_no}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="po-no">
                                        {{__('web.po_no')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill" id="po-no"
                                        name="po_no" value="{{$invoice->po_no}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="issue-date">
                                        {{__('web.issue_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="issue_date" 
                                        id="issue-date" readonly value="{{get_formatted_date_from_timestamp($invoice->issue_date)}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="due-date">
                                        {{__('web.due_date')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="due_date" 
                                        id="due-date" readonly value="{{get_formatted_date_from_timestamp($invoice->due_date)}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="status">
                                        {{__('web.status')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                        name="status" id="status">
                                        <option value="unpaid" <?php if ($invoice->status == 'unpaid') echo 'selected';?>>{{__('web.unpaid')}}</option>
                                        <option value="partially_paid" <?php if ($invoice->status == 'partially_paid') echo 'selected';?>>{{__('web.partially_paid')}}</option>
                                        <option value="paid" <?php if ($invoice->status == 'paid') echo 'selected';?>>{{__('web.paid')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="recurring">
                                        {{__('web.recurring')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                        name="recurring" id="recurring">
                                        <option value="0" <?php if ($invoice->recurring == '0') echo 'selected';?>>{{__('web.no')}}</option>
                                        <option value="1" <?php if ($invoice->recurring == '1') echo 'selected';?>>{{__('web.yes')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="employee-id">
                                        {{__('web.employee')}}
                                    </label>
                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                                        name="employee_id" id="employee-id" title="{{__('web.select_one')}}" data-live-search="true">
                                        @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                                            <option value="{{$employee->id}}" <?php if ($invoice->employee_id == $employee->id) echo 'selected'; ?>>
                                                {{$employee->user->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="m-form__group form-group">
                                    <div class="m-checkbox-list">
                                        <label class="m-checkbox m-checkbox--state-accent">
                                            <input type="checkbox" name="tax_invoice" value="yes" @if($invoice->tax_invoice == 'yes') checked="checked" @endif> 
                                            <strong>{{__('web.this_is_a_tax_invoice')}}</strong>
                                            <span></span>
                                        </label>
                                    </div>
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
                            <div class="col-lg-2 col-md-2"><span class="m--font-boldest">{{__('web.description')}}</span></div>
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
                            @foreach (json_decode($invoice->items) as $key => $entered_item)
                            <div class="entry-row" id="{{$key+1}}">
                                <div class="row mb-4">
                                    <div class="col-lg-2 col-md-2">
                                        @if ($entered_item->type == 'product')
                                            <span>{{\App\Product::where('id', $entered_item->id)->first()->name}}</span>
                                        @endif
                                        @if ($entered_item->type == 'service')
                                            <span>{{\App\Service::where('id', $entered_item->id)->first()->name}}</span>
                                        @endif
                                        <input type="hidden" name="item[]" value="{{$entered_item->type}}-{{$entered_item->id}}">
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <span>{{$entered_item->description}}</span>
                                        <input type="hidden" name="description[]" value="{{$entered_item->description}}">
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->uom}}</span>
                                        <input type="hidden" name="uom[]" value="{{$entered_item->uom}}">
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->qty}}</span>
                                        <input type="hidden" name="qty[]" value="{{$entered_item->qty}}">
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->price}}</span>
                                        <input type="hidden" name="price[]" value="{{$entered_item->price}}">
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->discount}}</span>
                                        <input type="hidden" name="discount[]" value="{{$entered_item->discount}}">
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <span>{{$entered_item->tax == null ? 0 : $entered_item->tax}}</span>
                                        <input type="hidden" name="tax[]" value="{{$entered_item->tax}}">
                                        <input type="hidden" name="tax_id[]" value="{{$entered_item->tax_id}}">
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <span>{{$entered_item->total}}</span>
                                        <input type="hidden" id="total-{{$key+1}}"
                                            name="total[]" value="{{$entered_item->total}}">
                                    </div>
                                    <div class="col-lg-1 col-md-1 text-center">
                                        <div class="form-group m-form__group" id="delete-{{$key+1}}">
                                            <a href="#" style="text-decoration: none;"
                                                onclick="deleteEntry('{{$key+1}}')">
                                                <i class="flaticon-cancel m--font-danger"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-accent m-btn m-btn--custom m-btn--icon m-btn--pill"
                                    id="add-button" onclick="addItemEntry()">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{__('web.add_more_item')}}</span>
                                    </span>
                                </button>
                            </div>
                        </div> --}}
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
                            <div class="col">
                                <div class="form-group m-form__group" id="">
                                    <label for="shipping">
                                        {{__('web.shipping_charge')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill" name="shipping_charge" id="shipping"
                                        onkeyup="calculateGrandTotal()" value="{{$invoice->shipping_charge}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group m-form__group" id="">
                                    <label for="notes">
                                        {{__('web.notes')}}
                                    </label>
                                    <textarea class="form-control m-input m-input--pill" id="notes" name="notes" rows="7">{{$invoice->notes}}</textarea>
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
                                    {{get_config('currency')}} <span id="subTotal">{{$invoice->grand_total - $invoice->shipping_charge}}</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.shipping_charge')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="shipping-charge">{{$invoice->shipping_charge}}</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.total')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="grandTotal">{{$invoice->grand_total}}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
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
        //$('#add-button').prop('disabled', !0);
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });
    function calculateGrandTotal() {
        var grandTotal = 0.0;
        var values = $("input[name='total[]']").map(function() {
            return $(this).val();
        }).get();
        for (var i = 0; i < values.length; i++) {
            grandTotal += parseFloat(values[i]);
        }
        $('#subTotal').html(grandTotal.toFixed(2));
        // shipping charge
        var shippingCharge = parseFloat($('#shipping').val());
        grandTotal = grandTotal + shippingCharge;
        $('#shipping-charge').html(shippingCharge.toFixed(2));
        $('#grandTotal').html(grandTotal.toFixed(2));
        $('#grand_total').val(grandTotal.toFixed(2));
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