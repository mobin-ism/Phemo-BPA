@php
    if (!isset($count)) {
        $count = '1';
    }
@endphp
<div class="entry-row" id="{{$count}}">
    <div class="row mb-4">
        <div class="col-lg-2 col-md-2">
            <div class="form-group m-form__group" id="">
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="item_select[]" id="item-select" title="{{__('web.select_one')}}" data-live-search="true"
                        onchange="itemChanged(this.value, '{{$count}}')">
                    @foreach(\App\Product::where('account_id', Auth::user()->account_id)->get() as $product)
                        <option value="product-{{$product->id}}" 
                            <?php if (isset($info)) {if ($type.'-'.$info->id == 'product-'.$product->id) echo 'selected';} ?>>
                            {{$product->name}}
                        </option>
                    @endforeach
                    @foreach(\App\Service::where('account_id', Auth::user()->account_id)->get() as $service)
                        <option value="service-{{$service->id}}"
                            <?php if (isset($info)) {if ($type.'-'.$info->id == 'service-'.$service->id) echo 'selected';} ?>>
                            {{$service->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="item[]" value="">
        </div>
        <div class="col-lg-2 col-md-2">
            <div class="form-group m-form__group" id="">
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="expense_type_id[]" id="type" title="{{__('web.select_one')}}" data-live-search="true">
                    @foreach (\App\ExpenseType::where('account_id', Auth::user()->account_id)->get() as $expense_type)
                    <option value="{{$expense_type->id}}">{{$expense_type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @php
            $uom = '';
            if (isset($info)) {
                $uom = $info->unit_of_measure->name;
            }
        @endphp
        <div class="col-lg-1 col-md-1">
            <div class="form-group m-form__group" id="">
                <input type="text" class="form-control m-input m-input--pill" id="uom"
                    name="uom[]" value="{{$uom}}" readonly>
            </div>
        </div>
        <div class="col-lg-1 col-md-1">
            <div class="form-group m-form__group" id="">
                <input type="number" class="form-control m-input m-input--pill" id="qty-{{$count}}"
                    name="qty[]" value="1" min="1" onkeyup="calculateItemPrice('{{$count}}')">
            </div>
        </div>
        @php
            $price = '0';
            if (isset($info)) {
                $price = ($type == 'product') ? $info->purchase_price : $info->rate;
            }
        @endphp
        <div class="col-lg-1 col-md-1">
            <div class="form-group m-form__group" id="">
                <input type="text" class="form-control m-input m-input--pill" id="price-{{$count}}"
                    name="price[]" value="{{$price}}" onkeyup="calculateItemPrice('{{$count}}')">
            </div>
        </div>
        <div class="col-lg-1 col-md-1">
            <div class="form-group m-form__group" id="">
                <input type="text" class="form-control m-input m-input--pill" id="discount-{{$count}}"
                    name="discount[]" value="0" onkeyup="calculateItemPrice('{{$count}}')">
            </div>
        </div>
        <div class="col-lg-2 col-md-2">
            <div class="form-group m-form__group" id="">
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="tax[]" id="tax-{{$count}}" title="{{__('web.select')}}" onchange="calculateItemPrice('{{$count}}')">
                    @foreach(\App\Tax::where('account_id', Auth::user()->account_id)->get() as $tax)
                        <option value="{{$tax->percentage}}" data-tax-id="{{$tax->id}}">
                            {{$tax->name}} ({{$tax->percentage}}%)
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="tax_id[]" value="" id="tax-id-{{$count}}">
        </div>
        @php
            $total = '0';
            if (isset($info)) {
                $total = $info->total;
            }
        @endphp
        <div class="col-lg-1 col-md-1">
            <div class="form-group m-form__group" id="">
                <input type="text" class="form-control m-input m-input--pill" id="total-{{$count}}"
                    name="total[]" value="{{$total}}" readonly>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 text-center">
            <div class="form-group m-form__group" id="delete-{{$count}}">
                <a href="#" style="text-decoration: none;"
                    onclick="deleteEntry('{{$count}}')">
                    <i class="flaticon-cancel m--font-danger"></i>
                </a>
            </div>
        </div>
    </div>
</div>