@php
    if (isset($filtered_leaves))
        $leave_data = $filtered_leaves;
    else
        $leave_data = $leaves;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.leave_requests')}}
            </h3>
        </div>
    </div>
</div>
<div class="m-portlet__body">
    <table class="table table-striped- table-bordered table-hover" id="m_table_1">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('web.employee')}}</th>
            <th>{{__('web.leave_type')}}</th>
            <th>{{__('web.start')}}</th>
            <th>{{__('web.end')}}</th>
            <th>{{__('web.days')}}</th>
            <th>{{__('web.status')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($leave_data as $key => $leave)
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="{{route('employees.show', $leave->employee_id)}}" class="m-link">
                        {{ \App\Employee::find($leave->employee_id)->user->name }}
                    </a>
                </td>
                <td>{{ \App\LeaveType::find($leave->leave_type_id)->name }}</td>
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
                    <span class="m-badge m-badge--{{$label}}" data-container="body" data-toggle="m-tooltip" data-placement="top" title=""
                        data-original-title="{{__('web.'.$status)}}"></span>
                </td>
                <td nowrap>
                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
                        m-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn btn-secondary m-btn m-btn--icon m-btn--pill">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="m-dropdown__wrapper" style="z-index: 101;">
                            <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust" style="right: auto; left: 29.5px;"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first">
                                                <span class="m-nav__section-text">
                                                    {{ __('web.quick_actions') }}
                                                </span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" onclick="presentModal('{{route('leaves.show', $leave->id)}}', '{{__('web.details')}}')"
                                                    class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.details') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @if ($leave->attachment != null)
                                                <li class="m-nav__item">
                                                    <a href="{{route('leaves.download', $leave->id)}}" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-download"></i>
                                                        <span class="m-nav__link-text">
                                                            {{ __('web.download_attachment') }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="m-nav__item">
                                                <a href="#" onclick="presentModal('{{route('leaves.edit', $leave->id)}}', '{{__('web.edit_leave_request')}}')"
                                                    class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.edit') }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="confirmModal('{{route('leaves.delete', $leave->id)}}')">
                                                    <i class="m-nav__link-icon flaticon-cancel"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.delete') }}
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    var DatatablesBasicBasic = {
    init: function() {
        $("#m_table_1").DataTable({
            responsive: !0,
            order: [
                [0, "asc"]
            ]
        });
    }
};
$(document).ready(function() {
    DatatablesBasicBasic.init()
});
</script>
