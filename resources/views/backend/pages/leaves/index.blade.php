@extends('backend.layouts.master')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.leave_management')}}</h3>
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
    <div class="row mb-3">
        <div class="col">
            <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air pull-right"
                onclick="presentModal('{{route('leaves.create')}}', '{{__('web.new_leave_request')}}')">
                <span>
                    <i class="la la-plus"></i>
                    <span>{{__('web.new_leave_request')}}</span>
                </span>
            </a>
        </div>
    </div>
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-4">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.employees')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.total_employees')}}
                            </span>
                            <span class="m-widget24__stats m--font-primary">
                                {{ \App\Employee::where(['account_id' => Auth::user()->account_id, 'status' => '1'])->count() }}
                            </span>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.on_leave')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.today')}}
                            </span>
                            <span class="m-widget24__stats m--font-danger">
                                {{on_leave_today()}}
                            </span>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.pending_requests')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.total_pending')}}
                            </span>
                            <span class="m-widget24__stats m--font-warning">
                                {{ \App\Leave::where(['account_id' => Auth::user()->account_id, 'status' => 0])->count() }}
                            </span>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                {{-- <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{__('web.on_leave')}}
                            </h4><br>
                            <span class="m-widget24__desc">
                                {{__('web.tomorrow')}}
                            </span>
                            <span class="m-widget24__stats m--font-brand">
                                0
                            </span>
                            <div class="m--space-30"></div>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div> --}}
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head" style="border: none;">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text" onclick="toggleSection('leaves-filter')" style="cursor: pointer;">
                        <span class="leaves-filter"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.filter_options')}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body leaves-filter m--hide">
            <div class="row mb-3">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group m-form__group" id="">
                        <label>
                            {{__('web.employee')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="employee_id" id="employee_id"
                            data-live-search="true">
                            <option value="">{{__('web.all')}}</option>
                            @foreach (\App\Employee::where(['account_id' => Auth::user()->account_id, 'status' => 1])->get() as $employee)
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
                            {{__('web.leave_type')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="leave_type_id" id="leave_type_id">
                            <option value="">{{__('web.all')}}</option>
                            @foreach (\App\LeaveType::where('account_id', Auth::user()->account_id)->get() as $leave_type)
                            <option value="{{$leave_type->id}}">
                                {{$leave_type->name}}
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
                            <option value="0">{{__('web.pending')}}</option>
                            <option value="1">{{__('web.accepted')}}</option>
                            <option value="2">{{__('web.rejected')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group m-form__group" id="">
                        <label>
                            {{__('web.date')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="date" 
                            id="date" readonly>
                    </div>
                </div>
            </div>
            <div class="row text-center mt-4">
                <div class="col">
                    <button type="button" class="btn btn-info m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                        id="leaves-filter-button">
                        <span>
                            <i class="la la-filter"></i>
                            <span>{{__('web.apply_filter')}}</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile" id="leaves-list">
        @include('backend.pages.leaves.list')
    </div>
</div>

@endsection

@section('script')
@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    var leavesFilterRoute = '{{route('leaves.filter')}}';
    $(document).ready(function() {
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}'
        });
        $('#leaves-filter-button').on('click', function() {
            $(this).addClass('m-loader m-loader--right').attr('disabled', !0);
            var filterParams = {
                '_token': '{{ csrf_token() }}',
                'account_id': '{{Auth::user()->account_id}}',
                'date': $('#date').val(),
                'leave_type_id': $('#leave_type_id').val(),
                'employee_id': $('#employee_id').val(),
                'status': $('#status').val()
            };
            $.post(leavesFilterRoute, filterParams, function(response) {
                $('#leaves-list').html(response);
                $('#leaves-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
            }).fail(function(response) {
                console.log(response);
                $('#leaves-filter-button').removeClass('m-loader m-loader--right').removeAttr('disabled');
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