@extends('backend.layouts.master')
@section('content')
@if(Auth::user()->role == 'superadmin')
    @include('backend.superadmin.dashboard')
@endif
@if(Auth::user()->role == 'customer')
    @include('backend.customers.dashboard')
@endif
@if(Auth::user()->role == 'vendor')
    @include('backend.vendors.dashboard')
@endif
@if (Auth::user()->role == 'admin')   
<div class="row">
    <div class="col-xl-4">
        <!--begin:: Widgets/Activity-->
        <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text m--font-light">
                            {{__('web.customers')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-widget17">
                    <div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
                        <div class="m-widget17__chart" style="height:320px;">
                            <canvas id="m_chart_activities"></canvas>
                        </div>
                    </div>
                    <div class="m-widget17__stats">
                        <div class="m-widget17__items m-widget17__items-col1">
                            <div class="m-widget17__item">
                                <span class="m-widget17__icon">
                                    <i class="flaticon-user-ok m--font-brand"></i>
                                </span>
                                <span class="m-widget17__subtitle">
                                    {{__('web.total')}}
                                </span>
                                <span class="m-widget17__desc">
                                    <h5>{{\App\Customer::where('account_id', Auth::user()->account_id)->count()}}</h5>
                                </span>
                            </div>
                            <div class="m-widget17__item">
                                <span class="m-widget17__icon">
                                    <i class="flaticon-like m--font-info"></i>
                                </span>
                                <span class="m-widget17__subtitle">
                                        {{__('web.companies')}}
                                </span>
                                <span class="m-widget17__desc">
                                    <h5>{{\App\Customer::where(['account_id' => Auth::user()->account_id, 'customer_type' => 'company'])->count()}}</h5>
                                </span>
                            </div>
                        </div>
                        <div class="m-widget17__items m-widget17__items-col2">
                            <div class="m-widget17__item">
                                <span class="m-widget17__icon">
                                    <i class="flaticon-user m--font-primary"></i>
                                </span>
                                <span class="m-widget17__subtitle">
                                        {{__('web.individuals')}}
                                </span>
                                <span class="m-widget17__desc">
                                    <h5>{{\App\Customer::where(['account_id' => Auth::user()->account_id, 'customer_type' => 'individual'])->count()}}</h5>
                                </span>
                            </div>
                            <div class="m-widget17__item">
                                <span class="m-widget17__icon">
                                    <i class="flaticon-car m--font-success"></i>
                                </span>
                                <span class="m-widget17__subtitle">
                                        {{__('web.active')}}
                                </span>
                                <span class="m-widget17__desc">
                                    <h5>{{\App\Customer::where(['account_id' => Auth::user()->account_id, 'status' => 1])->count()}}</h5>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end:: Widgets/Activity-->
    </div>
    <div class="col-xl-4">

        <!--begin:: Widgets/Inbound Bandwidth-->
        <div class="m-portlet m-portlet--bordered-semi m-portlet--half-height m-portlet--fit " style="min-height: 300px">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('web.expenses')}} ({{date('Y')}})
                        </h3></p>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin::Widget5-->
                <div class="m-widget20">
                    <div class="m-widget20__number m--font-danger">
                        @php
                            $result = get_expense('year');
                        @endphp
                        {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
                    </div>
                    <div class="m-widget20__chart" style="height:160px;">
                        <canvas id="m_chart_bandwidth1"></canvas>
                    </div>
                </div>

                <!--end::Widget 5-->
            </div>
        </div>

        <!--end:: Widgets/Inbound Bandwidth-->
        <div class="m--space-30"></div>

        <!--begin:: Widgets/Outbound Bandwidth-->
        <div class="m-portlet m-portlet--bordered-semi m-portlet--half-height m-portlet--fit " style="min-height: 300px">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('web.payments')}} ({{date('Y')}})
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin::Widget5-->
                <div class="m-widget20">
                    <div class="m-widget20__number m--font-success">
                        @php
                            $result = payments_of_year('invoice');
                        @endphp
                        {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
                    </div>
                    <div class="m-widget20__chart" style="height:160px;">
                        <canvas id="m_chart_bandwidth2"></canvas>
                    </div>
                </div>

                <!--end::Widget 5-->
            </div>
        </div>

        <!--end:: Widgets/Outbound Bandwidth-->
    </div>
    <div class="col-xl-4">
        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('web.invoices')}} ({{__('web.due_this_month')}})
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                @php
                    $invoices = \App\Invoice::where('account_id', Auth::user()->account_id)->orderBy('due_date', 'desc')->take(7)->get();
                @endphp
                <div class="m-widget4">
                    @foreach ($invoices as $invoice)
                    @php
                        if (date('m-Y') != date('m-Y', $invoice->due_date)) {
                            continue;
                        }
                        $isOverdue = false;
                        $customer = \App\Customer::where('id', $invoice->customer_id)->first();
                        $name = ($customer->customer_type == 'company') ? $customer->company_name : $customer->customer_name;
                        if ($invoice->due_date < strtotime(date('d-m-Y')) && ($invoice->status == 'unpaid' || $invoice->status == 'partially_paid')) {
                            $isOverdue = true;
                            $today = date('d-m-Y');
                            $due_date = date('d-m-Y', $invoice->due_date);
                            $today = new DateTime($today);
                            $due_date = new DateTime($due_date);
                            $diff = $today->diff($due_date);
                        }
                    @endphp
                    <div class="m-widget4__item">
                        <div class="m-widget4__info">
                            <span class="m-widget4__title">
                                <a href="{{route('invoices.show', $invoice)}}" class="m-link">
                                    {{get_config('invoice_prefix')}}-{{$invoice->invoice_no}}
                                </a>
                            </span><br>
                            <span class="m-widget4__sub">
                                @if ($isOverdue)
                                <b class="m--font-danger">Due {{$diff->d}} days ago</b>
                                @else
                                {{__('web.due_date')}}  <b>{{get_formatted_date_from_timestamp($invoice->due_date)}}</b>
                                @endif
                            </span>
                        </div>
                        <span class="m-widget4__ext">
                            <span class="m-widget4__number m--font-primary">
                                {{number_format($invoice->grand_total, 2, '.', ',')}}
                            </span>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="m-portlet">
    <div class="m-portlet__body m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-12 col-xl-4">

                <!--begin:: Widgets/Stats2-1 -->
                <div class="m-widget1">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    {{__('web.invoiced_amount')}}
                                </h3>
                                <span class="m-widget1__desc">
                                    {{__('web.for_this_month')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-brand">
                                    @php
                                        $invoices = \App\Invoice::where('account_id', Auth::user()->account_id)->get();
                                        $total = 0.0;
                                        foreach ($invoices as $invoice) {
                                            if (date('m') == date('m', $invoice->due_date) && date('Y') == date('Y', $invoice->due_date)) {
                                                $total += $invoice->grand_total;
                                            }
                                        }
                                    @endphp
                                    {{get_config('currency')}} {{number_format($total, 2, '.', ',')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    {{__('web.amount_paid')}}
                                </h3>
                                <span class="m-widget1__desc">
                                        {{__('web.for_this_month')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-success">
                                    @php
                                        $paid = payments_of_month('invoice', date('m'));
                                    @endphp
                                    {{get_config('currency')}} {{number_format($paid, 2, '.', ',')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    {{__('web.amount_due')}}
                                </h3>
                                <span class="m-widget1__desc">
                                        {{__('web.for_this_month')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">
                                    @php
                                        $due = $total - $paid;
                                    @endphp
                                    {{get_config('currency')}} {{number_format($due, 2, '.', ',')}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Stats2-1 -->
            </div>
            <div class="col-md-12 col-lg-12 col-xl-4">

                <!--begin:: Widgets/Stats2-2 -->
                <div class="m-widget1">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                        {{__('web.total_bills')}}
                                </h3>
                                <span class="m-widget1__desc">{{__('web.since_beginning')}}</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-accent">
                                    @php
                                        $bills = \App\Bill::where('account_id', Auth::user()->account_id)->get();
                                        $total_bills = 0.0;
                                        foreach ($bills as $bill) {
                                            $total_bills += $bill->grand_total;
                                        }
                                    @endphp
                                    {{get_config('currency')}} {{number_format($total_bills, 2, '.', ',')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">{{__('web.bills_paid')}}</h3>
                                <span class="m-widget1__desc">
                                        {{__('web.since_beginning')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-success">
                                    @php
                                        $bill_payments = \App\Payment::where(['account_id' => Auth::user()->account_id, 'type' => 'bill'])->get();
                                        $paid_bills = 0.0;
                                        foreach ($bill_payments as $bill_payment) {
                                            $paid_bills += $bill_payment->amount;
                                        }
                                    @endphp
                                    {{get_config('currency')}} {{number_format($paid_bills, 2, '.', ',')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">{{__('web.bills_due')}}</h3>
                                <span class="m-widget1__desc">
                                        {{__('web.since_beginning')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">
                                    @php
                                        $due_bills = $total_bills - $paid_bills;
                                    @endphp
                                    {{get_config('currency')}} {{number_format($due_bills, 2, '.', ',')}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin:: Widgets/Stats2-2 -->
            </div>
            <div class="col-md-12 col-lg-12 col-xl-4">

                <!--begin:: Widgets/Stats2-3 -->
                <div class="m-widget1">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    {{__('web.tickets')}}
                                </h3>
                                <span class="m-widget1__desc">
                                        {{__('web.since_beginning')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-primary">
                                    {{\App\Ticket::where('account_id', Auth::user()->account_id)->count()}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">{{__('web.pending_tickets')}}</h3>
                                <span class="m-widget1__desc">
                                        {{__('web.since_beginning')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-warning">
                                    {{\App\Ticket::where(['account_id' => Auth::user()->account_id, 'resolve_status' => 'pending'])->count()}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">{{__('web.resolved_tickets')}}</h3>
                                <span class="m-widget1__desc">
                                        {{__('web.since_beginning')}}
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-success">
                                    {{\App\Ticket::where(['account_id' => Auth::user()->account_id, 'resolve_status' => 'resolved'])->count()}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin:: Widgets/Stats2-3 -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            if (0 != $("#m_chart_activities").length) {
                var e = document.getElementById("m_chart_activities").getContext("2d"),
                    t = e.createLinearGradient(0, 0, 0, 240);
                t.addColorStop(0, Chart.helpers.color("#e14c86").alpha(1).rgbString()), t.addColorStop(1, Chart.helpers.color("#e14c86").alpha(.3).rgbString());
                var a = {
                    type: "line",
                    data: {
                        labels: ["{{__('web.january')}}", "{{__('web.february')}}", "{{__('web.march')}}", "{{__('web.april')}}", "{{__('web.may')}}", 
                        "{{__('web.june')}}", "{{__('web.july')}}", "{{__('web.august')}}", "{{__('web.september')}}", "{{__('web.october')}}", "{{__('web.november')}}",
                        "{{__('web.december')}}"],
                        datasets: [{
                            label: "{{__('web.customers')}}",
                            backgroundColor: t,
                            borderColor: "#e13a58",
                            pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointHoverBackgroundColor: mApp.getColor("light"),
                            pointHoverBorderColor: Chart.helpers.color("#ffffff").alpha(.1).rgbString(),
                            data: [
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '01')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '02')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '03')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '04')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '05')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '06')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '07')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '08')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '09')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '10')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '11')->count()}}", 
                                "{{\App\Customer::where('account_id', Auth::user()->account_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', '12')->count()}}"
                            ]
                        }]
                    },
                    options: {
                        title: {
                            display: !1
                        },
                        tooltips: {
                            mode: "nearest",
                            intersect: !1,
                            position: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        legend: {
                            display: !1
                        },
                        responsive: !0,
                        maintainAspectRatio: !1,
                        scales: {
                            xAxes: [{
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Month"
                                }
                            }],
                            yAxes: [{
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Value"
                                },
                                ticks: {
                                    beginAtZero: !0
                                }
                            }]
                        },
                        elements: {
                            line: {
                                tension: 1e-7
                            },
                            point: {
                                radius: 4,
                                borderWidth: 12
                            }
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 10,
                                bottom: 0
                            }
                        }
                    }
                };
                new Chart(e, a)
            }
            if (0 != $("#m_chart_bandwidth1").length) {
                var e = document.getElementById("m_chart_bandwidth1").getContext("2d"),
                    t = e.createLinearGradient(0, 0, 0, 240);
                t.addColorStop(0, Chart.helpers.color("#e14c86").alpha(1).rgbString()), t.addColorStop(1, Chart.helpers.color("#e14c86").alpha(.3).rgbString());
                var a = {
                    type: "line",
                    data: {
                        labels: ["{{__('web.january')}}", "{{__('web.february')}}", "{{__('web.march')}}", "{{__('web.april')}}", "{{__('web.may')}}", 
                        "{{__('web.june')}}", "{{__('web.july')}}", "{{__('web.august')}}", "{{__('web.september')}}", "{{__('web.october')}}", "{{__('web.november')}}",
                        "{{__('web.december')}}"],
                        datasets: [{
                            label: "{{__('web.expense')}}",
                            backgroundColor: t,
                            borderColor: mApp.getColor("danger"),
                            pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointHoverBackgroundColor: mApp.getColor("danger"),
                            pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                            data: [
                                "{{get_expense_of_month('01')}}",
                                "{{get_expense_of_month('02')}}",
                                "{{get_expense_of_month('03')}}",
                                "{{get_expense_of_month('04')}}",
                                "{{get_expense_of_month('05')}}",
                                "{{get_expense_of_month('06')}}",
                                "{{get_expense_of_month('07')}}",
                                "{{get_expense_of_month('08')}}",
                                "{{get_expense_of_month('09')}}",
                                "{{get_expense_of_month('10')}}",
                                "{{get_expense_of_month('11')}}",
                                "{{get_expense_of_month('12')}}"
                            ]
                        }]
                    },
                    options: {
                        title: {
                            display: !1
                        },
                        tooltips: {
                            mode: "nearest",
                            intersect: !1,
                            position: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        legend: {
                            display: !1
                        },
                        responsive: !0,
                        maintainAspectRatio: !1,
                        scales: {
                            xAxes: [{
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Month"
                                }
                            }],
                            yAxes: [{
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Value"
                                },
                                ticks: {
                                    beginAtZero: !0
                                }
                            }]
                        },
                        elements: {
                            line: {
                                tension: 1e-7
                            },
                            point: {
                                radius: 4,
                                borderWidth: 12
                            }
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 10,
                                bottom: 0
                            }
                        }
                    }
                };
                new Chart(e, a)
            }
            if (0 != $("#m_chart_bandwidth2").length) {
                var e = document.getElementById("m_chart_bandwidth2").getContext("2d"),
                    t = e.createLinearGradient(0, 0, 0, 240);
                t.addColorStop(0, Chart.helpers.color("#d1f1ec").alpha(1).rgbString()), t.addColorStop(1, Chart.helpers.color("#d1f1ec").alpha(.3).rgbString());
                var a = {
                    type: "line",
                    data: {
                        labels: ["{{__('web.january')}}", "{{__('web.february')}}", "{{__('web.march')}}", "{{__('web.april')}}", "{{__('web.may')}}", 
                        "{{__('web.june')}}", "{{__('web.july')}}", "{{__('web.august')}}", "{{__('web.september')}}", "{{__('web.october')}}", "{{__('web.november')}}",
                        "{{__('web.december')}}"],
                        datasets: [{
                            label: "{{__('web.payment')}}",
                            backgroundColor: t,
                            borderColor: mApp.getColor("success"),
                            pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                            pointHoverBackgroundColor: mApp.getColor("success"),
                            pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                            data: [
                                "{{payments_of_month('invoice','01')}}",
                                "{{payments_of_month('invoice','02')}}",
                                "{{payments_of_month('invoice','03')}}",
                                "{{payments_of_month('invoice','04')}}",
                                "{{payments_of_month('invoice','05')}}",
                                "{{payments_of_month('invoice','06')}}",
                                "{{payments_of_month('invoice','07')}}",
                                "{{payments_of_month('invoice','08')}}",
                                "{{payments_of_month('invoice','09')}}",
                                "{{payments_of_month('invoice','10')}}",
                                "{{payments_of_month('invoice','11')}}",
                                "{{payments_of_month('invoice','12')}}"
                            ]
                        }]
                    },
                    options: {
                        title: {
                            display: !1
                        },
                        tooltips: {
                            mode: "nearest",
                            intersect: !1,
                            position: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        legend: {
                            display: !1
                        },
                        responsive: !0,
                        maintainAspectRatio: !1,
                        scales: {
                            xAxes: [{
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Month"
                                }
                            }],
                            yAxes: [{
                                display: !1,
                                gridLines: !1,
                                scaleLabel: {
                                    display: !0,
                                    labelString: "Value"
                                },
                                ticks: {
                                    beginAtZero: !0
                                }
                            }]
                        },
                        elements: {
                            line: {
                                tension: 1e-7
                            },
                            point: {
                                radius: 4,
                                borderWidth: 12
                            }
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 10,
                                bottom: 0
                            }
                        }
                    }
                };
                new Chart(e, a)
            }
        });
    </script>
@endif
@endsection

