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
            <div class="row" style="margin-bottom: 3rem;">
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
            <div class="row" style="margin-bottom: 3rem;">
                <div class="col">
                    @php
                        $customer_info = \App\Customer::where('id', $invoice->customer_id)->first();
                    @endphp
                    <table class="table">
                        <thead class="table-inverse">
                            <tr>
                                <th>{{__('web.customer')}}</th>
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
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('web.invoice_info')}}</th>
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
                <div class="col">
                    <table class="table">
                        <thead>
                            @if(isset($due))
                            <tr>
                                <th style="background-color: {{get_config('invoice_color_1')}} !important; color: white;">{{__('web.amount_due')}}</th>
                                <th style="text-align: right; background-color: {{get_config('invoice_color_1')}} !important; color: white;">
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
                <div class="col-7">
                    @if ($invoice->notes != null)
                        <h6>{{__('web.notes')}}</h6>
                        <p>{{$invoice->notes}}</p>
                    @endif
                </div>
                <div class="col-5">
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