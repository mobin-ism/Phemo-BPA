@if(is_permitted('invoice_view'))
@extends('backend.layouts.master')
@section('content')

@php
    $total_payment = 0;
    $hasDue = false;
    foreach (\App\Payment::where('invoice_id', $invoice->id)->get() as $pay)
        $total_payment += $pay->amount;
    if ($total_payment < $invoice->grand_total) {
        $hasDue = true;
        $due = number_format(($invoice->grand_total - $total_payment), 2, '.', ',');
    }
    
    // calculate sub total of items
    // $subTotal = 0;
    // foreach (App\Bill::find($bill->id)->bill_items as $item)
    //     $subTotal += $item->total; 
@endphp

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.invoice_details')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                @if (is_permitted('invoice_view'))
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('invoices.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.invoices')}}</span>
                    </a>
                </li>
                @endif
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
                                    @if (is_permitted('invoice_edit'))
                                    <li class="m-nav__item">
                                        <a href="{{route('invoices.edit', $invoice)}}" class="m-nav__link">
                                            <i class="m-nav__link-icon la la-edit"></i>
                                            <span class="m-nav__link-text">{{__('web.edit')}}</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="printInvoice()">
                                            <i class="m-nav__link-icon la la-print"></i>
                                            <span class="m-nav__link-text">{{__('web.print')}}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="{{route('invoices.download', $invoice->id)}}" class="m-nav__link">
                                            <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="m-nav__link-text">{{__('web.download')}}</span>
                                        </a>
                                    </li>
                                    @if (is_permitted('invoice_edit'))
                                    <li class="m-nav__item">
                                        <a href="{{route('customers.email_invoice', $invoice->id)}}" class="m-nav__link">
                                            <i class="m-nav__link-icon la la-send"></i>
                                            <span class="m-nav__link-text">{{__('web.email_customer')}}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if (is_permitted('invoice_delete'))
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="confirmModal('{{route('invoices.delete', $invoice->id)}}')">
                                            <i class="m-nav__link-icon la la-trash"></i>
                                            <span class="m-nav__link-text">{{__('web.delete')}}</span>
                                        </a>
                                    </li>
                                    @endif
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
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{__('web.payments')}}
                            </h3>
                        </div>
                    </div>
                    @if ($hasDue == true)
                    @if (is_permitted('invoice_edit'))
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" class="btn btn-accent m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"
                                    onclick="presentModal('{{route('invoices.payment', $invoice->id)}}', '{{__('web.record_payment')}}')">
                                    <i class="la la-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    @endif
                </div>
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('web.info')}}</th>
                                    <th>{{__('web.amount')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Payment::where('invoice_id', $invoice->id)->get() as $payment)
                                <tr>
                                    <td>
                                        <span class="m--font-bolder">{{__('web.invoice_no')}} - </span> <span>{{$invoice->invoice_no}}</span><br>
                                        <span class="m--font-bolder">{{__('web.method')}} - </span> <span>{{$payment->payment_method->name}}</span><br>
                                        <span class="m--font-bolder">{{__('web.date')}} - </span> <span>{{get_formatted_date_from_timestamp($payment->date)}}</span><br>
                                        <span class="m--font-bolder">{{__('web.reference')}} - </span> <span>{{$payment->reference}}</span><br>
                                        @if ($payment->notes != null) <span class="m--font-bolder">{{__('web.notes')}} - </span> <span>{{$payment->notes}}</span> @endif
                                    </td>
                                    <td>{{get_config('currency')}} {{number_format($payment->amount, 2, '.', ',')}}</td>
                                    <td align="right">
                                        <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                                            onclick="presentModal('{{route('invoices.receipt', $payment->id)}}', '{{__('web.payment_receipt')}}')">
                                            <i class="la la-link"></i>
                                        </a>
                                        @if (is_permitted('invoice_edit'))
                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                                            onclick="confirmModal('{{route('invoices.delete_payment', [$payment->id, $invoice->id])}}')">
                                            <i class="la la-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role == 'admin')
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{__('web.color_options')}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <form action="{{route('configs.invoice_color')}}" method="POST">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="bill-color-1">
                                        {{__('web.color_1')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill minicolors" id="bill-color-1"
                                        name="invoice_color_1" value="{{get_config('invoice_color_1')}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group m-form__group" id="">
                                    <label for="bill-color-2">
                                        {{__('web.color_2')}}
                                    </label>
                                    <input type="text" class="form-control m-input m-input--pill minicolors" id="bill-color-2"
                                        name="invoice_color_2" value="{{get_config('invoice_color_2')}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                    <span>
                                        <i class="la la-save"></i>
                                        <span>{{__('web.save')}}</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
        @include('backend.pages.invoices.invoice')
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.minicolors').minicolors({
                theme: 'bootstrap'
            });
        });
        function printInvoice() {
            $('#invoice-portlet').printThis({
                importStyle: true,
                pageTitle: '{{$invoice->invoice_no}}',
                removeInline: false
            });
        }
    </script>
@endsection

@endif