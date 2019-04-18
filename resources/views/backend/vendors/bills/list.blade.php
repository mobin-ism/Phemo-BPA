@php
    if (isset($filtered_bills))
        $bill_data = $filtered_bills;
    else
        $bill_data = $bills;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.bills')}}
            </h3>
        </div>
    </div>
</div>
<div class="m-portlet__body">
    <!--begin: Datatable -->
    <table class="table table-striped- table-bordered table-hover" id="m_table_1">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('web.bill_no')}}</th>
            <th>{{__('web.po_no')}}</th>
            <th>{{__('web.bill_date')}}</th>
            <th>{{__('web.due_date')}}</th>
            <th>{{__('web.amount')}}</th>
            <th>{{__('web.status')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bill_data as $key => $bill)
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="{{route('vendor.show_bill', $bill->id)}}" class="m-link">
                        {{$bill->bill_no}}
                    </a>
                </td>
                <td>{{$bill->po_no}}</td>
                <td>{{get_formatted_date_from_timestamp($bill->bill_date)}}</td>
                <td>{{get_formatted_date_from_timestamp($bill->due_date)}}</td>
                <td>{{get_config('currency')}} {{number_format($bill->grand_total, 2, '.', ',')}}</td>
                <td>
                    @php
                        if ($bill->status == 0) {
                            $status = 'unpaid';
                            $label = 'danger';
                        } else if ($bill->status == 1) {
                            $status = 'partially_paid';
                            $label = 'warning';
                        } else {
                            $status = 'paid';
                            $label = 'success';
                        } 
                    @endphp
                    <span class="m-badge m-badge--{{$label}}"data-container="body" data-toggle="m-tooltip" data-placement="top" title="" 
                        data-original-title="{{__('web.'.$status)}}"></span>
                </td>
                <td nowrap>
                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
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
                                                    {{__('web.quick_actions')}}
                                                </span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="{{route('vendor.show_bill', $bill->id)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                            {{__('web.details')}}
                                                    </span>
                                                </a>
                                            </li>
                                            @if ($bill->attachment != null)
                                            <li class="m-nav__item">
                                                <a href="{{route('vendor.download_bill_attachment', $bill->bill_no)}}" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-download"></i>
                                                    <span class="m-nav__link-text">
                                                            {{__('web.download_attachment')}}
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