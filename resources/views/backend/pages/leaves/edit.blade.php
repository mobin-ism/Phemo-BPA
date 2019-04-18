<form method="post" id="modal-form" action="{{ route('leaves.update', $leave->id) }}">
    @csrf
    {{method_field('PATCH')}}
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="employee_id-group">
                <label for="employee-id">
                    * {{__('web.employee')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="employee_id" id="employee-id">
                    @foreach (\App\Employee::where(['account_id' => Auth::user()->account_id, 'status' => 1])->get() as $employee)
                    <option value="{{$employee->id}}" <?php if ($leave->employee_id == $employee->id) echo 'selected'; ?>>{{$employee->user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group" id="leave_type_id-group">
                <label for="leave-type-id">
                    * {{__('web.leave_type')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    title="{{__('web.select_one')}}" name="leave_type_id" id="leave-type-id"
                        onchange="handleDynamicAdd('leave_type_id')">
                    @foreach (\App\LeaveType::where('account_id', Auth::user()->account_id)->get() as $leave_type)
                    <option value="{{$leave_type->id}}" <?php if ($leave->leave_type_id == $leave_type->id) echo 'selected'; ?>>{{$leave_type->name}}</option>
                    @endforeach
                    <option value="-1" data-icon="la la-plus"> {{__('web.new_leave_type')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="start-group">
                <label for="start">
                    * {{__('web.start')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="start" 
                    id="start" readonly value="{{get_formatted_date_from_timestamp($leave->start)}}">
            </div>
            <div class="form-group m-form__group" id="end-group">
                <label for="end">
                    * {{__('web.end')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="end" 
                    id="end" readonly value="{{get_formatted_date_from_timestamp($leave->end)}}">
            </div>
            <div class="form-group m-form__group" id="status-group">
                <label for="status">
                    * {{__('web.status')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="status" id="status">
                    <option value="0" <?php if ($leave->status == 0) echo 'selected'; ?>>{{__('web.pending')}}</option>
                    <option value="1" <?php if ($leave->status == 1) echo 'selected'; ?>>{{__('web.accepted')}}</option>
                    <option value="2" <?php if ($leave->status == 2) echo 'selected'; ?>>{{__('web.rejected')}}</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="reason-group">
                <label for="reason">
                    * {{__('web.reason')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="reason" name="reason" rows="5">{{$leave->reason}}</textarea>
            </div>
            <div class="form-group m-form__group">
                <label>{{__('web.attachment')}}</label>
                <div></div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="attachment" accept="application/pdf, .jpg" name="attachment">
                    <label class="custom-file-label" for="attachment">{{__('web.choose')}}</label>
                </div>
                <p class="filename mt-3"></p>
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
        $('input[type=file]').on('change', function() {
            $('.filename').html($(this).val());
        });
    });
    function handleDynamicAdd(type) {
        if ($('select[name='+type+']').val() == -1) {
            $('.modal-footer').hide();
            $('#modal-form').hide();
            $('#dynamic-add').fadeIn();
            $('input[name=dynamic_add_type]').val(type);
            $('input[name=dynamic_add_name]').val('');
            if (type == 'leave_type_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.leave_type')}}');
        }
    }

    function saveDynamicAdd() {
        var url = '{{route('leaves.dynamic_add')}}';
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
            case 'leave_type':
                $('#leave-type-id').prepend('<option value="'+ response.leave_type_id+'" selected>'+ response.name +'</option>');
                $('#leave-type-id').selectpicker('refresh');
                break;
        }
    }

    function removeDynamicAdd() {
        $('#dynamic-add').hide();
        $('#modal-form').fadeIn();
        $('.modal-footer').fadeIn();
        if ($('#leave-type-id').val() == -1) {
            $('#leave-type-id').val('');
            $('#leave-type-id').selectpicker('refresh');
        }
    }
</script>