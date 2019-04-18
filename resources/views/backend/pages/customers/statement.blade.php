@php
    $grand_total = 0.0;
    $total_payment = 0.0;
    $hasDue = false;
    $due = 0.0;
    foreach ($invoices as $invoice) {
        $paid = \App\Payment::where('invoice_id', $invoice->id)->sum('amount');
        $total_payment += $paid;
        $grand_total += $invoice->grand_total;
    }
    if ($total_payment < $grand_total) {
        $hasDue = true;
        $due = $grand_total - $total_payment;
    }
@endphp

<div class="row mb-4 text-right">
    <div class="col">
        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
            onclick="printCustomerStatement()">
            <span>
                <i class="la la-print"></i>
                <span>{{__('web.print')}}</span>
            </span>
        </a>
        <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
            id="statement-email-button">
            <span>
                <i class="la la-send"></i>
                <span>{{__('web.email_customer')}}</span>
            </span>
        </a>
    </div>
</div>
<div class="row mb-3 text-center">
    <div class="col">
        <div class="alert m-alert--default" role="alert">
            <strong>
                Showing {{$statement->status}} invoices with due dates between {{get_formatted_date_from_timestamp($statement->start)}} and
                {{get_formatted_date_from_timestamp($statement->end)}}
            </strong>
        </div>
    </div>
</div>
<div class="row">
    <div class="col" id="statement-portlet">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <div class="row" style="margin-bottom: 3rem;">
                    <div class="col-lg-6 col-md-6">
                        <h3>{{__('web.statement')}}</h3>
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
                                @if($hasDue)
                                <tr>
                                    <th style="background-color: {{get_config('invoice_color_1')}} !important; color: white;">{{__('web.amount_due')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_1')}} !important; color: white;">
                                        {{get_config('currency')}} {{number_format($due, 2, '.', ',')}}
                                    </th>
                                </tr>
                                @endif
                                @if(!($hasDue))
                                <tr>
                                    <th style="background-color: {{get_config('invoice_color_1')}} !important; color: white;">{{__('web.amount_paid')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_1')}} !important; color: white;">
                                        {{get_config('currency')}} {{number_format($total_payment, 2, '.', ',')}}
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
                                    <th style="text-align: left; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.invoice_no')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.issue_date')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.due_date')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.amount')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.total_paid')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.amount_due')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                @php
                                    $paid = \App\Payment::where('invoice_id', $invoice->id)->sum('amount');
                                    $unpaid = $invoice->grand_total - $paid;
                                @endphp
                                <tr>
                                    <td>{{get_config('invoice_prefix')}}-{{$invoice->invoice_no}}</td>
                                    <td style="text-align: right;">{{get_formatted_date_from_timestamp($invoice->issue_date)}}</td>
                                    <td style="text-align: right;">{{get_formatted_date_from_timestamp($invoice->due_date)}}</td>
                                    <td style="text-align: right;">{{number_format($invoice->grand_total, 2, '.', ',')}}</td>
                                    <td style="text-align: right;">{{number_format($paid, 2, '.', ',')}}</td>
                                    <td style="text-align: right;">{{number_format($unpaid, 2, '.', ',')}}</td>
                                </tr>
                                @endforeach
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
                                    <th style="text-align: left; background-color: {{get_config('invoice_color_2')}} !important; color: white;">{{__('web.summary')}}</th>
                                    <th style="text-align: right; background-color: {{get_config('invoice_color_2')}} !important; color: white;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">{{__('web.total_amount')}}</td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($grand_total, 2, '.', ',')}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">{{__('web.amount_paid')}}</td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($total_payment, 2, '.', ',')}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 400; text-align: left;">{{__('web.amount_due')}}</td>
                                    <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($due, 2, '.', ',')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <p><img src="{{asset('public/backend/assets/images/phemo_white_t.png')}}" width="80"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var statementEmailRoute = '{{route('customers.email_statement', $statement->id)}}';
    $(document).ready(function() {
        $('#statement-email-button').on('click', function() {
            $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
            $.get(statementEmailRoute, function(response) {
                notify('Email to the customer was sent successfully', 'success');
                console.log(response);
                $('#statement-email-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
            }).fail(function(response) {
                console.log(response);
                $('#statement-email-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
            });
        });
    });
    function printCustomerStatement() {
        $('#statement-portlet').printThis({
            importStyle: true,
            pageTitle: '{{$statement->code}}',
            removeInline: false
        });
    }
</script>