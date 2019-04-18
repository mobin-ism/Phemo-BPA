@if (is_permitted('expense_view'))
@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.expenses')}}</h3>
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
        @if (is_permitted('expense_create'))
        <div class="row mb-3">
            <div class="col">
                <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right"
                    onclick="presentModal('{{route('expenses.create')}}', '{{__('web.new_expense')}}')">
                    <span>
                        <i class="la la-plus"></i>
                        <span>{{__('web.new_expense')}}</span>
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
                                    {{__('web.this_month')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.expenses_this_month')}}
                                </span>
                                <h3 class="m--font-info" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    @php
                                        $result = get_expense('month');
                                    @endphp
                                    {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
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
                                    {{__('web.previous_month')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.expenses_previous_month')}}
                                </span>
                                <h3 class="m--font-warning" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    @php
                                        $result = get_expense('-1month');
                                    @endphp
                                    {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
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
                                    {{__('web.this_year')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.expenses_this_year')}}
                                </span>
                                <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    @php
                                        $result = get_expense('year');
                                    @endphp
                                    {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
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
                                    {{__('web.total_expense')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.expenses_since_beginning')}}
                                </span>
                                <h3 class="m--font-primary" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    @php
                                        $result = \App\Expense::where('account_id', Auth::user()->account_id)->sum('total');
                                    @endphp
                                    {{get_config('currency')}} {{number_format($result, 2, '.', ',')}}
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
                        <h3 class="m-portlet__head-text" onclick="toggleSection('expense-filter')" style="cursor: pointer;">
                            <span class="expense-filter"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.filter_options')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body expense-filter m--hide">
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.expense_type')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="expense_type_id" id="expense_type_id"
                                data-live-search="true">
                                <option value="">{{__('web.all')}}</option>
                                @foreach (\App\ExpenseType::where('account_id', Auth::user()->account_id)->get() as $type)
                                <option value="{{$type->id}}">
                                    {{$type->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.date')}}
                            </label>
                            <div class="input-group pull-right" id="date_range">
                                <input type="text" class="form-control m-input m-input--pill" name="date" id="date"
                                readonly placeholder="{{__('web.select_date_range')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mt-4">
                        <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            id="expense-filter-button">
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
        <div class="m-portlet m-portlet--mobile" id="expenses-list">
            @include('backend.pages.expenses.list')
        </div>
     </div>

@endsection


@section('script')
    <script>
        var expenseFilterRoute = '{{route('expenses.filter')}}';
        $(document).ready(function() {
            var a = moment().subtract(29, "days"),
                t = moment();
            $("#date_range").daterangepicker({
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
                $("#date_range .form-control").val(a.format("DD/MM/YYYY") + " - " + t.format("DD/MM/YYYY"))
            });
            $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#date').val('');
            });
            $('#expense-filter-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'date': $('#date').val(),
                    'expense_type_id': $('#expense_type_id').val()
                };
                $.post(expenseFilterRoute, filterParams, function(response) {
                    $('#expenses-list').html(response);
                    $('#expense-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#expense-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
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