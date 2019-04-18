<form method="post" id="modal-form" action="{{route('employees.update_job')}}">
    @csrf
    {{ Form::hidden('id', $employee->id) }}
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
                    id="joining-date" value="{{get_formatted_date_from_timestamp($employee->joined_date)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="end-of-probation">
                    {{__('web.end_of_probation')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="probation_date" 
                    id="end-of-probation" value="{{get_formatted_date_from_timestamp($employee->probation_date)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="job-type">
                    {{__('web.job_type')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="job_type_id" id="job-type" title="{{__('web.select_one')}}"
                        onchange="handleDynamicAdd('job_type_id')">
                    @foreach(\App\JobType::where('account_id', Auth::user()->account_id)->get() as $job_type)
                        <option value="{{$job_type->id}}" <?php if ($job_type->id == $employee->job_type_id) echo 'selected'; ?>>{{$job_type->name}}</option>
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
                        <option value="{{$job_status->id}}" <?php if ($job_status->id == $employee->job_status_id) echo 'selected'; ?>>{{$job_status->name}}</option>
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
                        <option value="{{ $department->id }}" <?php if ($employee->department_id == $department->id) echo 'selected'; ?>>{{ $department->name }}</option>
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
                    value="{{$employee->position}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="line-manager">
                    {{__('web.line_manager')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="line_manager" id="line-manager" title="{{__('web.select_one')}}">
                    @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $line_manager)
                        <?php
                            if ($employee->id == $line_manager->id) continue;
                        ?>
                        <option value="{{$line_manager->user->name}}" <?php if ($line_manager->user->name == $employee->user->name) echo 'selected'; ?>>
                            {{$line_manager->user->name}} @if ($line_manager->department_id > 0) ({{$line_manager->department->name}}) @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="branch">
                    {{__('web.branch')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="branch" name="branch"
                    value="{{$employee->branch}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="effective-date">
                    {{__('web.effective_date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="effective_date" 
                    id="effective-date" value="{{get_formatted_date_from_timestamp($employee->effective_date)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="exit-date">
                    {{__('web.exit_date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="exit_date" 
                    id="exit-date" value="{{get_formatted_date_from_timestamp($employee->exit_date)}}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-muted">
                {{__('web.payment_information')}}
            </h4>
            <hr>
            <div class="form-group m-form__group" id="">
                <label for="pay-status">
                    {{__('web.pay_status')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="pay_status_id" id="pay-status" title="{{__('web.select_one')}}" data-live-search="true"
                        onchange="handleDynamicAdd('pay_status_id')">
                    @foreach(\App\PayStatus::where('account_id', Auth::user()->account_id)->get() as $pay_status)
                        <option value="{{ $pay_status->id }}" <?php if ($employee->pay_status_id == $pay_status->id) echo 'selected'; ?>>{{ $pay_status->name }}</option>
                    @endforeach
                    <option value="-1" data-icon="la la-plus"> {{__('web.new_pay_status')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="pay-in-figures">
                    {{__('web.pay_in_figures')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="pay-in-figures" name="pay_in_figures"
                    value="{{$employee->pay_in_figures}}">
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
    $jvformat = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('#dynamic-add').hide();
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$jvformat}}',
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
            else if (type == 'pay_status_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.pay_status')}}');
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
            case 'payStatus':
                $('#pay-status').prepend('<option value="'+ response.pay_status_id+'" selected>'+ response.name +'</option>');
                $('#pay-status').selectpicker('refresh');
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
        } else if ($('#pay-status').val() == -1) {
            $('#pay-status').val('');
            $('#pay-status').selectpicker('refresh');
        }
    }
</script>