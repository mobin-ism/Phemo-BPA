@if (is_permitted('employee_view') || ($employee->user_id == Auth::user()->id))
@extends('backend.layouts.master')
@section('content')
    <!-- BEGIN: Subheader -->
    @php
        $format = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format;
    @endphp
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.employee_profile')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    @if (is_permitted('employee_view'))
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('employees.index')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.all_employees')}}</span>
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
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                {{__('web.profile')}}
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="{{profile_photo('employee', $employee->id)}}" />
                                </div>
                            </div>
                            @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                            <div class="text-center">
                                <a href="#" class="m-link" data-container="body" data-toggle="m-tooltip" data-placement="top"
                                    data-original-title="{{__('web.change_profile_picture')}}"
                                        onclick="presentModal('{{route('employees.photo', $employee->id)}}', '{{__('web.change_profile_picture')}}')">
                                    <i class="la la-edit"></i>
                                </a>
                            </div>
                            @endif
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name">{{$employee->user->name}}</span>
                                <span class="m-card-profile__email m-link">
                                    {{$employee->position}}@if($employee->department_id != 0){{', '.$employee->department->name}}@endif
                                </span>
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{$employee->facebook}}" class="m-link" target="_blank">
                                            <i class="socicon-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$employee->twitter}}" class="m-link" target="_blank">
                                            <i class="socicon-twitter"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$employee->linkedin}}" class="m-link" target="_blank">
                                            <i class="socicon-linkedin"></i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{$employee->skype}}" class="m-link" target="_blank">
                                            <i class="socicon-skype"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (is_permitted('employee_edit'))
                        <div class="m-portlet__body-separator"></div>
                        <div class="m-widget1 m-widget1--paddingless">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">{{__('web.active')}}</h3>
                                        <span class="m-widget1__desc">{{__('web.employment_status')}}</span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand">
                                            <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                <label>
                                                    <input type="checkbox" name="status" value="1" id="status"
                                                    @if ($employee->status == 1) checked @endif>
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
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-user" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.personal_information')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                        <i class="flaticon-book" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.education')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                        <i class="flaticon-suitcase" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.job_information')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_4" role="tab">
                                        <i class="flaticon-signs" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.salary')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_5" role="tab">
                                        <i class="flaticon-clock-1" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.time_off')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_6" role="tab">
                                        <i class="flaticon-file-2" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.documents')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_7" role="tab">
                                        <i class="flaticon-list-2" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.notes')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_8" role="tab">
                                        <i class="flaticon-tabs" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.training')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_9" role="tab">
                                        <i class="flaticon-imac" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.assets')}}"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_10" role="tab">
                                        <i class="flaticon-time" data-toggle="m-tooltip" data-placemoent="top" title="{{__('web.employment_history')}}"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air pull-right"
                                            onclick="presentModal('{{route('employees.edit_personal', $employee->id)}}', '{{__('web.edit_personal_information')}}')">
                                            <i class="la la-edit"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.name')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->user->name}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.surname')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->surname}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.email')}}</span><br>
                                            <a href="mailto:{{$employee->user->email}}" class="m-link">
                                                <span class="m--font-bolder">{{$employee->user->email}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.phone')}} ({{__('web.personal')}})</span><br>
                                            <a href="tel:{{$employee->personal_phone}}" class="m-link">
                                                <span class="m--font-bolder">{{$employee->personal_phone}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.phone')}} ({{__('web.office')}})</span><br>
                                            <a href="tel:{{$employee->office_phone}}" class="m-link">
                                                <span class="m--font-bolder">{{$employee->office_phone}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.phone')}} ({{__('web.house')}})</span><br>
                                            <a href="tel:{{$employee->house_phone}}" class="m-link">
                                                <span class="m--font-bolder">{{$employee->house_phone}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.nationality')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->nationality}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.gender')}}</span><br>
                                            <span class="m--font-bolder">{{__('web.'.$employee->gender)}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.birthday')}}</span><br>
                                            <span class="m--font-bolder">{{date($format, $employee->bday)}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.marital_status')}}</span><br>
                                            <span class="m--font-bolder">{{__('web.'.$employee->marital_status)}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.ethnicity')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->ethnicity}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.religion')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->religion}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.national_id')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->nid}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.passport_no')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->passport}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.tax_no')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->tax_no}}</span>
                                        </div>
                                        <hr>
                                        <div class="mb-4">
                                            <span>{{__('web.emergency_contact')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->emergency_name}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.email')}}</span><br>
                                            <a href="mailto:{{$employee->emergency_email}}" class="m-link">
                                                <span class="m--font-bolder">{{$employee->emergency_email}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.phone')}}</span><br>
                                            <a href="tel:{{$employee->emergency_phone}}" class="m-link">
                                                <span class="m--font-bolder">{{$employee->emergency_phone}}</span>
                                            </a>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.address')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->emergency_address}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_2">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                <div class="row mb-4">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air pull-right"
                                            onclick="presentModal('{{route('employees.add_education', $employee->id)}}', '{{__('web.add_education')}}')">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @foreach (App\Employee::find($employee->id)->educations as $education)
                                <div class="row">
                                    <div class="col">
                                        <div class="m-portlet">
                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">
                                                            {{$education->degree}}
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="m-portlet__head-tools">
                                                    <ul class="m-portlet__nav">
                                                        @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                                onclick="presentModal('{{route('employees.edit_education', $education->id)}}', '{{__('web.edit_education')}}')">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                            onclick="confirmModal('{{route('employees.delete_education', $education->id)}}')">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="m-portlet__body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="mb-4">
                                                            <span>{{__('web.institution')}}</span><br>
                                                            <span class="m--font-bolder">{{$education->institution}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.major')}}</span><br>
                                                            <span class="m--font-bolder">{{$education->major}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.gpa')}}</span><br>
                                                            <span class="m--font-bolder">{{$education->gpa}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="mb-4">
                                                            <span>{{__('web.start')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($education->start)}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.end')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($education->end)}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_3">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit'))
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air pull-right"
                                            onclick="presentModal('{{route('employees.edit_job', $employee->id)}}', '{{__('web.edit_job_information')}}')">
                                            <i class="la la-edit"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.department')}}</span><br>
                                            <span class="m--font-bolder">@if ($employee->department_id != 0) {{$employee->department->name}} @endif</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.joining_date')}}</span><br>
                                            <span class="m--font-bolder">@if ($employee->joined_date != 0) {{date($format, $employee->joined_date)}} @endif</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.end_of_probation')}}</span><br>
                                            <span class="m--font-bolder">@if ($employee->probation_date != 0) {{date($format, $employee->probation_date)}} @endif</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.job_type')}}</span><br>
                                            <span class="m--font-bolder">@if ($employee->job_type_id != null) {{__($employee->jobType->name)}} @endif</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.job_status')}}</span><br>
                                            <span class="m--font-bolder">@if ($employee->job_status_id != null) {{__($employee->jobStatus->name)}} @endif</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.pay_status')}}</span><br>
                                            <span class="m--font-bolder">@if ($employee->pay_status_id != null) {{__($employee->payStatus->name)}} @endif</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.pay_in_figures')}}</span><br>
                                            <span class="m--font-bolder">{{__($employee->pay_in_figures)}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-4">
                                            <span>{{__('web.position')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->position}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.line_manager')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->line_manager}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.branch')}}</span><br>
                                            <span class="m--font-bolder">{{$employee->branch}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.effective_date')}}</span><br>
                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($employee->effective_date)}}</span>
                                        </div>
                                        <div class="mb-4">
                                            <span>{{__('web.exit_date')}}</span><br>
                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($employee->exit_date)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_4">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit'))
                                <div class="row mb-4">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--pill m-btn--air pull-right"
                                            onclick="presentModal('{{route('employees.heads', $employee->id)}}', '{{__('web.benefits_and_deductions')}}')">
                                            {{__('web.benefits_and_deductions')}}
                                        </a>
                                    </div>
                                </div>
                                @endif
                                <div class="m-portlet m-portlet--mobile">
                                    <div class="m-portlet__body">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="month" id="month">
                                                        <option value="">{{__('web.all_months')}}</option>
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
                                            <div class="col-lg-3">
                                                <div class="form-group m-form__group" id="">
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="year" id="year">
                                                        @for ($i = 0; $i < 12; $i++ )
                                                        <option value="{{(2018 + $i)}}" <?php if (date('Y') == (2018 + $i)) echo 'selected';?>>{{(2018 + $i)}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="button" class="btn btn-outline-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                                                    id="employee-payroll-filter">
                                                    <span>
                                                        <i class="la la-filter"></i>
                                                        <span>{{__('web.apply_filter')}}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col" id="employee-payroll-list">
                                                @include('backend.pages.employees.payrolls')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_5">
                            <div class="m-portlet__body">

                                <div class="row mb-4">
                                    <div class="col">
                                        @if (is_permitted('employee_edit'))
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--pill m-btn--air pull-right"
                                            onclick="presentModal('{{route('employees.leave_entitlement', $employee->id)}}', '{{__('web.leave_entitlements')}}')">
                                            {{__('web.leave_entitlements')}}
                                        </a>
                                        @endif
                                        {{-- @if ($employee->user_id == Auth::user()->id)
                                        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right"
                                            onclick="presentModal('{{route('leaves.create')}}', '{{__('web.new_leave_request')}}')">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>{{__('web.new_leave_request')}}</span>
                                            </span>
                                        </a>
                                        @endif --}}
                                    </div>
                                </div>
                                <div class="m-portlet m-portlet--mobile">
                                    <div class="m-portlet__body">
                                        <div class="row">
                                            <div class="col" id="employee-leaves-list">
                                                @include('backend.pages.employees.leaves')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_6">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="m-widget4" id="doc-list">
                                            @include('backend.pages.employees.doc_list')
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1"></div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <form action="{{route('employees.upload')}}" method="post" enctype="multipart/form-data"
                                            class="m-dropzone dropzone m-dropzone--success" id="employee-docs-dropzone">
                                            @csrf
                                            {{Form::hidden('employee_id', $employee->id)}}
                                            <div class="m-dropzone__msg dz-message needsclick">
                                                <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                                                <span class="m-dropzone__msg-desc">
                                                    Only pdf and image files are allowed for upload (max 5 MB)
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_7">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                <div class="row mb-4">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air pull-right"
                                            onclick="presentModal('{{route('employees.add_note', $employee->id)}}', '{{__('web.add_note')}}')">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @foreach (App\Employee::find($employee->id)->notes as $key => $note)
                                <div class="row">
                                    <div class="col">
                                        <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <span class="m-portlet__head-icon m--hide">
                                                            <i class="flaticon-statistics"></i>
                                                        </span>
                                                        <h3 class="m-portlet__head-text">
                                                            {{$note->title}}
                                                        </h3>
                                                        <h2 class="m-portlet__head-label m-portlet__head-label--warning">
                                                            <span class="text-light">
                                                                    {{$key+1}}
                                                            </span>
                                                        </h2>
                                                    </div>
                                                </div>
                                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                                <div class="m-portlet__head-tools">
                                                    <ul class="m-portlet__nav">
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                                onclick="presentModal('{{route('employees.edit_note', $note->id)}}', '{{__('web.edit_note')}}')">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                                onclick="confirmModal('{{route('employees.delete_note', $note->id)}}')">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="m-portlet__body">
                                                <p>{{$note->description}}</p>
                                                <p class="text-muted">
                                                    {{$note->created_at}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_8">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                <div class="row mb-4">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air pull-right"
                                        onclick="presentModal('{{route('employees.add_training', $employee->id)}}', '{{__('web.add_training')}}')">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @foreach (App\Employee::find($employee->id)->trainings as $training)
                                <div class="row">
                                    <div class="col">
                                        <div class="m-portlet">
                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">
                                                            {{ $training->training_type_id > 0 ? $training->trainingType->name : '' }}
                                                        </h3>
                                                    </div>
                                                </div>
                                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                                <div class="m-portlet__head-tools">
                                                    <ul class="m-portlet__nav">
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                                onclick="presentModal('{{route('employees.edit_training', $training->id)}}', '{{__('web.edit_training')}}')">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                            onclick="confirmModal('{{route('employees.delete_training', $training->id)}}')">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="m-portlet__body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="mb-4">
                                                            <span>{{__('web.description')}}</span><br>
                                                            <span class="m--font-bolder">{{$training->description}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.duration')}}</span><br>
                                                            <span class="m--font-bolder">{{$training->duration}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.start')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($training->start)}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.end')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($training->end)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="mb-4">
                                                            <span>{{__('web.offered_by')}}</span><br>
                                                            <span class="m--font-bolder">{{$training->offered_by}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.award')}}</span><br>
                                                            <span class="m--font-bolder">{{$training->award}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_9">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                <div class="row mb-4">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air pull-right"
                                        onclick="presentModal('{{route('employees.add_asset', $employee->id)}}', '{{__('web.add_asset')}}')">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @foreach (App\Employee::find($employee->id)->assets as $asset)
                                <div class="row">
                                    <div class="col">
                                        <div class="m-portlet">
                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">
                                                            {{$asset->name}}
                                                        </h3>
                                                    </div>
                                                </div>
                                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                                <div class="m-portlet__head-tools">
                                                    <ul class="m-portlet__nav">
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                                onclick="presentModal('{{route('employees.edit_asset', $asset->id)}}', '{{__('web.edit_asset')}}')">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                            onclick="confirmModal('{{route('employees.delete_asset', $asset->id)}}')">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="m-portlet__body">
                                                <div class="row mb-4">
                                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                                        <div>
                                                            <span>{{__('web.serial')}}</span><br>
                                                            <span class="m--font-bolder">{{$asset->serial}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                                        <div>
                                                            <span>{{__('web.make')}}</span><br>
                                                            <span class="m--font-bolder">{{$asset->make}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                                        <div>
                                                            <span>{{__('web.value')}}</span><br>
                                                            <span class="m--font-bolder">{{$asset->value}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                                        <div>
                                                            <span>{{__('web.date_acquired')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($asset->date_acquired)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                                        <div>
                                                            <span>{{__('web.date_returned')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($asset->date_returned)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                                        <div>
                                                            <span>{{__('web.date_assigned')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($asset->date_assigned)}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_10">
                            <div class="m-portlet__body">
                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                <div class="row mb-4">
                                    <div class="col">
                                        <a href="#" class="btn btn-outline-primary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air pull-right"
                                        onclick="presentModal('{{route('employees.add_employment_history', $employee->id)}}', '{{__('web.add_employment_history')}}')">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @foreach (App\Employee::find($employee->id)->employment_histories as $history)
                                <div class="row">
                                    <div class="col">
                                        <div class="m-portlet">
                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">
                                                            {{__($history->title)}}
                                                        </h3>
                                                    </div>
                                                </div>
                                                @if (is_permitted('employee_edit') || ($employee->user_id == Auth::user()->id))
                                                <div class="m-portlet__head-tools">
                                                    <ul class="m-portlet__nav">
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                                onclick="presentModal('{{route('employees.edit_employment_history', $history->id)}}', '{{__('web.edit_employment_history')}}')">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                                            onclick="confirmModal('{{route('employees.delete_employment_history', $history->id)}}')">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="m-portlet__body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="mb-4">
                                                            <span>{{__('web.employer')}}</span><br>
                                                            <span class="m--font-bolder">{{$history->employer}}</span>
                                                        </div>
                                                        <div class="mb-4">
                                                            <span>{{__('web.start')}}</span><br>
                                                            <span class="m--font-bolder">
                                                                {{get_formatted_date_from_timestamp($history->start)}}
                                                                @if ($history->present == 1) - {{ __('web.present') }} @endif
                                                            </span>
                                                        </div>
                                                        @if ($history->present == 0 || $history->present == null)
                                                        <div class="mb-4">
                                                            <span>{{__('web.end')}}</span><br>
                                                            <span class="m--font-bolder">{{get_formatted_date_from_timestamp($history->end)}}</span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="mb-4">
                                                            <span>{{__('web.description')}}</span><br>
                                                            <span class="m--font-bolder">{{$history->description}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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

        Dropzone.autoDiscover = false;
        var employeePayrollFilterRoute = '{{route('employees.filter_payroll')}}';
        var employeeStatusChangeRoute = '{{route('employees.change_status')}}';
        $(document).ready(function() {
            var myDropzone = new Dropzone('form#employee-docs-dropzone',{
                uploadMultiple: true,
                parallelUploads: 2,
                paramName:'file',
                maxFiles:10,
                maxFilesize:5,
                addRemoveLinks:true,
                acceptedFiles:'image/jpg,application/pdf',
                timeout: 10000,
                init: function() {
                    this.on('addedfile', function(file) {
                        $('#doc-list').html('<div class="m-loader m-loader--primary" style="width: 30px; display: inline-block;"></div>');
                    }),
                    this.on('success', function(file, response) {
                        console.log(response);
                        if (response.errors) {
                            notify(response.errors.file, 'danger');
                        }
                        this.removeFile(file);
                        $('#doc-list').html(response);
                        notify('Upload completed', 'success');
                    })
                }
            });
            $('#employee-payroll-filter').on('click', function() {
                console.log(employeePayrollFilterRoute);
                $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
                var filterParams = {
                    '_token': '{{ csrf_token() }}',
                    'account_id': '{{Auth::user()->account_id}}',
                    'employee_id': '{{$employee->id}}',
                    'month': $('#month').val(),
                    'year': $('#year').val()
                };
                $.post(employeePayrollFilterRoute, filterParams, function(response) {
                    $('#employee-payroll-list').html(response);
                    $('#employee-payroll-filter').removeClass('m-loader m-loader--right').removeAttr('disabled');
                }).fail(function(response) {
                    console.log(response);
                    $('#employee-payroll-filter').removeClass('m-loader m-loader--right').removeAttr('disabled');
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
                    'employee_id': '{{$employee->id}}',
                    'status': $('#status').val()
                };
                $.post(employeeStatusChangeRoute, postParams, function(response) {
                    notify('Employee status was changed successfully', 'success');
                }).fail(function(response) {
                    console.log(response);
                });
            });
        });
    </script>

@endsection
@endif
