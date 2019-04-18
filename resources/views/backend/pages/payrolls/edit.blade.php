@if (is_permitted('payroll_edit'))
@extends('backend.layouts.master')
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.edit_payroll')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('payrolls.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.payrolls')}}</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('payrolls.show', $payroll)}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.payroll_details')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<form action="{{route('payrolls.update', $payroll)}}" method="post">
    @csrf
    {{method_field('PATCH')}}
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('web.payslip_information')}}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                * {{__('web.month')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="month" id="month">
                                <option value="01" <?php if ($payroll->month == '01') echo 'selected';?>>{{__('web.january')}}</option>
                                <option value="02" <?php if ($payroll->month == '02') echo 'selected';?>>{{__('web.february')}}</option>
                                <option value="03" <?php if ($payroll->month == '03') echo 'selected';?>>{{__('web.march')}}</option>
                                <option value="04" <?php if ($payroll->month == '04') echo 'selected';?>>{{__('web.april')}}</option>
                                <option value="05" <?php if ($payroll->month == '05') echo 'selected';?>>{{__('web.may')}}</option>
                                <option value="06" <?php if ($payroll->month == '06') echo 'selected';?>>{{__('web.june')}}</option>
                                <option value="07" <?php if ($payroll->month == '07') echo 'selected';?>>{{__('web.july')}}</option>
                                <option value="08" <?php if ($payroll->month == '08') echo 'selected';?>>{{__('web.august')}}</option>
                                <option value="09" <?php if ($payroll->month == '09') echo 'selected';?>>{{__('web.september')}}</option>
                                <option value="10" <?php if ($payroll->month == '10') echo 'selected';?>>{{__('web.october')}}</option>
                                <option value="11" <?php if ($payroll->month == '11') echo 'selected';?>>{{__('web.november')}}</option>
                                <option value="12" <?php if ($payroll->month == '12') echo 'selected';?>>{{__('web.december')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group m-form__group" id="">
                            <label>
                                * {{__('web.year')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="year" id="year">
                                @for ($i = 0; $i < 12; $i++ )
                                <option value="{{(2018 + $i)}}" <?php if ($payroll->year == (2018 + $i)) echo 'selected';?>>{{(2018 + $i)}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="department_id-group">
                            <label>
                                * {{__('web.department')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="department_id" id="department_id">
                                <option value="{{$payroll->department_id}}">{{\App\Department::find($payroll->department_id)->name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group" id="employee_id-group">
                            <label>
                                * {{__('web.employee')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="employee_id" id="employee_id">
                                <option value="{{$payroll->employee_id}}">{{\App\Employee::find($payroll->employee_id)->user->name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group m-form__group" id="status-group">
                            <label>
                                * {{__('web.status')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="status" id="status">
                                <option value="0" <?php if ($payroll->status == 0) echo 'selected'; ?>>{{__('web.unpaid')}}</option>
                                <option value="1" <?php if ($payroll->status == 1) echo 'selected'; ?>>{{__('web.paid')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.benefits')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @if($payroll->benefits != null)
                        @foreach (get_employee_salary_heads($payroll->employee_id, 'benefits') as $benefit)
                        @php
                            $name = \App\SalaryHead::find($benefit)->name;
                            $amount = get_salary_head_value($payroll->benefits, $benefit)
                        @endphp
                        <div class="form-group m-form__group">
                            <label>{{$name}}</label>
                            <div class="input-group m-input-group m-input-group--pill">
                                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">{{get_config('currency')}}</span></div>
                                <input type="text" class="form-control m-input" name="benefits[]" value="{{$amount}}" onkeyup="calculateSalary()">
                            </div>
                        </div>
                        <input type="hidden" name="benefit_id[]" value="{{$benefit}}">
                        <input type="hidden" name="benefit_name[]" value="{{$name}}">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.deductions')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @if($payroll->deductions != null)
                        @foreach (get_employee_salary_heads($payroll->employee_id, 'deductions') as $deduction)
                        @php
                            $name = \App\SalaryHead::find($deduction)->name;
                            $amount = get_salary_head_value($payroll->deductions, $deduction)
                        @endphp
                        <div class="form-group m-form__group">
                            <label>{{$name}}</label>
                            <div class="input-group m-input-group m-input-group--pill">
                                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">{{get_config('currency')}}</span></div>
                                <input type="text" class="form-control m-input" name="deductions[]" value="{{$amount}}" onkeyup="calculateSalary()">
                            </div>
                        </div>
                        <input type="hidden" name="deduction_id[]" value="{{$deduction}}">
                        <input type="hidden" name="deduction_name[]" value="{{$name}}">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.summary')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row mb-3">
                            <div class="col">
                                <span class="m--font-bold">{{__('web.salary')}}</span>
                            </div>
                            <div class="col text-right">
                                <span class="m--font-bolder">
                                    {{get_config('currency')}} <span id="salary-basic">{{$payroll->salary}}</span>
                                </span>
                                <input type="hidden" name="salary" value="{{$payroll->salary}}" id="salary">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <span class="m--font-bold">{{__('web.benefits')}}</span>
                            </div>
                            <div class="col text-right">
                                <span class="m--font-bolder">
                                    @if($payroll->benefits != null)
                                    {{get_config('currency')}} <span id="benefit-total">{{benefits_deductions_sum($payroll->benefits)}}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <span class="m--font-bold">{{__('web.deductions')}}</span>
                            </div>
                            <div class="col text-right">
                                <span class="m--font-bolder">
                                    @if($payroll->deductions != null)
                                    {{get_config('currency')}} <span id="deduction-total">{{benefits_deductions_sum($payroll->deductions)}}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="m--font-bold">{{__('web.net_salary')}}</span>
                            </div>
                            <div class="col text-right">
                                <span class="m--font-bolder">
                                    {{get_config('currency')}} <span id="net-salary">{{$payroll->net_salary}}</span>
                                </span>
                                <input type="hidden" name="net_salary" id="net" value="{{$payroll->net_salary}}">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill pull-right">
                    <span>
                        <i class="la la-save"></i>
                        <span>{{__('web.save')}}</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')
    <script>
        $("input[name='benefits[]']").on('focus', function() {
            if ($(this).val() == 0)
                $(this).val('');
        });
        $("input[name='deductions[]']").on('focus', function() {
            if ($(this).val() == 0)
                $(this).val('');
        });
        function calculateSalary() {
            // calculate benefits
            var benefitTotal = 0.0;
            var benefits = $("input[name='benefits[]']").map(function() {
                return $(this).val();
            }).get();
            for (var i = 0; i < benefits.length; i++) {
                benefitTotal += parseFloat(benefits[i]);
            }
            $('#benefit-total').html(benefitTotal);
            
            // calculate deductions
            var deductionTotal = 0.0;
            var deductions = $("input[name='deductions[]']").map(function() {
                return $(this).val();
            }).get();
            for (var i = 0; i < deductions.length; i++) {
                deductionTotal += parseFloat(deductions[i]);
            }
            $('#deduction-total').html(deductionTotal);

            // calculate net salary
            var basicSalary = parseFloat($('#salary').val());
            var netSalary = (basicSalary + benefitTotal) - deductionTotal;
            $('#net-salary').html(netSalary);
            $('#net').val(netSalary);
        }
    </script>
@endsection
@endif