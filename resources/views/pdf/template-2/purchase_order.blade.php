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
            <h2>Purchase Order</h2>
            <p><strong>Phemo</strong></p>
            <p>Demo Address</p>
            <p>125 54151 55</p>
        </div>
    </div>

    <hr style="margin:5px 0">
    <br>

    <div>
        <div style="display: inline-block;max-width:50%;width:50%">
            <p><strong><i>Order Info:</i></strong></p>
            <p>PO #{{ $purchase_order->po }}</p>
            <p>PR #{{ $purchase_order->pr }}</p>
            <p>{{ $purchase_order->purpose }}</p>
            <p>{{ $purchase_order->request_type }}</p>

        </div>
        <div style="display: inline-block;max-width:49%;width:49%;text-align:right;vertical-align: top;">
            <p><strong><i>Order Date:</i></strong></p>
            <p>{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, strtotime($purchase_order->date))}}</p>
        </div>
    </div>

    <hr style="margin:5px 0">

    <div>
        <h3 style="margin-bottom:15px;">Products</h3>
        <div>
            <table style=" border-collapse: collapse;width: 100%;">
                <thead style="background:#{{$color}}; color:#{{$text_color}}">
                    <tr>
                        <th width="35%">{{ __('web.product_name') }}</th>
                        <th width="10%">{{ __('web.qty') }}</th>
                        <th width="15%">{{ __('web.unit_price') }}</th>
                        <th width="15%">{{ __('web.total_amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php
                        $products =  json_decode($purchase_order->products);
                    @endphp

                    @foreach($products as  $prod)

                        @php $product = \App\Product::find($prod->id) @endphp

                        @if($product!=null)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $prod->qty }}</td>
                                <td>{{ number_format($product->unit_price,2) }}</td>
                                <td>{{ number_format($product->unit_price*$prod->qty,2) }}</td>
                            </tr>
                        @endif
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

    <br>

    <div>
        <h3 style="margin-bottom:15px;">Services</h3>
        <div>
            <table style="border-collapse: collapse;width: 100%;">
                <thead style="background:#{{$color}}; color:#{{$text_color}}">
                    <tr>
                        <th width="35%">{{ __('web.service_name') }}</th>
                        <th width="10%">{{ __('web.qty') }}</th>
                        <th width="15%">{{ __('web.unit_price') }}</th>
                        <th width="15%">{{ __('web.total_amount') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $services =  json_decode($purchase_order->services);
                    @endphp

                    @foreach($services as  $ser)

                        @php $service = \App\Service::find($ser->id) @endphp

                        @if($service != null)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $ser->duration }}</td>
                                <td>{{ number_format($service->rate_charge,2) }}</td>
                                <td>{{ number_format($service->rate_charge*$ser->duration,2) }}</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <br>


    <div>
        <div>
            <table class="no-padding">
                <tbody>
                    <tr>
                        <th><b>Grand Total</b></th>
                        <td>{{ number_format($purchase_order->grand_total,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>