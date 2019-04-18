<form method="post" id="modal-form" action="{{route('employees.save_leave_entitlements')}}">
    @csrf
    {{ Form::hidden('employee_id', $employee->id) }}
    @foreach (\App\LeaveType::where('account_id', Auth::user()->account_id)->get() as $leave_type)
    @php
        $value = '';
        $checked = false;
        if ($employee->leave_allocation != null) {
            $allocations = json_decode($employee->leave_allocation);
            foreach ($allocations as $alloc) {
                if ($alloc->id == $leave_type->id) {
                    $value = $alloc->days;
                    $checked = true;
                }
            }
        }
    @endphp
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group">
                <label>
                    {{$leave_type->name}}
                </label>
                <span class="m-switch m-switch--icon pull-right">
                    <label>
                        <input type="checkbox" id="{{$leave_type->id}}" @if ($checked) checked @endif>
                        <span></span>
                    </label>
                </span>
                <input type="text" class="form-control m-input m-input--pill" name="days[]" value="{{$value}}"
                @if (!$checked) disabled @endif id="days-{{$leave_type->id}}">
                <input type="hidden" name="id[]" value="{{$leave_type->id}}"
                @if (!$checked) disabled @endif id="id-{{$leave_type->id}}">
                <input type="hidden" name="name[]" value="{{$leave_type->name}}"
                @if (!$checked) disabled @endif id="name-{{$leave_type->id}}">
            </div>
        </div>
    </div>
    @endforeach
</form>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('input[type=checkbox]').change(function() {
            var id = $(this).get(0).id;
            if ($(this).is(':checked')) {
                $('#days-' + id).removeAttr('disabled');
                $('#id-' + id).removeAttr('disabled');
                $('#name-' + id).removeAttr('disabled');
            } else {
                $('#days-' + id).attr('disabled', !0);
                $('#id-' + id).attr('disabled', !0);
                $('#name-' + id).attr('disabled', !0);
            }
        });
    });
</script>