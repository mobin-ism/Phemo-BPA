@php
    if (isset($filtered_invoices))
        $invoice_data = $filtered_invoices;
    else
        $invoice_data = $invoices;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.invoices')}}
            </h3>
        </div>
    </div>
</div>
<div class="m-portlet__body">
    <table class="table table-striped- table-bordered table-hover" id="m_table_1">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('web.invoice_no')}}</th>
            <th>{{__('web.customer')}}</th>
            <th>{{__('web.issue_date')}}</th>
            <th>{{__('web.due_date')}}</th>
            <th>{{__('web.amount')}}</th>
            <th>{{__('web.status')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoice_data as $key => $invoice)
            @php
                $isOverdue = false;
                $customer = \App\Customer::where('id', $invoice->customer_id)->first();
                $name = ($customer->customer_type == 'company') ? $customer->company_name : $customer->customer_name;
                if ($invoice->due_date < strtotime(date('d-m-Y')) && ($invoice->status == 'unpaid' || $invoice->status == 'partially_paid')) {
                    $isOverdue = true;
                    $today = date('d-m-Y');
                    $due_date = date('d-m-Y', $invoice->due_date);
                    $today = new DateTime($today);
                    $due_date = new DateTime($due_date);
                    $diff = $today->diff($due_date);
                }
            @endphp
            <tr @if($isOverdue) style="background-color: rgba(244, 81, 108, 0.1);"  @endif>
                <td>
                    {{$key + 1}}
                </td>
                <td>
                    <a href="{{route('invoices.show', $invoice)}}" class="m-link">
                        {{get_config('invoice_prefix')}}-{{$invoice->invoice_no}}
                    </a>
                </td>
                <td>
                    <a href="{{route('customers.show', $invoice->customer_id)}}" class="m-link">
                        {{$name}}
                    </a>
                </td>
                <td>{{get_formatted_date_from_timestamp($invoice->issue_date)}}</td>
                <td>
                    {{get_formatted_date_from_timestamp($invoice->due_date)}}
                    @if ($isOverdue)
                    <br>
                    <span class="m--font-danger m--font-boldest">Due {{$diff->d}} days ago</span>
                    @endif
                </td>
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
                                            @if(is_permitted('invoice_view'))
                                            <li class="m-nav__item">
                                                <a href="{{route('invoices.show', $invoice)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.details') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if (is_permitted('invoice_edit'))
                                            <li class="m-nav__item">
                                                <a href="{{route('invoices.edit', $invoice)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.edit') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if (is_permitted('invoice_delete'))
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="confirmModal('{{route('invoices.delete', $invoice->id)}}')">
                                                    <i class="m-nav__link-icon flaticon-cancel"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.delete') }}
                                                    </span>
                                                </a>
                                            </li>
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