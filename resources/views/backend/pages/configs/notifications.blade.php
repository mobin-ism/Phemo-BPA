@extends('backend.layouts.master')
@section('content')

    @php
        $notif = $config->notifications != null ? json_decode($config->notifications) : '';
    @endphp

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.reminders')}}</h3>
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
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                @include('backend.partials.settings')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{__('web.reminders')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <form action="{{route('configs.update_notifications')}}" method="post" id="notification-form">
                            @csrf
                            {{ Form::hidden('account_id', Auth::user()->account_id) }}
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('vat_return_date')" style="cursor: pointer;">
                                                        <span class="vat_return_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.vat_return')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="vat_return_notification" value="{{$notif->vat_return_notification}}" 
                                                            id="vat_return_date" @if ($notif->vat_return_notification == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body vat_return_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.vat_return_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="vat_return_date" 
                                                        id="" readonly placeholder="{{__('web.vat_return_date')}}" {{$notif->vat_return_notification == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->vat_return_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="vat_return_date_timing[]" 
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->vat_return_notification == null ? 'disabled' : ''}}>
                                                        <option value="7" <?php if (has_this_timing('7', $notif->vat_return_date_timing)) echo 'selected';?>>
                                                            {{__('web.before_7_days')}}
                                                        </option>
                                                        <option value="2" <?php if (has_this_timing('2', $notif->vat_return_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                        <option value="0" <?php if (has_this_timing('0', $notif->vat_return_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="vat_return_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->vat_return_notification == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->vat_return_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->vat_return_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('tax_clearance_expiry_date')" style="cursor: pointer;">
                                                        <span class="tax_clearance_expiry_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.tax_clearance_expiry')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="tax_clearance_expiry_notification" value="{{$notif->tax_clearance_expiry_notification}}"
                                                            id="tax_clearance_expiry_date" @if ($notif->tax_clearance_expiry_notification == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body tax_clearance_expiry_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.tax_clearance_expiry_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="tax_clearance_expiry_date" 
                                                        id="" readonly placeholder="{{__('web.tax_clearance_expiry_date')}}" {{$notif->tax_clearance_expiry_notification == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->tax_clearance_expiry_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="tax_clearance_expiry_date_timing[]" 
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->tax_clearance_expiry_notification == null ? 'disabled' : ''}}>
                                                            <option value="7" <?php if (has_this_timing('7', $notif->tax_clearance_expiry_date_timing)) echo 'selected';?>>
                                                                {{__('web.before_7_days')}}
                                                            </option>
                                                            <option value="2" <?php if (has_this_timing('2', $notif->tax_clearance_expiry_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                            <option value="0" <?php if (has_this_timing('0', $notif->tax_clearance_expiry_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="tax_clearance_expiry_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->tax_clearance_expiry_notification == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->tax_clearance_expiry_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->tax_clearance_expiry_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('paye_due_date')" style="cursor: pointer;">
                                                        <span class="paye_due_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.paye_due_date')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="paye_due_date_notification" value="{{$notif->paye_due_date_notification}}" id="paye_due_date"
                                                            @if ($notif->paye_due_date_notification == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body paye_due_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.paye_due_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="paye_due_date" 
                                                        id="" readonly placeholder="{{__('web.paye_due_date')}}" {{$notif->paye_due_date_notification == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->paye_due_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="paye_due_date_timing[]"
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->paye_due_date_notification == null ? 'disabled' : ''}}>
                                                            <option value="7" <?php if (has_this_timing('7', $notif->paye_due_date_timing)) echo 'selected';?>>
                                                                {{__('web.before_7_days')}}
                                                            </option>
                                                            <option value="2" <?php if (has_this_timing('2', $notif->paye_due_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                            <option value="0" <?php if (has_this_timing('0', $notif->paye_due_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="paye_due_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->paye_due_date_notification == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->paye_due_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->paye_due_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('income_tax_date')" style="cursor: pointer;">
                                                        <span class="income_tax_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.income_tax')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="income_tax_notification" value="{{$notif->income_tax_notification}}" id="income_tax_date"
                                                        @if ($notif->income_tax_notification == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body income_tax_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.income_tax_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="income_tax_date" 
                                                        id="" readonly placeholder="{{__('web.income_tax_date')}}" {{$notif->income_tax_notification == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->income_tax_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="income_tax_date_timing[]"
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->income_tax_notification == null ? 'disabled' : ''}}>
                                                            <option value="7" <?php if (has_this_timing('7', $notif->income_tax_date_timing)) echo 'selected';?>>
                                                                {{__('web.before_7_days')}}
                                                            </option>
                                                            <option value="2" <?php if (has_this_timing('2', $notif->income_tax_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                            <option value="0" <?php if (has_this_timing('0', $notif->income_tax_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="income_tax_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->income_tax_notification == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->income_tax_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->income_tax_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('board_meeting_date')" style="cursor: pointer;">
                                                        <span class="board_meeting_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.board_meeting')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="board_meeting_reminder" value="{{$notif->board_meeting_reminder}}" id="board_meeting_date"
                                                        @if ($notif->board_meeting_reminder == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body board_meeting_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.board_meeting_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="board_meeting_date" 
                                                        id="" readonly placeholder="{{__('web.board_meeting_date')}}" {{$notif->board_meeting_reminder == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->board_meeting_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="board_meeting_date_timing[]"
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->board_meeting_reminder == null ? 'disabled' : ''}}>
                                                            <option value="7" <?php if (has_this_timing('7', $notif->board_meeting_date_timing)) echo 'selected';?>>
                                                                {{__('web.before_7_days')}}
                                                            </option>
                                                            <option value="2" <?php if (has_this_timing('2', $notif->board_meeting_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                            <option value="0" <?php if (has_this_timing('0', $notif->board_meeting_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="board_meeting_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->board_meeting_reminder == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->board_meeting_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->board_meeting_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('annual_returns_date')" style="cursor: pointer;">
                                                        <span class="annual_returns_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.annual_returns')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="annual_returns_reminder" value="{{$notif->annual_returns_reminder}}" id="annual_returns_date"
                                                        @if ($notif->annual_returns_reminder == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body annual_returns_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.annual_returns_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="annual_returns_date" 
                                                        id="" readonly placeholder="{{__('web.annual_returns_date')}}" {{$notif->annual_returns_reminder == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->annual_returns_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="annual_returns_date_timing[]" 
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->annual_returns_reminder == null ? 'disabled' : ''}}>
                                                            <option value="7" <?php if (has_this_timing('7', $notif->annual_returns_date_timing)) echo 'selected';?>>
                                                                {{__('web.before_7_days')}}
                                                            </option>
                                                            <option value="2" <?php if (has_this_timing('2', $notif->annual_returns_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                            <option value="0" <?php if (has_this_timing('0', $notif->annual_returns_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="annual_returns_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->annual_returns_reminder == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->annual_returns_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->annual_returns_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('payroll_processing_date')" style="cursor: pointer;">
                                                        <span class="payroll_processing_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.payroll_processing')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="payroll_processing_date_notification" value="{{$notif->payroll_processing_date_notification}}" 
                                                            id="payroll_processing_date" @if ($notif->payroll_processing_date_notification == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body payroll_processing_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.payroll_processing_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="payroll_processing_date" 
                                                        id="" readonly placeholder="{{__('web.payroll_processing_date')}}" {{$notif->payroll_processing_date_notification == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->payroll_processing_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="payroll_processing_date_timing[]"
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->payroll_processing_date_notification == null ? 'disabled' : ''}}>
                                                            <option value="7" <?php if (has_this_timing('7', $notif->payroll_processing_date_timing)) echo 'selected';?>>
                                                                {{__('web.before_7_days')}}
                                                            </option>
                                                            <option value="2" <?php if (has_this_timing('2', $notif->payroll_processing_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                            <option value="0" <?php if (has_this_timing('0', $notif->payroll_processing_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="payroll_processing_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->payroll_processing_date_notification == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->payroll_processing_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->payroll_processing_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="m-portlet">
                                        <div class="m-portlet__head" style="border: none;">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text" onclick="toggleSection('debt_repayment_date')" style="cursor: pointer;">
                                                        <span class="debt_repayment_date"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.debt_repayment')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                                    <label>
                                                        <input type="checkbox" name="debt_repayment_reminder" value="{{$notif->debt_repayment_reminder}}" id="debt_repayment_date"
                                                        @if ($notif->debt_repayment_reminder == 'on') checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body debt_repayment_date m--hide">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.debt_repayment_date')}}
                                                    </label>
                                                    <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="debt_repayment_date" 
                                                        id="" readonly placeholder="{{__('web.debt_repayment_date')}}" {{$notif->debt_repayment_reminder == null ? 'disabled' : ''}}
                                                            value="{{get_formatted_date_from_timestamp($notif->debt_repayment_date)}}">
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.notification_timing')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="debt_repayment_date_timing[]" 
                                                        title="{{__('web.select_notification_timings')}}" multiple {{$notif->debt_repayment_reminder == null ? 'disabled' : ''}}>
                                                            <option value="7" <?php if (has_this_timing('7', $notif->debt_repayment_date_timing)) echo 'selected';?>>
                                                                {{__('web.before_7_days')}}
                                                            </option>
                                                            <option value="2" <?php if (has_this_timing('2', $notif->debt_repayment_date_timing)) echo 'selected';?>>{{__('web.before_2_days')}}</option>
                                                            <option value="0" <?php if (has_this_timing('0', $notif->debt_repayment_date_timing)) echo 'selected';?>>{{__('web.on_due_date')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group m-form__group" id="">
                                                    <label>
                                                        {{__('web.receivers')}}
                                                    </label>
                                                    <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="debt_repayment_date_receivers[]" 
                                                        title="{{__('web.select_receivers')}}" multiple {{$notif->debt_repayment_reminder == null ? 'disabled' : ''}}>
                                                        <optgroup label="{{__('web.admin')}}">
                                                            @foreach (\App\User::where(['role' => 'admin', 'account_id' => Auth::user()->account_id])->get() as $admin)
                                                            <option value="{{$admin->email}}" <?php if (has_this_receiver($admin->email, $notif->debt_repayment_date_receivers)) echo 'selected'; ?>>
                                                                {{$admin->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                        <optgroup label="{{__('web.employees')}}">
                                                            @foreach (\App\User::where(['role' => 'employee', 'account_id' => Auth::user()->account_id])->get() as $employee)
                                                            <option value="{{$employee->email}}" <?php if (has_this_receiver($employee->email, $notif->debt_repayment_date_receivers)) echo 'selected'; ?>>
                                                                {{$employee->name}}
                                                            </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
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
        </div>
    </div>

@endsection

@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

@section('script')
<script>
    $(document).ready(function() {
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            startDate: new Date(),
            clearBtn: !0
        });
        $('#notification-form input[type=checkbox]').change(function() {
            var id = $(this).get(0).id;
            if ($(this).is(':checked')) {
                $(this).val('on');
                $('input[name='+id+']').prop('disabled', 0);
                var timingSelects = document.getElementsByName(id+'_timing[]')[0];
                var receiverSelects = document.getElementsByName(id+'_receivers[]')[0];
                $(timingSelects).prop('disabled', 0);
                $(receiverSelects).prop('disabled', 0);
                $('div.'+id).removeClass('m--hide');
                $('span.'+ id).html('<i class="la la-minus"></i>');
                $('.m_selectpicker').selectpicker('refresh');
            } else {
                $(this).val('off');
                $('input[name='+id+']').prop('disabled', !0);
                var timingSelects = document.getElementsByName(id+'_timing[]')[0];
                var receiverSelects = document.getElementsByName(id+'_receivers[]')[0];
                $(timingSelects).prop('disabled', !0);
                $(receiverSelects).prop('disabled', !0);
                $('div.'+id).addClass('m--hide');
                $('span.'+ id).html('<i class="la la-plus"></i>');
                $('.m_selectpicker').selectpicker('refresh');
            }
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