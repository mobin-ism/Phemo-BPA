@php
    if (isset($filtered_quotes))
        $quotes = $filtered_quotes;
    else
        $quotes = \App\Quote::where('customer_id', $customer->id)->orderBy('issue_date', 'desc')->get();
@endphp
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('web.quote_no')}}</th>
                <th>{{__('web.issue_date')}}</th>
                <th>{{__('web.expiry_date')}}</th>
                <th>{{__('web.status')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotes as $key => $quote)
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="{{route('quotes.show', $quote)}}" class="m-link">
                        {{$quote->quote_no}}
                    </a>
                </td>
                <td>{{get_formatted_date_from_timestamp($quote->issue_date)}}</td>
                <td>{{get_formatted_date_from_timestamp($quote->expiry_date)}}</td>
                <td align="center">
                    @php
                        if ($quote->status == 'expired') {
                            $status = 'expired';
                            $label = 'danger';
                        } else if ($quote->status == 'pending') {
                            $status = 'pending';
                            $label = 'warning';
                        } else if ($quote->status == 'active') {
                            $status = 'active';
                            $label = 'primary';
                        } else {
                            $status = 'invoiced';
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