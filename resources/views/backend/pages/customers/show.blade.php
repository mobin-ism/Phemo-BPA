@extends('backend.layouts.master')
@section('content')
@php
    $total_invoiced_amount = \App\Invoice::where('customer_id', $customer->id)->sum('grand_total');
    $customer_invoices = \App\Invoice::where('customer_id', $customer->id)->get();
    $paid = 0.0;
    foreach ($customer_invoices as $invoice) {
        $payment = \App\Payment::where('invoice_id', $invoice->id)->sum('amount');
        $paid += $payment;
    }
    $unpaid = $total_invoiced_amount - $paid;
@endphp
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.customer_profile')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    @if (is_permitted('customer_view'))
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('customers.company_list')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.company')}}</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('customers.individual_list')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.individual')}}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{profile_photo('customer', $customer->id)}}" />
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#" class="m-link" data-container="body" data-toggle="m-tooltip" data-placement="top"
                                    data-original-title="{{__('web.change_profile_picture')}}"
                                        onclick="presentModal('{{route('customers.photo', $customer->id)}}', '{{__('web.change_profile_picture')}}')">
                                    <i class="la la-edit"></i>
                                </a>
                            </div>
                            @php
                                $name = $customer->customer_type == 'company' ? $customer->primary_contact : $customer->customer_name;    
                            @endphp
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name">{{$name}}</span>
                                @if ($customer->customer_type == 'company')
                                    <span class="m-card-profile__email">
                                        {{$customer->company_name}}
                                    </span>
                                @endif
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{$customer->facebook}}" class="m-link">
                                            <i class="socicon-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$customer->twitter}}" class="m-link">
                                            <i class="socicon-twitter"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$customer->linkedin}}" class="m-link">
                                            <i class="socicon-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$customer->skype}}" class="m-link">
                                            <i class="socicon-skype"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body-separator"></div>
                        <div class="m-widget1 m-widget1--paddingless">
                            <div id="customer_invoice_payment_profile_morris" style="height:200px;"></div>
                        </div>
                        @if (is_permitted('customer_delete'))
                        <div class="m-portlet__body-separator"></div>
                        <div class="m-widget1 m-widget1--paddingless">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('web.active')}}</h3>
                                        <span class="m-widget1__desc">{{__('web.customer_status')}}</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand">
                                            <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                <label>
                                                    <input type="checkbox" name="status" value="1" id="status"
                                                    @if ($customer->status == 1) checked @endif>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-user" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.basic_information')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                        <i class="flaticon-placeholder-2" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.address')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_4" role="tab">
                                        <i class="flaticon-interface" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.invoice')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_5" role="tab">
                                        <i class="flaticon-interface-10" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.quotes')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_6" role="tab">
                                        <i class="flaticon-list-2" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.statement')}}"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        @if ($customer->customer_type == 'company')
                                        <div class="mb-4">
                                            <span>{{__('web.company_name')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->company_name}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.primary_contact')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->primary_contact}}</span>
                                        </div>
                                        @endif
                                        @if ($customer->customer_type == 'individual')
                                        <div class="mb-4">
                                            <span>{{__('web.customer_name')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->customer_name}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.surname')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->surname}}</span>
                                        </div>
                                        @endif
                                        <div class="mb-4">
                                            <span>{{__('web.email')}}</span><br>
                                            <a href="mailto:{{$customer->email}}" class="m-link">
                                                <span class="m--font-bolder">{{$customer->email}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.telephone')}}</span><br>
                                            <a href="tel:{{$customer->telephone}}" class="m-link">
                                                <span class="m--font-bolder">{{$customer->telephone}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.fax')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->fax}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.vat_no')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->vat_no}}</span>
                                        </div>
                                        @if ($customer->customer_type == 'individual')
                                        <div class="mb-4">
                                            <span>{{__('web.id_no')}} / {{__('web.passport_no')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->id_number}}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div>
                                            <span>{{__('web.website')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->website}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_2">
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.address_line_1')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->address_line_1}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.address_line_2')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->address_line_2}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.city')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->city}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.zip_code')}}</span><br>
                                            <span class="m--font-bolder">{{$customer->zip_code}}</span>
                                        </div>
                                        <div>
                                            <span>{{__('web.country')}}</span><br>
                                            <span class="m--font-bolder">
                                                @if ($customer->country_id != null) {{$customer->country->name}} @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_4">
                            <div class="m-portlet__body">
                                <div class="m-portlet m-portlet--mobile">
                                    <div class="m-portlet__body">
                                        <div class="row mb-5">
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="invoice_status" id="invoice-status">
                                                        <option value="">{{__('web.all')}}</option>
                                                        <option value="unpaid">{{__('web.unpaid')}}</option>
                                                        <option value="partially_paid">{{__('web.partially_paid')}}</option>
                                                        <option value="paid">{{__('web.paid')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <div class="input-group pull-right" id="issue_date_range_invoice">
                                                        <input type="text" class="form-control m-input m-input--pill" name="issue_date_invoice" id="issue_date_invoice"
                                                        readonly placeholder="{{__('web.select_issue_date_range')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <div class="input-group pull-right" id="due_date_range_invoice">
                                                        <input type="text" class="form-control m-input m-input--pill" name="due_date_invoice" id="due_date_invoice"
                                                        readonly placeholder="{{__('web.select_due_date_range')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="button" class="btn btn-outline-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                                    id="customer-invoice-filter">
                                                    <span>
                                                        <i class="la la-filter"></i>
                                                        <span>{{__('web.apply_filter')}}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col" id="customer-invoice-list">
                                                @include('backend.pages.customers.invoices')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_5">
                            <div class="m-portlet__body">
                                <div class="m-portlet m-portlet--mobile">
                                    <div class="m-portlet__body">
                                        <div class="row mb-5">
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="status" id="status">
                                                        <option value="">{{__('web.all')}}</option>
                                                        <option value="pending">{{__('web.pending')}}</option>
                                                        <option value="active">{{__('web.active')}}</option>
                                                        <option value="invoiced">{{__('web.invoiced')}}</option>
                                                        <option value="expired">{{__('web.expired')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <div class="input-group pull-right" id="issue_date_range">
                                                        <input type="text" class="form-control m-input m-input--pill" name="issue_date" id="issue_date"
                                                        readonly placeholder="{{__('web.select_issue_date_range')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <div class="input-group pull-right" id="expiry_date_range">
                                                        <input type="text" class="form-control m-input m-input--pill" name="expiry_date" id="expiry_date"
                                                        readonly placeholder="{{__('web.select_expiry_date_range')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="button" class="btn btn-outline-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                                    id="customer-quote-filter">
                                                    <span>
                                                        <i class="la la-filter"></i>
                                                        <span>{{__('web.apply_filter')}}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col" id="customer-quotes-list">
                                                @include('backend.pages.customers.quotes')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_6">
                            <div class="m-portlet__body">
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group m-form__group" id="">
                                            <label for="statement_date">{{__('web.select_date_range')}}</label>
                                            <div class="input-group pull-right" id="statement_date_range">
                                                <input type="text" class="form-control m-input m-input--pill" name="statement_date_range" id="statement_date"
                                                readonly placeholder="{{__('web.date_range')}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group m-form__group" id="">
                                            <label for="invoice_status">{{__('web.invoice_status')}}</label>
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" 
                                                name="statement_invoice_status" id="invoice_status">
                                                <option value="all">{{__('web.all')}}</option>
                                                <option value="unpaid">{{__('web.unpaid')}}</option>
                                                <option value="paid">{{__('web.paid')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col">
                                        <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--air"
                                            id="customer-statement-generate">
                                            <span>
                                                <span>{{__('web.generate_statement')}}</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div id="statement-holder">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var customerQuoteFilterRoute = '{{route('customers.filter_quotes')}}';
        var customerInvoiceFilterRoute = '{{route('customers.filter_invoices')}}';
        var customerStatusChangeRoute = '{{route('customers.change_status')}}';
        var customerStatementGenerateRoute = '{{route('customers.generate_statement')}}';
        var MorrisChartsCustomerProfileInvoicePayments = {
            init: function() {
                new Morris.Donut({
                    element: "customer_invoice_payment_profile_morris",
                    data: [{
                        label: "{{__('web.invoiced')}}",
                        value: "{{$total_invoiced_amount}}"
                    }, {
                        label: "{{__('web.paid')}}",
                        value: "{{$paid}}"
                    }, {
                        label: "{{__('web.due')}}",
                        value: "{{$unpaid}}"
                    }]
                })
            }
        };
        $(document).ready(function() {
            var a = moment().subtract(29, "days"),
                t = moment();
            $("#issue_date_range").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#issue_date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $("#expiry_date_range").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#expiry_date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $("#issue_date_range_invoice").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#issue_date_range_invoice .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $("#due_date_range_invoice").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#due_date_range_invoice .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $("#statement_date_range").daterangepicker({
                buttonClasses: "m-btn btn",
                applyClass: "btn-primary",
                cancelClass: "btn-secondary",
                startDate: a,
                endDate: t,
                ranges: {
                    "{{__('web.today')}}": [moment(), moment()],
                    "{{__('web.yesterday')}}": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "{{__('web.last_7_days')}}": [moment().subtract(6, "days"), moment()],
                    "{{__('web.last_30_days')}}": [moment().subtract(29, "days"), moment()],
                    "{{__('web.this_month')}}": [moment().startOf("month"), moment().endOf("month")],
                    "{{__('web.last_month')}}": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
                }
            }, function(a, t, n) {
                $("#statement_date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $('#issue_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#issue_date').val('');
            });
            $('#expiry_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#expiry_date').val('');
            });
            $('#issue_date_range_invoice').on('cancel.daterangepicker', function(ev, picker) {
                $('#issue_date_invoice').val('');
            });
            $('#due_date_range_invoice').on('cancel.daterangepicker', function(ev, picker) {
                $('#due_date_invoice').val('');
            });
            $('#statement_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#statement_date').val('');
            });
            $('#customer-quote-filter').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'customer_id': '{{$customer->id}}',
                    'issue_date': $('#issue_date').val(),
                    'expiry_date': $('#expiry_date').val(),
                    'status': $('#status').val()
                };
                $.post(customerQuoteFilterRoute, filterParams, function(response) {
                    $('#customer-quotes-list').html(response);
                    $('#customer-quote-filter').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#customer-quote-filter').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
            $('#customer-invoice-filter').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'customer_id': '{{$customer->id}}',
                    'issue_date': $('#issue_date_invoice').val(),
                    'due_date': $('#due_date_invoice').val(),
                    'status': $('#invoice-status').val()
                };
                $.post(customerInvoiceFilterRoute, filterParams, function(response) {
                    $('#customer-invoice-list').html(response);
                    $('#customer-invoice-filter').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#customer-invoice-filter').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
            $('input[type=checkbox]').change(function() {
                if ($(this).is(':checked')) {
                    $(this).val('1');
                } else {
                    $(this).val('0');
                }
                var postParams = {
                    '_token': '{{ csrf_token() }}',
                    'id': '{{$customer->id}}',
                    'status': $('#status').val()
                };
                $.post(customerStatusChangeRoute, postParams, function(response) {
                    notify('Customer status was changed successfully', 'success');
                }).fail(function(response) {
                    console.log(response);
                });
            });
            $('#customer-statement-generate').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'customer_id': '{{$customer->id}}',
                    'statement_date_range': $('#statement_date').val(),
                    'status': $('#invoice_status').val()
                };
                $.post(customerStatementGenerateRoute, filterParams, function(response) {
                    $('#statement-holder').html(response);
                    $('#customer-statement-generate').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#customer-statement-generate').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
            MorrisChartsCustomerProfileInvoicePayments.init();
        });
    </script>
@endsection