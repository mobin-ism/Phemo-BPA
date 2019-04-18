@php
    $color = \App\Config::where('account_id', Auth::user()->account_id)->first()->template_color;
    $text_color = \App\Config::where('account_id', Auth::user()->account_id)->first()->text_color;
@endphp

<div style="padding: 30px;border: 10px solid #{{$color}};margin: 8px;">
<style media="screen">
    *{
        margin: 0;
        padding: 0;
        line-height: 1.5;
    }
    thead{
        background: #e4e4e4;
    }
    thead th:first-child,
    tbody td:first-child{
        text-align: left;
    }
    hr,
    table,th, td {
        border: 1px solid #e4e4e4;
        border-collapse: collapse;
    }
    th,td{
        padding: 5px;
        text-align: left;
    }
    .no-padding th,.no-padding td{
        padding: 0px;
        line-height: 1.5
    }
    .no-padding th{
        font-weight: normal;
    }
    .no-padding tr:last-child th,
    .no-padding tr:last-child td{
        border-top: 1px solid #e4e4e4;
    }
    table.no-padding th,
    table.no-padding td{
        border: 0;
        text-align: right;
    }
    table.no-padding{
        min-width:30%;
        border: 0;
        margin-left: auto;
    }
</style>
    <div>
        <div style="display: inline-block;max-width:50%;width:50%;vertical-align: top;">
            <img src="{{ asset('backend/assets/images/phemo_white.png') }}" style="max-width:60%;">
        </div>
        <div style="display: inline-block;max-width:49%;width:49%;text-align:right;">
            <h2>Quotation</h2>
            <p><i>RFQ <strong>#{{ $quotation->code }}</strong></i></p>
            <p><strong>Phemo</strong></p>
            <p>Demo Address</p>
            <p>125 54151 55</p>
        </div>
    </div>

    <hr style="margin:5px 0">
    <br>

    <div>
        <div style="display: inline-block;max-width:50%;width:50%">
            <p><strong><i>Customer Info:</i></strong></p>
            <p>{{ $quotation->customer->customer_name }}</p>
            <p>{{ $quotation->customer->address }}</p>
            <p>{{ $quotation->customer->telephone }}</p>
            <p>{{ $quotation->customer->website }}</p>

        </div>
        <div style="display: inline-block;max-width:49%;width:49%;text-align:right;vertical-align: top;">
            <p><strong><i>Quotation Date:</i></strong></p>
            <p>{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, strtotime($quotation->quotation_date))}}</p>
        </div>
    </div>

    <hr style="margin:5px 0">

    @if(count(json_decode($quotation->products))>0)

    <div>
        <h3 style="margin-bottom:15px;">Products</h3>
        <div>
            <table style=" border-collapse: collapse;width: 100%;">
                <thead style="background:#{{$color}}; color:#{{$text_color}}">
                    <tr>
                        <th width="35%">{{ __('web.product_name') }}</th>
                        <th width="10%">{{ __('web.qty') }}</th>
                        <th width="15%">{{ __('web.unit_price') }}</th>
                        <th width="15%">{{ __('web.discount') }}(%)</th>
                        <th width="10%">{{ __('web.tax') }}</th>
                        <th width="15%">{{ __('web.total_amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php
                        $products =  json_decode($quotation->products);
                    @endphp

                    @foreach($products as  $prod)

                        @php $product = \App\Product::find($prod->id) @endphp

                        @if($product!=null)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $prod->qty }}</td>
                                <td>{{ number_format($product->unit_price,2) }}</td>
                                <td>{{ $prod->discount }}</td>
                                <td>{{ $prod->tax }}</td>
                                <td>{{ number_format(($product->unit_price*$prod->qty)-(($product->unit_price*$prod->qty)*($prod->discount/100))+(($product->unit_price*$prod->qty)*($prod->tax/100)),2)}}</td>
                            </tr>
                        @endif
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

    <br>

    @endif
    
    @if(count(json_decode($quotation->services))>0)

    <div>
        <h3 style="margin-bottom:15px;">Services</h3>
        <div>
            <table style="border-collapse: collapse;width: 100%;">
                <thead style="background:#{{$color}}; color:#{{$text_color}}">
                    <tr>
                        <th width="35%">{{ __('web.service_name') }}</th>
                        <th width="10%">{{ __('web.qty') }}</th>
                        <th width="15%">{{ __('web.unit_price') }}</th>
                        <th width="15%">{{ __('web.discount') }}(%)</th>
                        <th width="10%">{{ __('web.tax') }}(%)</th>
                        <th width="15%">{{ __('web.total_amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php
                        $services =  json_decode($quotation->services);
                    @endphp

                    @foreach($services as  $ser)

                        @php $service = \App\Service::find($ser->id) @endphp

                        @if($service != null)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $ser->duration }}</td>
                                <td>{{ number_format($service->rate_charge,2) }}</td>
                                <td>{{ $ser->discount }}</td>
                                <td>{{ $ser->tax }}(%)</td>
                                <td>{{ number_format(($service->rate_charge*$ser->duration)-(($service->rate_charge*$ser->duration)*($ser->discount/100))+(($service->rate_charge*$ser->duration)*($ser->tax/100)),2)}}</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <br>

    @endif

    
    @php
        $total = 0;
    @endphp

    @if(count(json_decode($quotation->costs))>0)

    <div>
        <h3 style="margin-bottom:15px;">Additional Costs</h3>
        <div>
            <table style="border-collapse: collapse;width: 100%;">
                <thead style="background:#{{$color}}; color:#{{$text_color}}">
                    <tr>
                        <th width="35%">Cost Heading</th>
                        <th width="10%">{{ __('web.qty') }}</th>
                        <th width="15%">{{ __('web.unit_price') }}</th>
                        <th width="15%">{{ __('web.discount') }}(%)</th>
                        <th width="10%">{{ __('web.tax') }}(%)</th>
                        <th width="15%">{{ __('web.total_amount') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $costs =  json_decode($quotation->costs);
                    @endphp

                    @foreach($costs as  $cos)

                        @php $cost = \App\AdditionalCost::find($cos->id); @endphp

                        @if($cost != null)
                            <tr>
                                <td>{{ $cost->name }}</td>
                                <td>{{ $cos->cost_duration }}</td>
                                <td>{{ number_format($cost->unit_price,2) }}</td>
                                <td>{{ $cos->discount }}</td>
                                <td>{{ $cos->tax }}</td>
                                @php
                                    $total = $total + ($cost->unit_price*$cos->cost_duration)-(($cost->unit_price*$cos->cost_duration)*($cos->discount/100));
                                @endphp
                                <td>{{ number_format(($cost->unit_price*$cos->cost_duration)-(($cost->unit_price*$cos->cost_duration)*($cos->discount/100))+(($cost->unit_price*$cos->cost_duration)*($cos->tax/100)),2)}}</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <br>

    @endif

    <div>
        <div>
            <table class="no-padding">
                <tbody>
                    <tr>
                        <th>Sub Total</th>
                        <td>{{ number_format($quotation->sub_total,2) }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>{{ number_format($quotation->discount,2) }}</td>
                    </tr>
                    <tr>
                        <th>Total Tax Amount</th>
                        <td>{{ number_format($quotation->total_tax,2) }}</td>
                    </tr>
                    <tr>
                        <th>Total Additional Cost</th>
                        <td>{{ number_format($total,2) }}</td>
                    </tr>
                    <tr>
                        <th><b>Grand Total</b></th>
                        <td>{{ number_format($quotation->grand_total,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
