@php
    if (isset($filtered_quotes))
        $quote_data = $filtered_quotes;
    else
        $quote_data = $quotes;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.quotes')}}
            </h3>
        </div>
    </div>
</div>
<div class="m-portlet__body">
    <table class="table table-striped- table-bordered table-hover" id="m_table_1">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('web.quote_no')}}</th>
            <th>{{__('web.customer')}}</th>
            <th>{{__('web.issue_date')}}</th>
            <th>{{__('web.expiry_date')}}</th>
            <th>{{__('web.status')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quote_data as $key => $quote)
            @php
                $customer = \App\Customer::where('id', $quote->customer_id)->first();
                $name = $customer->customer_type == 'company' ? $customer->company_name : $customer->customer_name;
            @endphp
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="{{route('quotes.show', $quote)}}" class="m-link">
                        {{get_config('quotation_prefix')}}-{{$quote->quote_no}}
                    </a>
                </td>
                <td>
                    <a href="{{route('customers.show', $quote->customer_id)}}" class="m-link">
                        {{$name}}
                    </a>
                </td>
                <td>{{get_formatted_date_from_timestamp($quote->issue_date)}}</td>
                <td>{{get_formatted_date_from_timestamp($quote->expiry_date)}}</td>
                <td align="center">
                    @php
                        if ($quote->status == 'rejected') {
                            $status = 'rejected';
                            $label = 'danger';
                        } else if ($quote->status == 'pending') {
                            $status = 'pending';
                            $label = 'warning';
                        } else if ($quote->status == 'active') {
                            $status = 'active';
                            $label = 'primary';
                        } else if ($quote->status == 'invoiced') {
                            $status = 'invoiced';
                            $label = 'success';
                        } else {
                            $status = 'approved';
                            $label = 'info';
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
                                            <li class="m-nav__item">
                                                <a href="{{route('quotes.show', $quote)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.details') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @if(is_permitted('quote_edit'))
                                            <li class="m-nav__item">
                                                <a href="{{route('quotes.edit', $quote)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.edit') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if(is_permitted('quote_delete'))
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="confirmModal('{{route('quotes.delete', $quote->id)}}')">
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
