<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('web.start')}}</th>
                <th>{{__('web.end')}}</th>
                <th>{{__('web.days')}}</th>
                <th>{{__('web.status')}}</th>
                <th>{{__('web.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach (\App\Leave::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->get() as $key => $leave)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{get_formatted_date_from_timestamp($leave->start)}}</td>
                <td>{{get_formatted_date_from_timestamp($leave->end)}}</td>
                <td>{{$leave->days}}</td>
                <td align="center">
                    @php
                        if ($leave->status == '0') {
                            $status = 'pending';
                            $label = 'warning';
                        } else if ($leave->status == '1') {
                            $status = 'accepted';
                            $label = 'success';
                        } else {
                            $status = 'rejected';
                            $label = 'danger';
                        }
                    @endphp
                    <span class="m-badge m-badge--{{$label}}"data-container="body" data-toggle="m-tooltip" data-placement="top" title="" 
                        data-original-title="{{__('web.'.$status)}}"></span>
                </td>
                <td>
                    <a href="#" class="btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only m-btn--pill"
                        onclick="presentModal('{{route('leaves.show', $leave->id)}}', '{{__('web.details')}}')">
                        <i class="la la-info"></i>
                    </a>
                    @if (is_permitted('leave_edit'))
                    <a href="#" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--pill"
                        onclick="presentModal('{{route('leaves.edit', $leave->id)}}', '{{__('web.edit_leave_request')}}')">
                        <i class="la la-edit"></i>
                    </a>
                    @endif
                    @if (is_permitted('leave_delete'))
                    <a href="#" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill"
                        onclick="confirmModal('{{route('leaves.delete', $leave->id)}}')">
                        <i class="la la-trash"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>