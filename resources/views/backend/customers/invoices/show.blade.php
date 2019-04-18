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
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('customer.invoices')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.invoices')}}</span>
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
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="printInvoice()">
                                            <i class="m-nav__link-icon la la-print"></i>
                                            <span class="m-nav__link-text">{{__('web.print')}}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="{{route('customer.download_invoice', $invoice->id)}}" class="m-nav__link">
                                            <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="m-nav__link-text">{{__('web.download')}}</span>
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
                                            onclick="presentModal('{{route('customer.invoice_payment_receipt', $payment->id)}}', '{{__('web.payment_receipt')}}')">
                                            <i class="la la-link"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.customers.invoices.invoice')
    </div>
</div>

@endsection

@section('script')
    <script>
        function printInvoice() {
            $('#invoice-portlet').printThis({
                importStyle: true,
                pageTitle: '{{$invoice->invoice_no}}',
                removeInline: false
            });
        }
    </script>
@endsection