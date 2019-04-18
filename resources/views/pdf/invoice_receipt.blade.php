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
                        @endphp
                        <img src="{{url('storage/'.$logo)}}" width="140"><br>
                        <span>{{get_config('address_line_1')}}</span><br>
                        <span>{{get_config('address_line_2')}}</span>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 3rem;">
                    <div class="col">
                        @php
                            $customer_info = \App\Customer::find($invoice->customer_id)->first();
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
                                    <th style="background-color: #f4516c !important; color: white;">{{__('web.amount_received')}}</th>
                                    <th style="text-align: right; background-color: #f4516c !important; color: white;">
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
                                    <th style="text-align: left; background-color: #5867dd !important; color: white;">{{__('web.invoice_no')}}</th>
                                    <th style="text-align: right; background-color: #5867dd !important; color: white;">{{__('web.invoice_date')}}</th>
                                    <th style="text-align: right; background-color: #5867dd !important; color: white;">{{__('web.invoice_amount')}}</th>
                                    <th style="text-align: right; background-color: #5867dd !important; color: white;">{{__('web.payment_amount')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: left;">
                                        {{$invoice->invoice_no}}
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
                        <img src="{{asset('backend/assets/images/phemo_white_t.png')}}" width="80">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>