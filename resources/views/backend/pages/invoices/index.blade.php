@if (is_permitted('invoice_view'))
@extends('backend.layouts.master')
@section('content')
    
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.invoices')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="m-content">
    @if (is_permitted('invoice_create'))
    <div class="row mb-3">
        <div class="col">
            <a href="{{route('invoices.create')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right">
                <span>
                    <i class="la la-plus"></i>
                    <span>{{__('web.new_invoice')}}</span>
                </span>
            </a>
        </div>
    </div>
    @endif
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.invoice_count')}}
                            </h4><br>
                            <h3 class="m--font-primary" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{-- @php
                                    $count = 0;
                                    $overdue_invoices = \App\Invoice::where(['account_id' => Auth::user()->account_id, ['due_date', '<', strtotime(date('d-m-Y'))]])->get();
                                    foreach ($overdue_invoices as $ov) {
                                        if ($ov->status == 'unpaid' || $ov->status == 'partially_paid') {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                @endphp --}}
                                {{\App\Invoice::where('account_id', Auth::user()->account_id)->count()}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.total_amount')}}
                            </h4><br>
                            <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                @php
                                    $total = \App\Invoice::where('account_id', Auth::user()->account_id)->sum('grand_total');
                                    $unpaid = unpaid_invoice_amount();
                                    $paid = $total - $unpaid;
                                @endphp
                                {{get_config('currency')}} {{number_format($total, 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.paid_amount')}}
                            </h4><br>
                            <h3 class="m--font-success" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{-- {{ \App\Invoice::where('account_id', Auth::user()->account_id)->where('status', 'unpaid')->orWhere('status', 'partially_paid')->count() }} --}}
                                {{get_config('currency')}} {{number_format($paid, 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.unpaid_amount')}}
                            </h4><br>
                            <h3 class="m--font-danger" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                {{get_config('currency')}} {{number_format(unpaid_invoice_amount(), 2, '.', ',')}}
                            </h3>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head" style="border: none;">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text" onclick="toggleSection('quotes-filter')" style="cursor: pointer;">
                        <span class="quotes-filter"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.filter_options')}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body quotes-filter m--hide">
            <div class="row mb-3">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group m-form__group" id="">
                        <label>
                            {{__('web.customer')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="customer_id" id="customer_id"
                            data-live-search="true">
                            <option value="">{{__('web.all')}}</option>
                            @foreach (\App\Customer::where('account_id', Auth::user()->account_id)->get() as $customer)
                            <option value="{{$customer->id}}">
                                {{$customer->customer_type == 'company' ? $customer->company_name : $customer->customer_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group m-form__group" id="">
                        <label>
                            {{__('web.status')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="status" id="status">
                            <option value="">{{__('web.all')}}</option>
                            <option value="unpaid">{{__('web.unpaid')}}</option>
                            <option value="partially_paid">{{__('web.partially_paid')}}</option>
                            <option value="paid">{{__('web.paid')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group m-form__group" id="">
                        <label>
                            {{__('web.issue_date')}}
                        </label>
                        <div class="input-group pull-right" id="issue_date_range">
                            <input type="text" class="form-control m-input m-input--pill" name="issue_date" id="issue_date"
                            readonly placeholder="{{__('web.select_issue_date_range')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group m-form__group" id="">
                        <label>
                            {{__('web.due_date')}}
                        </label>
                        <div class="input-group pull-right" id="due_date_range">
                            <input type="text" class="form-control m-input m-input--pill" name="due_date" id="due_date"
                            readonly placeholder="{{__('web.select_due_date_range')}}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                        id="invoice-filter-button">
                        <span>
                            <i class="la la-filter"></i>
                            <span>{{__('web.apply_filter')}}</span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                        id="reset-button" onclick="location.reload();">
                        <span>
                            <i class="la la-undo"></i>
                            <span>{{__('web.reset')}}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile" id="invoice-list">
        @include('backend.pages.invoices.list')
    </div>
</div>

@endsection

@section('script')
    <script>
        var invoiceFilterRoute = '{{route('invoices.filter')}}';
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
            $("#due_date_range").daterangepicker({
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
                $("#due_date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $('#issue_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#issue_date').val('');
            });
            $('#due_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#due_date').val('');
            });
            $('#invoice-filter-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'customer_id': $('#customer_id').val(),
                    'issue_date': $('#issue_date').val(),
                    'due_date': $('#due_date').val(),
                    'status': $('#status').val()
                };
                $.post(invoiceFilterRoute, filterParams, function(response) {
                    $('#invoice-list').html(response);
                    $('#invoice-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#invoice-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
        });
        function toggleSection(section) {
            if ($('div.' + section).hasClass('m--hide')) {
                $('div.' + section).removeClass('m--hide');
                $('span.'+ section).html('<i class="la la-minus"></i>');
            } else {
                $('div.' + section).addClass('m--hide');
                $('span.'+ section).html('<i class="la la-plus"></i>');
            }            
        }
    </script>
@endsection
@endif