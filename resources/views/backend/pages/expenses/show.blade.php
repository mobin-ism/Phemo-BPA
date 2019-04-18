@if (is_permitted('expense_view'))
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <span>{{__('web.reference')}}</span><br>
        <span class="m--font-bolder">{{$expense->reference}}</span><br><br>
        <span>{{__('web.date')}}</span><br>
        <span class="m--font-bolder">{{get_formatted_date_from_timestamp($expense->date)}}</span><br><br>
        <span>{{__('web.category')}}</span><br>
        <span class="m--font-bolder">{{$expense->expense_type->name}}</span><br><br>
        <span>{{__('web.amount')}}</span><br>
        <span class="m--font-bolder">{{get_config('currency')}} {{number_format($expense->amount, 2, '.', ',')}}</span><br><br>
        <span>{{__('web.tax_amount')}}</span><br>
        <span class="m--font-bolder">{{get_config('currency')}} {{number_format($expense->tax_amount, 2, '.', ',')}}</span><br><br>
        <span>{{__('web.tip')}}</span><br>
        <span class="m--font-bolder">{{get_config('currency')}} {{number_format($expense->tip, 2, '.', ',')}}</span><br><br>
        <span>{{__('web.total')}}</span><br>
        <span class="m--font-bolder">{{get_config('currency')}} {{number_format(($expense->total), 2, '.', ',')}}</span><br><br>
        <span>{{__('web.paid_through')}}</span><br>
        <span class="m--font-bolder">{{__('web.'.$expense->paid_through)}}</span>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <span>{{__('web.vendor')}}</span><br>
        <span class="m--font-bolder">{{$expense->vendor_id == null ? '' : $expense->vendor->name}}</span><br><br>
        @php
            if ($expense->customer_id != null) {
                $customer = $expense->customer->customer_type == 'company' ? $expense->customer->company_name : $expense->customer->customer_name;
            } else {
                $customer = '';
            }
        @endphp
        <span>{{__('web.customer')}}</span><br>
        <span class="m--font-bolder">{{$customer}}</span><br><br>
        <span>{{__('web.notes')}}</span><br>
        <span class="m--font-bolder">{{$expense->notes}}</span><br><br>
        @if ($expense->attachment != null)
        @php
            $attachment = explode('/', $expense->attachment);
        @endphp
        <span>{{__('web.attachment')}}</span><br>
        <span class="m--font-bolder">
            <a href="{{route('expenses.download', $expense->id)}}" class="m-link">
                {{end($attachment)}}
            </a>    
        </span><br><br>
        @endif
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
</script>
@endif