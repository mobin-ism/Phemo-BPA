@if (is_permitted('payroll_create'))
@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.new_payroll')}}</h3>
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
                </ul>
            </div>
        </div>
    </div>
    <form action="{{route('payrolls.store')}}" method="post">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="m-content">
        @if($errors->has('salary'))
            <div class="row text-center">
                <div class="col">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>You must add a basic salary to the employee before creating payslip for that employee</strong>
                    </div>
                </div>
            </div>
        @endif
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
                        <div class="form-group m-form__group @if($errors->has('month')) has-danger @endif" id="">
                            <label>
                                * {{__('web.month')}}
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
                        <div class="form-group m-form__group @if($errors->has('year')) has-danger @endif" id="">
                            <label>
                                * {{__('web.year')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="year" id="year">
                                @for ($i = 0; $i < 12; $i++ )
                                <option value="{{(2018 + $i)}}" <?php if (date('Y') == (2018 + $i)) echo 'selected';?>>{{(2018 + $i)}}</option>
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
                                <option value="">{{__('web.all')}}</option>
                                @foreach (\App\Department::where('account_id', Auth::user()->account_id)->get() as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group m-form__group @if($errors->has('employee_id')) has-danger @endif" id="employee_id-group">
                            <label>
                                * {{__('web.employee')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="employee_id" id="employee_id"
                                title="{{__('web.select_one')}}">
                                @foreach (\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                                <option value="{{$employee->id}}">{{$employee->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="form-group m-form__group @if($errors->has('status')) has-danger @endif" id="status-group">
                            <label>
                                * {{__('web.status')}}
                            </label>
                            <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker" name="status" id="status">
                                <option value="0">{{__('web.unpaid')}}</option>
                                <option value="1">{{__('web.paid')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="salary-details-section">
            @include('backend.pages.payrolls.heads')
        </div>
    </div>
</form>

@endsection

@section('script')
    <script>
        var employeeFilterRoute = '{{route('payrolls.filter_employee')}}';
        var salaryHeadRoute = '{{route('payrolls.heads')}}';
        $(document).ready(function() {
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
            $('#employee_id').on('change', function() {
                var employee_id = $(this).val();
                var params = {
                    '_token': '{{ csrf_token() }}',
                    'employee_id': employee_id
                };
                $.post(salaryHeadRoute, params, function(response) {
                    $('#salary-details-section').html(response);
                }).fail(function(response) {
                    console.log(response);
                });
            });
        });
    </script>
@endsection
@endif