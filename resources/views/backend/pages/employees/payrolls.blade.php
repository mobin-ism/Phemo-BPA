@php
    if (isset($filtered_payrolls))
        $payrolls = $filtered_payrolls;
    else
        $payrolls = \App\Payroll::where([
            'employee_id' => $employee->id,
            'year' => date('Y'),
            'month' => date('m')
        ])->get();
@endphp
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('web.code')}}</th>
                <th>{{__('web.salary')}}</th>
                <th>{{__('web.benefits')}}</th>
                <th>{{__('web.deductions')}}</th>
                <th>{{__('web.net_salary')}}</th>
                <th>{{__('web.status')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payrolls as $key => $payroll)
            <tr>
                <td>{{$key+1}}</td>
                <td>
                    <a href="{{route('payrolls.show', $payroll)}}" class="m-link">
                        {{$payroll->code}}
                    </a>
                </td>
                <td>{{get_config('currency')}} {{number_format($payroll->salary, 2, '.', ',')}}</td>
                <td>{{get_config('currency')}} @if($payroll->benefits == null) 0.0 @else {{number_format(benefits_deductions_sum($payroll->benefits), 2, '.', ',')}} @endif</td>
                <td>{{get_config('currency')}} @if($payroll->deductions == null) 0.0 @else {{number_format(benefits_deductions_sum($payroll->deductions), 2, '.', ',')}} @endif</td>
                <td>{{get_config('currency')}} {{number_format($payroll->net_salary, 2, '.', ',')}}</td>
                <td align="center">
                    @php
                        if ($payroll->status == 0) {
                            $status = 'unpaid';
                            $label = 'danger';
                        } else {
                            $status = 'paid';
                            $label = 'success';
                        } 
                    @endphp
                    <span class="m-badge m-badge--{{$label}}"data-container="body" data-toggle="m-tooltip" data-placement="top" title="" 
                        data-original-title="{{__('web.'.$status)}}"></span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>