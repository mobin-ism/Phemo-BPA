<!DOCTYPE html>
<html><head>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <style>

            @media all {
                *,
                *::before,
                *::after {
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                }
                body {
                    margin: 0;
                    font-family: "Poppins";
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #212529;
                    text-align: left;
                    background-color: #fff;
                }
                hr {
                    -webkit-box-sizing: content-box;
                    box-sizing: content-box;
                    height: 0;
                    overflow: visible;
                }
                h3,
                h4,
                h5 {
                    margin-top: 0;
                    margin-bottom: .5rem;
                }
                p {
                    margin-top: 0;
                    margin-bottom: 1rem;
                }
                strong {
                    font-weight: bolder;
                }
                img {
                    vertical-align: middle;
                    border-style: none;
                }
                table {
                    border-collapse: collapse;
                }
                th {
                    text-align: inherit;
                }
                h3,
                h4,
                h5 {
                    margin-bottom: .5rem;
                    font-family: inherit;
                    font-weight: 500;
                    line-height: 1.2;
                    color: inherit;
                }
                h3 {
                    font-size: 1.75rem;
                }
                h4 {
                    font-size: 1.5rem;
                }
                h5 {
                    font-size: 1.25rem;
                }
                hr {
                    margin-top: 1rem;
                    margin-bottom: 1rem;
                    border: 0;
                    border-top: 1px solid rgba(0, 0, 0, 0.1);
                }
                .row {
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    flex-wrap: wrap;
                    margin-right: -15px;
                    margin-left: -15px;
                }
                .col,
                .col-sm-4,
                .col-sm-5,
                .col-sm-7,
                .col-sm-12,
                .col-md-4,
                .col-md-5,
                .col-md-6,
                .col-md-7,
                .col-md-8,
                .col-lg-4,
                .col-lg-5,
                .col-lg-6,
                .col-lg-7,
                .col-lg-8 {
                    position: relative;
                    width: 100%;
                    min-height: 1px;
                    padding-right: 15px;
                    padding-left: 15px;
                }
                .col {
                    -ms-flex-preferred-size: 0;
                    flex-basis: 0;
                    -webkit-box-flex: 1;
                    -ms-flex-positive: 1;
                    flex-grow: 1;
                    max-width: 100%;
                }
                @media (min-width: 576px) {
                    .col-sm-4 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 33.33333%;
                        flex: 0 0 33.33333%;
                        max-width: 33.33333%;
                    }
                    .col-sm-5 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 41.66667%;
                        flex: 0 0 41.66667%;
                        max-width: 41.66667%;
                    }
                    .col-sm-7 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 58.33333%;
                        flex: 0 0 58.33333%;
                        max-width: 58.33333%;
                    }
                    .col-sm-12 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 100%;
                        flex: 0 0 100%;
                        max-width: 100%;
                    }
                }
                @media (min-width: 768px) {
                    .col-md-4 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 33.33333%;
                        flex: 0 0 33.33333%;
                        max-width: 33.33333%;
                    }
                    .col-md-5 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 41.66667%;
                        flex: 0 0 41.66667%;
                        max-width: 41.66667%;
                    }
                    .col-md-6 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 50%;
                        flex: 0 0 50%;
                        max-width: 50%;
                    }
                    .col-md-7 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 58.33333%;
                        flex: 0 0 58.33333%;
                        max-width: 58.33333%;
                    }
                    .col-md-8 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 66.66667%;
                        flex: 0 0 66.66667%;
                        max-width: 66.66667%;
                    }
                }
                @media (min-width: 992px) {
                    .col-lg-4 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 33.33333%;
                        flex: 0 0 33.33333%;
                        max-width: 33.33333%;
                    }
                    .col-lg-5 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 41.66667%;
                        flex: 0 0 41.66667%;
                        max-width: 41.66667%;
                    }
                    .col-lg-6 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 50%;
                        flex: 0 0 50%;
                        max-width: 50%;
                    }
                    .col-lg-7 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 58.33333%;
                        flex: 0 0 58.33333%;
                        max-width: 58.33333%;
                    }
                    .col-lg-8 {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 66.66667%;
                        flex: 0 0 66.66667%;
                        max-width: 66.66667%;
                    }
                }
                .table {
                    width: 100%;
                    margin-bottom: 1rem;
                    background-color: rgba(0, 0, 0, 0);
                }
                .table th,
                .table td {
                    padding: .75rem;
                    vertical-align: top;
                    border-top: 1px solid #f4f5f8;
                }
                .table thead th {
                    vertical-align: bottom;
                    border-bottom: 2px solid #f4f5f8;
                }
                @media print {
                    *,
                    *::before,
                    *::after {
                        text-shadow: none!important;
                        -webkit-box-shadow: none!important;
                        box-shadow: none!important;
                    }
                    thead {
                        display: table-header-group;
                    }
                    tr,
                    img {
                        page-break-inside: avoid;
                    }
                    p,
                    h3 {
                        orphans: 3;
                        widows: 3;
                    }
                    h3 {
                        page-break-after: avoid;
                    }
                    body {
                        min-width: 992px!important;
                    }
                    .table {
                        border-collapse: collapse!important;
                    }
                    .table td,
                    .table th {
                        background-color: #fff!important;
                    }
                }
                body {
                    height: 100%;
                    margin: 0px;
                    padding: 0px;
                    font-size: 11px;
                    font-weight: 300;
                    font-family: Poppins;
                    -ms-text-size-adjust: 100%;
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                }
                body {
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-orient: vertical;
                    -webkit-box-direction: normal;
                    -ms-flex-direction: column;
                    flex-direction: column;
                }
                @media (min-width: 769px) and (max-width: 1024px) {
                    body {
                        font-size: 12px;
                    }
                }
                @media (max-width: 768px) {
                    body {
                        font-size: 12px;
                    }
                }
                strong {
                    font-weight: bold;
                }
                .m-portlet {
                    margin-bottom: 2.2rem;
                }
                .m-portlet .m-portlet__body {
                    padding: 0;
                }
                .m-portlet {
                    background-color: #fff;
                }
                .m-portlet .m-portlet__body {
                    color: #575962;
                }
                .table th {
                    font-weight: 500;
                }
            }

        </style>
    </head><body>
        @if (!isset($hasDue))
            @php
                $total_payment = 0;
                $hasDue = false;
                $due = 0.0;
                foreach (\App\Payment::where('invoice_id', $invoice->id)->get() as $pay)
                    $total_payment += $pay->amount;
                if ($total_payment < $invoice->grand_total) {
                    $hasDue = true;
                    $due = number_format(($invoice->grand_total - $total_payment), 2, '.', ',');
                }
        
                // calculate sub total of items
                $subTotal = 0;
                foreach (json_decode($invoice->items) as $item)
                    $subTotal += $item->total; 
            @endphp
        @endif
    <div class="col-lg-8 col-md-8" id="invoice-portlet">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <div class="row" style="margin-bottom: 2rem;">
                    <div class="col-lg-6 col-md-6">
                        @if($invoice->tax_invoice == 'yes')
                        <h3>{{__('web.tax_invoice')}}</h3>
                        @else
                        <h3>{{__('web.invoice')}}</h3>
                        @endif
                        <h4>{{__('web.invoice_no')}}. {{get_config('invoice_prefix')}}-{{$invoice->invoice_no}}</h4>
                    </div>
                    <div class="col-lg-6 col-md-6" style="text-align: right;">
                        @php
                            $logo = get_config('logo');
                            $city = get_config('city');
                            $country_id = get_config('country_id');
                            $tax_no = get_config('tax_no');
                        @endphp
                        <img src="{{url('public/storage/'.$logo)}}" width="140"><br>
                        <span>{{get_config('address_line_1')}}</span><br>
                        <span>{{get_config('address_line_2')}}</span>
                        @if($city != null) <br><span>{{$city}}</span> @endif
                        @if($country_id != null) <br><span>{{\App\Country::where('id', $country_id)->first()->name}}</span> @endif
                        @if($tax_no != null) <br><span><strong>{{__('web.tax_no')}}. {{$tax_no}}</strong></span> @endif
                    </div>
                </div>
                <div class="row" style="margin-bottom: 2rem;">
                    <div class="" style="width: 33%; float: left;">
                        @php
                            $customer_info = \App\Customer::where('id', $invoice->customer_id)->first();
                        @endphp
                        <table class="table">
                            <thead class="table-inverse">
                                <tr>
                                    <th style="text-align: left;">{{__('web.customer')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>{{__('web.customer_no')}}. {{$customer_info->customer_no}}</strong><br>
                                        <strong>{{ $customer_info->customer_type == 'company' ? $customer_info->company_name : $customer_info->customer_name }}</strong> <br>
                                        {{ $customer_info->address_line_1 }} <br>
                                        {{ $customer_info->address_line_2 }} <br>
                                        {{ $customer_info->city }}, {{ \App\Country::where('id', $customer_info->country_id)->first()->name }}
                                        @if ($customer_info->customer_type == 'company' && $customer_info->vat_no != null)
                                            <br><br><h6>{{__('web.vat_no')}}. {{$customer_info->vat_no}}</h6>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="width: 33%; float: left;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">{{__('web.invoice_info')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: none; padding: 0.2rem;">{{__('web.po_no')}}</td>
                                    <td style="text-align: right; border: none; padding: 0.2rem;">{{$invoice->po_no}}</td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 0.2rem;">{{__('web.issue_date')}}</td>
                                    <td style="text-align: right; border: none; padding: 0.2rem;">
                                        {{get_formatted_date_from_timestamp($invoice->issue_date)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 0.2rem;">{{__('web.due_date')}}</td>
                                    <td style="text-align: right; border: none; padding: 0.2rem;">
                                        {{get_formatted_date_from_timestamp($invoice->due_date)}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="width: 33%; float: left;">
                        <table class="table">
                            <thead>
                                @if(isset($due))
                                <tr>
                                    <th style="background-color: {{get_config('invoice_color_1')}} !important; color: white; text-align: left;">{{__('web.amount_due')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_1')}} !important; color: white; text-align: right;">
                                        {{get_config('currency')}} {{$due}}
                                    </th>
                                </tr>
                                @endif
                                @if(!isset($due))
                                <tr>
                                    <th style="background-color: {{get_config('invoice_color_1')}} !important; color: white; text-align: center;">
                                        <strong>{{__('web.paid')}}</strong>
                                    </th>
                                </tr>
                                @endif
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: left; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.items')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.qty')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.uom')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.price')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.tax')}} %</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.discount')}} %</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subTotal = 0.0;
                                    $totalTax = 0.0;
                                    $totalDiscount = 0.0;
                                    foreach (json_decode($invoice->items) as $item):
                                        $subTotal += ($item->price * $item->qty);
                                        $totalTax += ($item->price * $item->qty * ($item->tax / 100));
                                        $totalDiscount += ($item->price * $item->qty * ($item->discount / 100));
                                @endphp
                                <tr>
                                    <td style="text-align: left;">
                                        @if ($item->type == 'product')
                                            <span style="font-weight: 500;">
                                                {{\App\Product::where('id', $item->id)->first()->name}}
                                            </span>
                                            <br>
                                            <span style="color: #818181; font-weight: 100;">
                                                {{\App\Product::where('id', $item->id)->first()->description}}
                                            </span>
                                        @endif
                                        @if ($item->type == 'service')
                                            <span style="font-weight: 500;">
                                                {{\App\Service::where('id', $item->id)->first()->name}}
                                            </span>
                                            <br>
                                            <span style="color: #818181; font-weight: 100;">
                                                {{\App\Service::where('id', $item->id)->first()->description}}
                                            </span>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">{{$item->qty}}</td>
                                    <td style="text-align: right;">{{$item->uom}}</td>
                                    <td style="text-align: right;">{{$item->price}}</td>
                                    <td style="text-align: right;">{{$item->tax == null ? '0' : $item->tax}}</td>
                                    <td style="text-align: right;">{{$item->discount == null ? '0' : $item->discount}}</td>
                                    <td style="text-align: right;">{{$item->total}}</td>
                                </tr>
                                @php
                                    endforeach;
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 3rem;">
                    <div class="" style="width: 55%; float: left;">
                        @if ($invoice->notes != null)
                            <h6>{{__('web.notes')}}</h6>
                            <p>{{$invoice->notes}}</p>
                        @endif
                    </div>
                    <div class="" style="width: 45%; float: right;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: left; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.summary')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">{{__('web.sub_total')}}</td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($subTotal, 2, '.', ',')}}</td>
                                </tr>
                                @foreach (json_decode(get_tax_amounts_for_invoice($invoice->id)) as $tax)
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">
                                        {{\App\Tax::where('id', $tax->tax_id)->first()->name}}
                                    </td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($tax->amount, 2, '.', ',')}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">{{__('web.total_discount')}}</td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($totalDiscount, 2, '.', ',')}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">{{__('web.shipping_charge')}}</td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($invoice->shipping_charge, 2, '.', ',')}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">{{__('web.grand_total')}}</td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($invoice->grand_total, 2, '.', ',')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h5>{{__('web.terms_and_conditions')}}</h5>
                        <p>{{get_config('tc_invoice')}}</p>
                        <p><img src="{{asset('public/backend/assets/images/phemo_white_t.png')}}" width="80"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body></html>