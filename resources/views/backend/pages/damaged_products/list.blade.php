@php
    if (isset($filtered_products))
        $product_data = $filtered_products;
    else
        $product_data = $damaged_products;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.damaged_products')}}
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
            <th>{{__('web.name')}}</th>
            <th>{{__('web.uom')}}</th>
            <th>{{__('web.quantity')}}</th>
            <th>{{__('web.date')}}</th>
            <th>{{__('web.notes')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($product_data as $key => $product)
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <a href="#" class="m-link"
                        onclick="presentModal('{{route('products.show', $product->product_id)}}', '{{__('web.details')}}')">
                        {{\App\Product::where('id', $product->product_id)->first()->name}}
                    </a>
                </td>
                <td>{{\App\Product::where('id', $product->product_id)->first()->unit_of_measure->name}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{get_formatted_date_from_timestamp($product->date)}}</td>
                <td>{{$product->notes}}</td>
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
                                            @if(is_permitted('damaged_product_edit'))
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="presentModal('{{route('damaged_products.edit', $product->id)}}', '{{__('web.edit_damaged_product')}}')">
                                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                                    <span class="m-nav__link-text">
                                                        {{ __('web.edit') }}
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if(is_permitted('damaged_product_delete'))
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="confirmModal('{{route('damaged_products.delete', $product->id)}}')">
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