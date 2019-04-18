<div class="row mb-4">
    <div class="col">
        <span>{{__('web.employee')}}</span><br>
        <span class="m--font-bolder">{{\App\Employee::find($leave->employee_id)->user->name}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.leave_type')}}</span><br>
        <span class="m--font-bolder">{{\App\LeaveType::find($leave->leave_type_id)->name}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.start_date')}}</span><br>
        <span class="m--font-bolder">{{get_formatted_date_from_timestamp($leave->start)}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.end_date')}}</span><br>
        <span class="m--font-bolder">{{get_formatted_date_from_timestamp($leave->end)}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.days')}}</span><br>
        <span class="m--font-bolder">{{$leave->days}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.reason')}}</span><br>
        <span class="m--font-bolder">{{$leave->reason}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.status')}}</span><br>
        <span class="m--font-bolder">
            @php
                if ($leave->status == 0) echo __('web.pending');
                else if ($leave->status == 1) echo __('web.accepted');
                else echo __('web.rejected');
            @endphp
        </span>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
</script>