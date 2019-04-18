@php
    if (isset($filtered_payrolls))
        $payroll_data = $filtered_payrolls;
    else
        $payroll_data = $payrolls;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.payrolls')}}
            </h3>
        </div>
    </div>
</div>
<div class="m-portlet__body">
    <table class="table table-striped- table-bordered table-hover" id="m_table_1">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('web.code')}}</th>
            <th>{{__('web.name')}}</th>
            <th>{{__('web.salary')}}</th>
            <th>{{__('web.benefits')}}</th>
            <th>{{__('web.deductions')}}</th>
            <th>{{__('web.net_salary')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payroll_data as $key => $payroll)
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="{{route('payrolls.show', $payroll)}}" class="m-link">
                        {{$payroll->code}}
                    </a>
                </td>
                <td>
                    <a href="{{route('employees.show', $payroll->employee_id)}}" class="m-link">
                        {{\App\Employee::find($payroll->employee_id)->user->name}}
                    </a>
                </td>
                <td>{{get_config('currency')}} {{number_format($payroll->salary, 2, '.', ',')}}</td>
                <td>
                    @if($payroll->benefits == null)
                    {{get_config('currency')}} 0.0
                    @else
                    {{get_config('currency')}} {{number_format(benefits_deductions_sum($payroll->benefits), 2, '.', ',')}}
                    @endif
                </td>
                <td>
                    @if($payroll->deductions == null)
                    {{get_config('currency')}} 0.0
                    @else
                    {{get_config('currency')}} {{number_format(benefits_deductions_sum($payroll->deductions), 2, '.', ',')}}
                    @endif
                </td>
                <td>{{get_config('currency')}} {{number_format($payroll->net_salary, 2, '.', ',')}}</td>
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
                                            @if (is_permitted('payroll_view'))
                                            <li class="m-nav__item">
                                                <a href="{{route('payrolls.show', $payroll)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.details') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if ($payroll->status == 0)
                                            @if (is_permitted('payroll_edit'))
                                            <li class="m-nav__item">
                                                <a href="{{route('payrolls.edit', $payroll)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.edit') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if (is_permitted('payroll_delete'))
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="confirmModal('{{route('payrolls.delete', $payroll->id)}}')">
                                                    <i class="m-nav__link-icon flaticon-cancel"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.delete') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @endif
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
