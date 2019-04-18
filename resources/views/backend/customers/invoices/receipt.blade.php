<div class="row mb-5">
    <div class="col">
        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
            onclick="printInvoicePaymentReceipt()">
            <span>
                <i class="la la-print"></i>
                <span>{{__('web.print')}}</span>
            </span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="m-portlet" id="invoice-payment-receipt">
            <div class="m-portlet__body">
                <div class="row" style="margin-bottom: 3rem;">
                    <div class="col">
                        <h4>{{__('web.payment_receipt')}}</h4>
                    </div>
                    <div class="col" style="text-align: right;">
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
                                    <th style="background-color: {{get_config('invoice_color_1')}} !important; color: white;">{{__('web.amount_received')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_1')}} !important; color: white;">
                                        {{get_config('currency')}} {{number_format($payment->amount, 2, '.', ',')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: 700;">{{__('web.reference')}}</td>
                                    <td style="font-weight: 700; text-align: right;">
                                        {{$payment->reference}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400;">{{__('web.payment_date')}}</td>
                                    <td style="font-weight: 400; text-align: right;">
                                        {{get_formatted_date_from_timestamp($payment->date)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400;">{{__('web.payment_method')}}</td>
                                    <td style="font-weight: 400; text-align: right;">
                                        {{$payment->payment_method->name}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5rem;">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: left; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.invoice_no')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.invoice_date')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.invoice_amount')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.payment_amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: left;">
                                        {{get_config('invoice_prefix')}}-{{$invoice->invoice_no}}
                                    </td>
                                    <td style="text-align: right;">
                                        {{get_formatted_date_from_timestamp($invoice->issue_date)}}
                                    </td>
                                    <td style="text-align: right;">
                                        {{number_format($invoice->grand_total, 2, '.', ',')}}
                                    </td>
                                    <td style="text-align: right;">
                                        {{number_format($payment->amount, 2, '.', ',')}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5rem;">
                    <div class="col-3">
                        <hr>
                        {{__('web.provider_signature')}}
                    </div>
                    <div class="col-3">
                        <hr>
                        {{__('web.receiver_signature')}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <img src="{{asset('public/backend/assets/images/phemo_white_t.png')}}" width="80">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
    function printInvoicePaymentReceipt() {
        $('#invoice-payment-receipt').printThis({
            importStyle: true,
            pageTitle: '{{$payment->reference}}',
            removeInline: false
        });
    }
</script>