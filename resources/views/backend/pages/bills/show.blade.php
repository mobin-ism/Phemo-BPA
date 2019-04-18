@if(is_permitted('bill_view'))
@extends('backend.layouts.master')
@section('content')

@php
    $total_payment = 0;
    $hasDue = false;
    foreach (\App\Payment::where('bill_id', $bill->id)->get() as $pay)
        $total_payment += $pay->amount;
    if ($total_payment < $bill->grand_total) {
        $hasDue = true;
        $due = number_format(($bill->grand_total - $total_payment), 2, '.', ',');
    }
    
    // calculate sub total of items
    $subTotal = 0;
    foreach (App\Bill::find($bill->id)->bill_items as $item)
        $subTotal += $item->total; 
@endphp

    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.bill_details')}}</h3>
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
                                        @if ($hasDue)
                                        @if (is_permitted('bill_edit'))
                                            <li class="m-nav__item">
                                                <a href="{{route('bills.edit', $bill->id)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon la la-edit"></i>
                                                    <span class="m-nav__link-text">{{__('web.edit')}}</span>
                                                </a>
                                            </li>
                                        @endif
                                        @endif
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link"
                                                onclick="printBill()">
                                                <i class="m-nav__link-icon la la-print"></i>
                                                <span class="m-nav__link-text">{{__('web.print')}}</span>
                                            </a>
                                        </li>
                                        {{-- <li class="m-nav__item">
                                            <a href="{{route('bills.pdf', $bill->id)}}" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="m-nav__link-text">{{__('web.pdf')}}</span>
                                            </a>
                                        </li> --}}
                                        @if (is_permitted('bill_delete'))
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link"
                                                onclick="confirmModal('{{route('bills.delete', $bill->id)}}')">
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
    <!-- END: Subheader -->
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
                        @if (is_permitted('bill_edit'))
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="#" class="btn btn-accent m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"
                                        onclick="presentModal('{{route('bills.payment', $bill->id)}}', '{{__('web.record_payment')}}')">
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
                                    @foreach(\App\Payment::where('bill_id', $bill->id)->get() as $payment)
                                    <tr>
                                        <td>
                                            <span class="m--font-bolder">{{__('web.bill_no')}} - </span> <span>{{$bill->bill_no}}</span><br>
                                            <span class="m--font-bolder">{{__('web.method')}} - </span> <span>{{$payment->payment_method->name}}</span><br>
                                            <span class="m--font-bolder">{{__('web.date')}} - </span> <span>{{get_formatted_date_from_timestamp($payment->date)}}</span><br>
                                            <span class="m--font-bolder">{{__('web.reference')}} - </span> <span>{{$payment->reference}}</span><br>
                                            @if ($payment->notes != null) <span class="m--font-bolder">{{__('web.notes')}} - </span> <span>{{$payment->notes}}</span> @endif
                                        </td>
                                        <td>{{get_config('currency')}} {{number_format($payment->amount, 2, '.', ',')}}</td>
                                        @if (is_permitted('bill_edit'))
                                        <td align="right">
                                            <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                                                onclick="confirmModal('{{route('bills.delete_payment', [$payment->id, $bill->id])}}')">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if ($bill->attachment != null)
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.attachment')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    @php
                        $attachment = explode('/', $bill->attachment);
                        $attachment = end($attachment);
                    @endphp
                    <div class="m-portlet__body">
                        <div class="m-widget4__item">
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    <a href="{{route('bills.download', $bill->bill_no)}}" class="m--link" style="text-decoration: none;">
                                        <i class="flaticon-download"></i>
                                    </a>
                                    &nbsp; &nbsp;
                                    {{$attachment}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
                        <form action="{{route('configs.bill_color')}}" method="POST">
                            @csrf
                            <div class="row mb-5">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group m-form__group" id="">
                                        <label for="bill-color-1">
                                            {{__('web.color_1')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill minicolors" id="bill-color-1"
                                            name="bill_color_1" value="{{get_config('bill_color_1')}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group m-form__group" id="">
                                        <label for="bill-color-2">
                                            {{__('web.color_2')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill minicolors" id="bill-color-2"
                                            name="bill_color_2" value="{{get_config('bill_color_2')}}" readonly>
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
            @include('backend.pages.bills.partials.bill')
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
        function printBill() {
            $('#bill-invoice-portlet').printThis({
                importStyle: true,
                pageTitle: '{{$bill->bill_no}}',
                removeInline: false
            });
        }
    </script>
@endsection
@endif