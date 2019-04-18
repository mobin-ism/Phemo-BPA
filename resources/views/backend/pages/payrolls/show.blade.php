@extends('backend.layouts.master')
@section('content')

@php
    $employee = \App\Employee::where('id', $payroll->employee_id)->first();
@endphp
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.payroll_details')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    @if (is_permitted('payroll_view'))
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('payrolls.index')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.payrolls')}}</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div>
                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                    <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                        <i class="la la-plus m--hide"></i>
                        <i class="la la-ellipsis-h"></i>
                    </a>
                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        @if ($payroll->status == 0)
                                        @if (is_permitted('payroll_edit'))
                                        <li class="m-nav__item">
                                            <a href="{{route('payrolls.edit', $payroll)}}" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-edit"></i>
                                                <span class="m-nav__link-text">{{__('web.edit')}}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endif
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link"
                                                onclick="printPayslip()">
                                                <i class="m-nav__link-icon la la-print"></i>
                                                <span class="m-nav__link-text">{{__('web.print')}}</span>
                                            </a>
                                        </li>
                                        {{-- <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="m-nav__link-text">{{__('web.pdf')}}</span>
                                            </a>
                                        </li> --}}
                                        @if ($payroll->status == 0)
                                        @if (is_permitted('payroll_delete'))
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link"
                                            onclick="confirmModal('{{route('payrolls.delete', $payroll->id)}}')">
                                                <i class="m-nav__link-icon la la-trash"></i>
                                                <span class="m-nav__link-text">{{__('web.delete')}}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            @if (Auth::user()->role == 'admin')
            <div class="col-lg-4 col-md-4">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.color_options')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <form action="{{route('configs.payslip_color')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group m-form__group" id="">
                                        <label for="payslip-color-1">
                                            {{__('web.color_1')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill minicolors" id="payslip-color-1"
                                            name="payslip_color_1" value="{{get_config('payslip_color_1')}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group m-form__group" id="">
                                        <label for="payslip-color-2">
                                            {{__('web.color_2')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill minicolors" id="payslip-color-2"
                                            name="payslip_color_2" value="{{get_config('payslip_color_2')}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group m-form__group" id="">
                                        <label for="payslip-color-3">
                                            {{__('web.color_3')}}
                                        </label>
                                        <input type="text" class="form-control m-input m-input--pill minicolors" id="payslip-color-3"
                                            name="payslip_color_3" value="{{get_config('payslip_color_3')}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                        <span>
                                            <i class="la la-save"></i>
                                            <span>{{__('web.save')}}</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @php
                $employee_user_id = \App\Employee::where('id', $payroll->employee_id)->first()->user_id;
            @endphp
            @if (is_permitted('payroll_view') || ($employee_user_id == Auth::user()->id))
            <div class="col-lg-8 col-md-8 col-sm-12" id="payroll-details-portlet">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__body">
                        <div class="row" style="margin-bottom: 3rem;">
                            <div class="col-lg-6 col-md-6">
                                <h4>{{__('web.payslip')}} | {{$payroll->code}}</h4>
                                <h6>{{date('F', mktime(0, 0, 0, $payroll->month, 10))}}, {{$payroll->year}}</h6>
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
                                    <tbody style="font-weight: 500;">
                                        <tr>
                                            <td>{{__('web.employee_name')}}</td>
                                            <td>{{\App\Employee::find($payroll->employee_id)->user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.employee_no')}}</td>
                                            <td>{{get_config('employee_prefix')}}-{{\App\Employee::find($payroll->employee_id)->employee_no}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.account_no')}}</td>
                                            <td>{{\App\Employee::find($payroll->employee_id)->bank_account}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.tax_no')}}</td>
                                            <td>{{\App\Employee::find($payroll->employee_id)->tax_no}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.basic_salary')}}</td>
                                            <td>{{number_format($payroll->salary, 2, '.', ',')}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.pay_period')}}</td>
                                            <td>{{date('F', mktime(0, 0, 0, $payroll->month, 10))}}, {{$payroll->year}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table">
                                    <tbody style="font-weight: 500;">
                                        <tr>
                                            <td>{{__('web.department')}}</td>
                                            <td>
                                                @if($employee->department_id != null)
                                                {{\App\Employee::find($payroll->employee_id)->department->name}}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.designation')}}</td>
                                            <td>{{\App\Employee::find($payroll->employee_id)->position}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.status')}}</td>
                                            <td>
                                                @if($employee->job_type_id != null)
                                                {{\App\Employee::find($payroll->employee_id)->jobType->name}}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.pay_frequency')}}</td>
                                            <td>
                                                @if($employee->pay_status_id != null)
                                                {{\App\Employee::find($payroll->employee_id)->payStatus->name}}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{__('web.branch')}}</td>
                                            <td>{{\App\Employee::find($payroll->employee_id)->branch}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @if($payroll->benefits != null)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left; background-color: {{get_config('payslip_color_1')}} !important; color: white;">{{__('web.benefits')}}</th>
                                            <th style="text-align: left; background-color: {{get_config('payslip_color_1')}} !important; color: white;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (json_decode($payroll->benefits) as $benefit)
                                        <tr>
                                            <td style="text-align: left;">{{$benefit->name}}</td>
                                            <td style="text-align: right;">{{number_format($benefit->amount, 2, '.', ',')}}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="font-weight: 600;">
                                            <td style="text-align: left;">{{__('web.net_benefit')}}</td>
                                            <td style="text-align: right;">
                                                {{number_format(benefits_deductions_sum($payroll->benefits), 2, '.', ',')}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="col">
                                @if($payroll->deductions != null)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left; background-color: {{get_config('payslip_color_2')}} !important; color: white;">{{__('web.deductions')}}</th>
                                            <th style="text-align: left; background-color: {{get_config('payslip_color_2')}} !important; color: white;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (json_decode($payroll->deductions) as $deduction)
                                        <tr>
                                            <td style="text-align: left;">{{$deduction->name}}</td>
                                            <td style="text-align: right;">{{number_format($deduction->amount, 2, '.', ',')}}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="font-weight: 600;">
                                            <td style="text-align: left;">{{__('web.net_deduction')}}</td>
                                            <td style="text-align: right;">
                                                {{number_format(benefits_deductions_sum($payroll->deductions), 2, '.', ',')}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 3rem;">
                            <div class="col"></div>
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left; background-color: {{get_config('payslip_color_3')}} !important; color: white;">{{__('web.summary')}}</th>
                                            <th style="text-align: right; background-color: {{get_config('payslip_color_3')}} !important; color: white;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="font-weight: 400; text-align: left;">{{__('web.salary')}}</td>
                                            <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($payroll->salary, 2, '.', ',')}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 400; text-align: left;">{{__('web.benefits')}}</td>
                                            <td style="font-weight: 400; text-align: right;">
                                                {{get_config('currency')}} @if($payroll->benefits == null) 0.0 @else {{number_format(benefits_deductions_sum($payroll->benefits), 2, '.', ',')}} @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 400; text-align: left;">{{__('web.deductions')}}</td>
                                            <td style="font-weight: 400; text-align: right;">
                                                {{get_config('currency')}} @if($payroll->deductions == null) 0.0 @else {{number_format(benefits_deductions_sum($payroll->deductions), 2, '.', ',')}} @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 400; text-align: left;">{{__('web.net_salary')}}</td>
                                            <td style="font-weight: 400; text-align: right;">{{get_config('currency')}} {{number_format($payroll->net_salary, 2, '.', ',')}}</td>
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
            @endif
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.minicolors').minicolors({
                theme: 'bootstrap'
            });
        });
        function printPayslip() {
            $('#payroll-details-portlet').printThis({
                importStyle: true,
                pageTitle: '{{$payroll->code}}',
                removeInline: false
            });
        }
    </script>
@endsection
