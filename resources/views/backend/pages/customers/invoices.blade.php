@php
    if (isset($filtered_invoices))
        $invoices = $filtered_invoices;
    else
        $invoices = \App\Invoice::where('customer_id', $customer->id)->orderBy('issue_date', 'desc')->get();
@endphp
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('web.invoice_no')}}</th>
                <th>{{__('web.issue_date')}}</th>
                <th>{{__('web.due_date')}}</th>
                <th>{{__('web.amount')}}</th>
                <th>{{__('web.status')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $key => $invoice)
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="{{route('invoices.show', $invoice)}}" class="m-link">
                        {{$invoice->invoice_no}}
                    </a>
                </td>
                <td>{{get_formatted_date_from_timestamp($invoice->issue_date)}}</td>
                <td>{{get_formatted_date_from_timestamp($invoice->due_date)}}</td>
                <td>{{get_config('currency')}} {{number_format($invoice->grand_total, 2, '.', ',')}}</td>
                <td align="center">
                    @php
                        if ($invoice->status == 'paid') {
                            $status = 'paid';
                            $label = 'success';
                        } else if ($invoice->status == 'unpaid') {
                            $status = 'unpaid';
                            $label = 'danger';
                        } else {
                            $status = 'partially_paid';
                            $label = 'warning';
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