@if (is_permitted('expense_view'))
@php
    if (isset($filtered_expenses))
        $expense_data = $filtered_expenses;
    else
        $expense_data = $expenses;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.expenses')}}
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
            <th>{{__('web.reference')}}</th>
            <th>{{__('web.date')}}</th>
            <th>{{__('web.amount')}}</th>
            <th>{{__('web.tax_amount')}}</th>
            <th>{{__('web.tip')}}</th>
            <th>{{__('web.total')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($expense_data as $key => $expense)
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="#" class="m-link"
                        onclick="presentModal('{{route('expenses.show', $expense)}}', '{{__('web.details')}}')">
                        {{$expense->reference}}
                    </a>
                </td>
                <td>{{get_formatted_date_from_timestamp($expense->date)}}</td>
                <td>{{get_config('currency')}} {{number_format($expense->amount, 2, '.', ',')}}</td>
                <td>{{get_config('currency')}} {{number_format($expense->tax_amount, 2, '.', ',')}}</td>
                <td>{{get_config('currency')}} {{number_format($expense->tip, 2, '.', ',')}}</td>
                <td class="m--font-bolder">
                    {{get_config('currency')}} {{number_format(($expense->total), 2, '.', ',')}}
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
                                                <a href="#" class="m-nav__link"
                                                    onclick="presentModal('{{route('expenses.show', $expense)}}', '{{__('web.details')}}')">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.details') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @if ($expense->attachment != null)
                                                <li class="m-nav__item">
                                                    <a href="{{route('expenses.download', $expense->id)}}" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-download"></i>
                                                        <span class="m-nav__link-text">
                                                            {{ __('web.download_receipt') }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (is_permitted('expense_edit'))
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="presentModal('{{route('expenses.edit', $expense)}}', '{{__('web.edit_expense')}}')">
                                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.edit') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if (is_permitted('expense_delete'))
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="confirmModal('{{route('expenses.delete', $expense->id)}}')">
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
@endif