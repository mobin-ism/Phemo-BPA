@if (!isset($hasDue))
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
@endif
<div class="col-lg-8 col-md-8" id="bill-invoice-portlet">
    <div class="m-portlet">
        <div class="m-portlet__body">
            <div class="row" style="margin-bottom: 3rem;">
                <div class="col-lg-6 col-md-6">
                    <h3>{{__('web.bill')}}</h3>
                    <h4>{{__('web.bill_no')}}. {{$bill->bill_no}}</h4>
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
                    <table class="table">
                        <thead class="table-inverse">
                            <tr>
                                <th>{{__('web.vendor')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>{{ $bill->vendor->name }}</strong> <br>
                                    {{ $bill->vendor->address_line_1 }} <br>
                                    {{ $bill->vendor->address_line_2 }} <br>
                                    {{ $bill->vendor->city }}, {{ \App\Country::where('id', $bill->vendor->country_id)->first()->name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('web.bill_info')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: none; padding: 0.2rem;">{{__('web.po_no')}}</td>
                                <td style="text-align: right; border: none; padding: 0.2rem;">{{$bill->po_no}}</td>
                            </tr>
                            <tr>
                                <td style="border: none; padding: 0.2rem;">{{__('web.po_date')}}</td>
                                <td style="text-align: right; border: none; padding: 0.2rem;">
                                    {{get_formatted_date_from_timestamp($bill->po_date)}}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none; padding: 0.2rem;">{{__('web.issue_date')}}</td>
                                <td style="text-align: right; border: none; padding: 0.2rem;">
                                    {{get_formatted_date_from_timestamp($bill->bill_date)}}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none; padding: 0.2rem;">{{__('web.due_date')}}</td>
                                <td style="text-align: right; border: none; padding: 0.2rem;">
                                    {{get_formatted_date_from_timestamp($bill->due_date)}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($hasDue)
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="background-color: {{get_config('bill_color_1')}} !important; color: white;">{{__('web.amount_due')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('bill_color_1')}} !important; color: white;">
                                        {{get_config('currency')}} {{$due}}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: left; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.items')}}</th>
                                <th style="text-align: right; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.qty')}}</th>
                                <th style="text-align: right; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.uom')}}</th>
                                <th style="text-align: right; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.price')}}</th>
                                <th style="text-align: right; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.tax')}} %</th>
                                <th style="text-align: right; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.discount')}} %</th>
                                <th style="text-align: right; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.amount')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                foreach (App\Bill::find($bill->id)->bill_items as $item):
                            @endphp
                            <tr>
                                <td style="text-align: left;">
                                    @if ($item->item_type == 'product')
                                        <span style="font-weight: 500;">
                                            {{\App\Product::where('id', $item->item_id)->first()->name}}
                                        </span>
                                        <br>
                                        <span style="color: #818181; font-weight: 100;">
                                            {{\App\Product::where('id', $item->item_id)->first()->description}}
                                        </span>
                                    @endif
                                    @if ($item->item_type == 'service')
                                        <span style="font-weight: 500;">
                                            {{\App\Service::where('id', $item->item_id)->first()->name}}
                                        </span>
                                        <br>
                                        <span style="color: #818181; font-weight: 100;">
                                            {{\App\Service::where('id', $item->item_id)->first()->description}}
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
                <div class="col-7"></div>
                <div class="col-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: left; background-color: {{get_config('bill_color_2')}} !important; color: white;">{{__('web.summary')}}</th>
                                <th style="text-align: right; background-color: {{get_config('bill_color_2')}} !important; color: white;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight: 400; text-align: left;">{{__('web.sub_total')}}</td>
                                <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($subTotal, 2, '.', ',')}}</td>
                            </tr>
                            @foreach (get_tax_amounts_for_bill($bill->id) as $tax_name)
                            <tr>
                                <td style="font-weight: 400; text-align: left;">
                                    {{\App\Tax::where('id', $tax_name->tax_id)->first()->name}}
                                </td>
                                <td style="font-weight: 400; text-align: right;">
                                    {{get_config('currency')}} {{number_format($tax_name->amount, 2, '.', ',')}}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td style="font-weight: 400; text-align: left;">{{__('web.shipping_charge')}}</td>
                                <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($bill->shipping_charge, 2, '.', ',')}}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 400; text-align: left;">{{__('web.grand_total')}}</td>
                                <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($bill->grand_total, 2, '.', ',')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    {{-- <h5>{{__('web.terms_and_conditions')}}</h5>
                    <p>{{get_config('tc_bill')}}</p> --}}
                    <p><img src="{{asset('public/backend/assets/images/phemo_white_t.png')}}" width="80"></p>
                </div>
            </div>
        </div>
    </div>
</div>