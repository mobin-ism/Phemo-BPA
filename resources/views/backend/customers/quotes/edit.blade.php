@extends('backend.layouts.master')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.edit_quote')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('customer.quotes')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.quotes')}}</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('customer.show_quote', $quote->id)}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.quote_details')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<form action="{{route('customer.update_quote', $quote->id)}}" method="post" id="quote-update-form">
    @csrf
    {{ Form::hidden('account_id', Auth::user()->account_id) }}
    <input type="hidden" name="grand_total" id="grand_total" value="{{$quote->grand_total}}">
    <div class="m-content">
        <div class="row">
            <div class="col">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.quote_information')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row mb-4">
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.customer')}}</h6>
                                @php
                                    $customer = \App\Customer::where('id', $quote->customer_id)->first();
                                @endphp
                                {{$customer->customer_type == 'company' ? $customer->company_name : $customer->customer_name}}
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.quote_no')}}</h6>
                                {{get_config('quotation_prefix')}}-{{$quote->quote_no}}
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.po_no')}}</h6>
                                {{$quote->po_no}}
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.issue_date')}}</h6>
                                {{get_formatted_date_from_timestamp($quote->issue_date)}}
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.expiry_date')}}</h6>
                                {{get_formatted_date_from_timestamp($quote->expiry_date)}}
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.status')}}</h6>
                                {{__('web.'.$quote->status)}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.shipping_charge')}}</h6>
                                {{get_config('currency')}} {{number_format($quote->shipping_charge, 2, '.', ',')}}
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-12">
                                <h6>{{__('web.notes')}}</h6>
                                {{$quote->notes}}
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
                            @foreach (json_decode($quote->items) as $key => $entered_item)
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
            <div class="col-lg-6 col-md-6 col-sm-12 offset-lg-6 offset-md-6">
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
                                    {{get_config('currency')}} <span id="subTotal">{{$quote->grand_total - $quote->shipping_charge}}</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.shipping_charge')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="shipping-charge">{{$quote->shipping_charge}}</span>
                                </span>
                            </div>
                            <div class="m-widget13__item">
                                <span class="m-widget13__desc m--align-right">
                                    {{__('web.total')}}
                                </span>
                                <span class="m-widget13__text m-widget13__text-bolder">
                                    {{get_config('currency')}} <span id="grandTotal">{{$quote->grand_total}}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="shipping_charge" id="shipping" value="{{$quote->shipping_charge}}">
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