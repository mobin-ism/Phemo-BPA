@if (is_permitted('employee_create'))
<form method="post" id="modal-form" action="{{route('employees.store')}}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
        <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_tabs_3_1" role="tab" aria-selected="true">{{__('web.personal')}}</a>
        </li>
        <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_3_2" role="tab" aria-selected="false">{{__('web.job')}}</a>
        </li>
    </ul>
    <div class="tab-content mt-5">
        <div class="tab-pane active show" id="m_tabs_3_1" role="tabpanel">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h4 class="text-muted">
                        {{__('web.basic_information')}}
                    </h4>
                    <hr>
                    <div class="form-group m-form__group" id="employee_no-group">
                        <label for="employee-no">
                            * {{__('web.employee_no')}}
                        </label>
                        <div class="input-group m-input-group m-input-group--pill">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    {{\App\Config::where('account_id', Auth::user()->account_id)->first()->employee_prefix}}
                                </span>
                            </div>
                            <input type="text" class="form-control m-input" id="employee-no" name="employee_no"
                                value="{{serialized_code('employee')}}">
                        </div>
                    </div>
                    <div class="form-group m-form__group" id="name-group">
                        <label for="name">
                            * {{__('web.name')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="name" name="name"
                            value="{{old('name')}}">
                    </div>
                    <div class="form-group m-form__group" id="surname-group">
                        <label for="surname">
                            * {{__('web.surname')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="surname" name="surname"
                            value="{{old('surname')}}">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="nationality">
                            {{__('web.nationality')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="nationality" name="nationality"
                            value="">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="gender">
                            {{__('web.gender')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                            name="gender" id="gender">
                            <option value="male">{{__('web.male')}}</option>
                            <option value="female">{{__('web.female')}}</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="birth-date">
                            {{__('web.birth_date')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="bday" 
                            id="birth-date" readonly>
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="marital-status">
                            {{__('web.marital_status')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                            name="marital_status" id="marital-status" title="{{__('web.select_one')}}">
                            <option value="married">{{__('web.married')}}</option>
                            <option value="single">{{__('web.single')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="text-muted">
                        {{__('web.additional_information')}}
                    </h4>
                    <hr>
                    <div class="form-group m-form__group" id="">
                        <label for="ethnicity">
                            {{__('web.ethnicity')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="ethnicity" name="ethnicity"
                            value="">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="religion">
                            {{__('web.religion')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="religion" name="religion"
                            value="">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="national-id">
                            {{__('web.national_id')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="national-id" name="nid"
                            value="">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="passport-no">
                            {{__('web.passport_no')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="passport-no" name="passport"
                            value="">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="tax-no">
                            {{__('web.tax_no')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="tax-no" name="tax_no"
                            value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="text-muted">
                        {{__('web.contact_information')}}
                    </h4>
                    <hr>
                    <div class="form-group m-form__group" id="email-group">
                        <label for="email">
                            * {{__('web.email')}}
                        </label>
                        <input type="email" class="form-control m-input m-input--pill" id="email" name="email"
                            value="{{old('email')}}">
                    </div>
                    <div class="form-group m-form__group" id="personal_phone-group">
                        <label for="personal-phone">
                            * {{__('web.phone')}} ({{__('web.personal')}})
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="personal-phone" name="personal_phone"
                            value="{{old('personal_phone')}}">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="office-phone">
                            {{__('web.phone')}} ({{__('web.office')}})
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="office-phone" name="office_phone"
                            value="{{old('office_phone')}}">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="house-phone">
                            {{__('web.phone')}} ({{__('web.house')}})
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="house-phone" name="house_phone"
                            value="{{old('house_phone')}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="text-muted">
                        {{__('web.emergency_contact')}}
                    </h4>
                    <hr>
                    <div class="form-group m-form__group" id="emergency_name-group">
                        <label for="emergency-name">
                            * {{__('web.name')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="emergency-name" name="emergency_name"
                            value="{{old('emergency_name')}}">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="emergency-email">
                            {{__('web.email')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="emergency-email" name="emergency_email"
                            value="{{old('emergency_email')}}">
                    </div>
                    <div class="form-group m-form__group" id="emergency_phone-group">
                        <label for="emergency-phone">
                            * {{__('web.phone')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="emergency-phone" name="emergency_phone"
                            value="{{old('emergency_phone')}}">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="emergency-address">
                            {{__('web.address')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="emergency-address" name="emergency_address"
                            value="{{old('emergency_address')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h4 class="text-muted">
                        {{__('web.employment_information')}}
                    </h4>
                    <hr>
                    <div class="form-group m-form__group" id="">
                        <label for="joining-date">
                            {{__('web.joining_date')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="joined_date" 
                            id="joining-date" readonly>
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="end-of-probation">
                            {{__('web.end_of_probation')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="probation_date" 
                            id="end-of-probation" readonly>
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="job-type">
                            {{__('web.job_type')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                            name="job_type_id" id="job-type" title="{{__('web.select_one')}}"
                                onchange="handleDynamicAdd('job_type_id')">
                            @foreach(\App\JobType::where('account_id', Auth::user()->account_id)->get() as $job_type)
                                <option value="{{$job_type->id}}">{{$job_type->name}}</option>
                            @endforeach
                            <option value="-1" data-icon="la la-plus"> {{__('web.new_job_type')}}</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="job-status">
                            {{__('web.job_status')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                            name="job_status_id" id="job-status" title="{{__('web.select_one')}}"
                                onchange="handleDynamicAdd('job_status_id')">
                            @foreach(\App\JobStatus::where('account_id', Auth::user()->account_id)->get() as $job_status)
                                <option value="{{$job_status->id}}">{{$job_status->name}}</option>
                            @endforeach
                            <option value="-1" data-icon="la la-plus"> {{__('web.new_job_status')}}</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="department">
                            {{__('web.department')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                            name="department_id" id="department" title="{{__('web.select_one')}}" data-live-search="true"
                                onchange="handleDynamicAdd('department_id')">
                            @foreach(\App\Department::where('account_id', Auth::user()->account_id)->get() as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                            <option value="-1" data-icon="la la-plus"> {{__('web.new_department')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="text-muted">
                        {{__('web.job_information')}}
                    </h4>
                    <hr>
                    <div class="form-group m-form__group" id="">
                        <label for="position">
                            {{__('web.position')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="position" name="position"
                            value="">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="line-manager">
                            {{__('web.line_manager')}}
                        </label>
                        <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                            name="line_manager" id="line-manager" title="{{__('web.select_one')}}">
                            @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                                <option value="{{$employee->user->name}}">
                                    {{$employee->user->name}} @if ($employee->department_id > 0) ({{$employee->department->name}}) @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="branch">
                            {{__('web.branch')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill" id="branch" name="branch"
                            value="">
                    </div>
                    <div class="form-group m-form__group" id="">
                        <label for="effective-date">
                            {{__('web.effective_date')}}
                        </label>
                        <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="effective_date" 
                            id="effective-date" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="form-group m-form__group row" id="dynamic-add">
    <label class="col-lg-2 col-form-label">{{__('web.name')}}</label>
    <div class="col-lg-5">
        <input type="text" class="form-control m-input" name="dynamic_add_name" placeholder="">
        <input type="hidden" name="dynamic_add_type" value="">
    </div>
    <div class="col-lg-4">
        <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill"
            onclick="saveDynamicAdd()">
            <i class="la la-check"></i>
        </a>
        <a href="#" class="btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill"
            onclick="removeDynamicAdd()">
            <i class="la la-close"></i>
        </a>
    </div>
</div>

@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('#dynamic-add').hide();
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });
    function handleDynamicAdd(type) {
        if ($('select[name='+type+']').val() == -1) {
            $('.modal-footer').hide();
            $('#modal-form').hide();
            $('#dynamic-add').fadeIn();
            $('input[name=dynamic_add_type]').val(type);
            $('input[name=dynamic_add_name]').val('');
            if (type == 'job_type_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.job_type')}}');
            else if (type == 'department_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.department')}}');
            else if (type == 'job_status_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.job_status')}}');
        }
    }

    function saveDynamicAdd() {
        var url = '{{route('employees.dynamic_add')}}';
        var data = {
            "_token": "{{ csrf_token() }}",
            "add_type": $('input[name=dynamic_add_type]').val(),
            "add_name": $('input[name=dynamic_add_name]').val()
        };
        $.post(url, data, function(response) {
            if (response.errors) {
                console.log(response.errors);
                $('#dynamic-add').addClass('has-danger');
            } else {
                $('#dynamic-add').removeClass('has-danger');
                handleSuccess(response);
            }
        }).fail(function(response) {
            console.log(response);
        });
    }

    function handleSuccess(response) {
        removeDynamicAdd();
        $('.modal-footer').fadeIn();
        switch (response.type) {
            case 'department':
                $('#department').prepend('<option value="'+ response.department_id+'" selected>'+ response.name +'</option>');
                $('#department').selectpicker('refresh');
                break;
            case 'jobType':
                $('#job-type').prepend('<option value="'+ response.job_type_id+'" selected>'+ response.name +'</option>');
                $('#job-type').selectpicker('refresh');
                break;
            case 'jobStatus':
                $('#job-status').prepend('<option value="'+ response.job_status_id+'" selected>'+ response.name +'</option>');
                $('#job-status').selectpicker('refresh');
                break;
        }
    }

    function removeDynamicAdd() {
        $('#dynamic-add').hide();
        $('#modal-form').fadeIn();
        $('.modal-footer').fadeIn();
        if ($('#department').val() == -1) {
            $('#department').val('');
            $('#department').selectpicker('refresh');
        } else if ($('#job-type').val() == -1) {
            $('#job-type').val('');
            $('#job-type').selectpicker('refresh');
        } else if ($('#job-status').val() == -1) {
            $('#job-status').val('');
            $('#job-status').selectpicker('refresh');
        }
    }
</script>
@endif