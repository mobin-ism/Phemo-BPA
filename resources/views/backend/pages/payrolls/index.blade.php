@if (is_permitted('payroll_view'))
@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.payrolls')}}</h3>
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
        @if (is_permitted('payroll_create'))
        <div class="row mb-3">
            <div class="col">
                <a href="{{route('payrolls.create')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right">
                    <span>
                        <i class="la la-plus"></i>
                        <span>{{__('web.new_payroll')}}</span>
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
                                    {{__('web.employees')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.total_employees')}}
                                </span>
                                <h3 class="m--font-info" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    {{\App\Employee::where('account_id', Auth::user()->account_id)->count()}}
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
                                    {{__('web.payslips')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.this_month')}}
                                </span>
                                <h3 class="m--font-warning" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    {{\App\Payroll::where(['account_id' => Auth::user()->account_id, 'month' => date('m')])->count()}}
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
                                    {{__('web.salary_paid')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.this_month')}}
                                </span>
                                <h3 class="m--font-brand" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    @php
                                        $result = \App\Payroll::where(['account_id' => Auth::user()->account_id, 'month' => date('m'), 'status' => 1])->sum('net_salary');
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
                                    {{__('web.salary_unpaid')}}
                                </h4><br>
                                <span class="m-widget24__desc">
                                    {{__('web.this_month')}}
                                </span>
                                <h3 class="m--font-primary" style="margin-left: 1.8rem; font-weight: 600; margin-top: 5px;">
                                    @php
                                        $result = \App\Payroll::where(['account_id' => Auth::user()->account_id, 'month' => date('m'), 'status' => 0])->sum('net_salary');
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
                        <h3 class="m-portlet__head-text" onclick="toggleSection('payroll-filter')" style="cursor: pointer;">
                            <span class="payroll-filter"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.filter_options')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body payroll-filter m--hide">
                <div class="row mb-3">
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.month')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="month" id="month">
                                <option value="01" <?php if (date('m') == '01') echo 'selected';?>>{{__('web.january')}}</option>
                                <option value="02" <?php if (date('m') == '02') echo 'selected';?>>{{__('web.february')}}</option>
                                <option value="03" <?php if (date('m') == '03') echo 'selected';?>>{{__('web.march')}}</option>
                                <option value="04" <?php if (date('m') == '04') echo 'selected';?>>{{__('web.april')}}</option>
                                <option value="05" <?php if (date('m') == '05') echo 'selected';?>>{{__('web.may')}}</option>
                                <option value="06" <?php if (date('m') == '06') echo 'selected';?>>{{__('web.june')}}</option>
                                <option value="07" <?php if (date('m') == '07') echo 'selected';?>>{{__('web.july')}}</option>
                                <option value="08" <?php if (date('m') == '08') echo 'selected';?>>{{__('web.august')}}</option>
                                <option value="09" <?php if (date('m') == '09') echo 'selected';?>>{{__('web.september')}}</option>
                                <option value="10" <?php if (date('m') == '10') echo 'selected';?>>{{__('web.october')}}</option>
                                <option value="11" <?php if (date('m') == '11') echo 'selected';?>>{{__('web.november')}}</option>
                                <option value="12" <?php if (date('m') == '12') echo 'selected';?>>{{__('web.december')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.year')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="year" id="year">
                                @for ($i = 0; $i < 12; $i++ )
                                <option value="{{(2018 + $i)}}" <?php if (date('Y') == (2018 + $i)) echo 'selected';?>>{{(2018 + $i)}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.department')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="department_id" id="department_id"
                                data-live-search="true">
                                <option value="">{{__('web.all')}}</option>
                                @foreach (\App\Department::where('account_id', Auth::user()->account_id)->get() as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
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
                                <option value="{{$employee->id}}">{{$employee->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                {{__('web.status')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="status" id="status">
                                <option value="0">{{__('web.unpaid')}}</option>
                                <option value="1">{{__('web.paid')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            id="payroll-filter-button">
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
        <div class="m-portlet m-portlet--mobile" id="payroll-list">
            @include('backend.pages.payrolls.list')
        </div>
    </div>

@endsection

@section('script')
    <script>
        var payrollFilterRoute = '{{route('payrolls.filter')}}';
        var employeeFilterRoute = '{{route('payrolls.filter_employee')}}';
        $(document).ready(function() {
            $('#payroll-filter-button').on('click', function() {
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'month': $('#month').val(),
                    'year': $('#year').val(),
                    'department_id': $('#department_id').val(),
                    'employee_id': $('#employee_id').val(),
                    'status': $('#status').val()
                };
                $.post(payrollFilterRoute, filterParams, function(response) {
                    $('#payroll-list').html(response);
                    $('#payroll-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#payroll-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
                });
            });
            $('#department_id').on('change', function() {
                var department_id = $(this).val();
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'department_id': department_id
                };
                $.post(employeeFilterRoute, filterParams, function(response) {
                    $('#employee_id').html('');
                    var data = $.parseJSON(response);
                    if (data != '') {
                        $('#employee_id').append('<option value="">All</option>');
                        $.each(data, function (key, value) {
                            $('#employee_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    } else {
                        $('#employee_id').html('');
                    }
                    $('.m_selectpicker').selectpicker('refresh');
                }).fail(function(response) {
                    console.log(response);
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