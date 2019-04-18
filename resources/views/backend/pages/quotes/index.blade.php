@if(is_permitted('quote_view'))
@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.quotes')}}</h3>
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
        @if(is_permitted('quote_create'))
        <div class="row mb-3">
            <div class="col">
                <a href="{{route('quotes.create')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right">
                    <span>
                        <i class="la la-plus"></i>
                        <span>{{__('web.new_quote')}}</span>
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
                                    {{__('web.active_quotations')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.currently_active')}}
                                </span>
                                <h3 class="m--font-primary" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    {{ \App\Quote::where(['account_id' => Auth::user()->account_id, 'status' => 'active'])->count() }}
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
                                    {{__('web.new_quotations')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.currently_pending')}}
                                </span>
                                <h3 class="m--font-warning" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    {{ \App\Quote::where(['account_id' => Auth::user()->account_id, 'status' => 'pending'])->count() }}
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
                                    {{__('web.approved_quotations')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.total_approved')}}
                                </span>
                                <h3 class="m--font-success" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    {{ \App\Quote::where(['account_id' => Auth::user()->account_id, 'status' => 'invoiced'])->count() }}
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
                                    {{__('web.quotation_amount')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.total_amount')}}
                                </span>
                                <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    {{get_config('currency')}} {{number_format(\App\Quote::where('account_id', Auth::user()->account_id)->sum('grand_total'), 2, '.', ',')}}
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
                                <option value="pending">{{__('web.pending')}}</option>
                                <option value="active">{{__('web.active')}}</option>
                                <option value="invoiced">{{__('web.invoiced')}}</option>
                                <option value="expired">{{__('web.expired')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.employee')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="employee_id" id="employee_id"
                                data-live-search="true">
                                <option value="">{{__('web.all')}}</option>
                                @foreach (\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                                <option value="{{$employee->id}}">
                                    {{$employee->user->name}}
                                </option>
                                @endforeach
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
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.expiry_date')}}
                            </label>
                            <div class="input-group pull-right" id="expiry_date_range">
                                <input type="text" class="form-control m-input m-input--pill" name="expiry_date" id="expiry_date"
                                readonly placeholder="{{__('web.select_expiry_date_range')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mt-4">
                        <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            id="quote-filter-button">
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
        <div class="m-portlet m-portlet--mobile" id="quote-list">
            @include('backend.pages.quotes.list')
        </div>
    </div>

@endsection

@section('script')
    <script>
        var quoteFilterRoute = '{{route('quotes.filter')}}';
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
            $('#issue_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#issue_date').val('');
            });
            $('#expiry_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#expiry_date').val('');
            });
            $('#quote-filter-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'customer_id': $('#customer_id').val(),
                    'employee_id': $('#employee_id').val(),
                    'issue_date': $('#issue_date').val(),
                    'expiry_date': $('#expiry_date').val(),
                    'status': $('#status').val()
                };
                $.post(quoteFilterRoute, filterParams, function(response) {
                    $('#quote-list').html(response);
                    $('#quote-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#quote-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
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