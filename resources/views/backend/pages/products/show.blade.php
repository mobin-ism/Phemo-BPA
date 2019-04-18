@if (is_permitted('product_view'))
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.code')}}</span><br>
        <span class="m--font-bolder">{{$product->code}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.name')}}</span><br>
        <span class="m--font-bolder">{{$product->name}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.description')}}</span><br>
        <span class="m--font-bolder">{{$product->description}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.purchase_price')}}</span><br>
        <span class="m--font-bolder">{{get_config('currency')}} {{number_format($product->purchase_price, 2, '.', ',')}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.sales_price')}}</span><br>
        <span class="m--font-bolder">{{get_config('currency')}} {{number_format($product->sales_price, 2, '.', ',')}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.quantity')}}</span><br>
        <span class="m--font-bolder">{{$product->quantity}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('web.unit_of_measure')}}</span><br>
        <span class="m--font-bolder">{{$product->unit_of_measure_id > 0 ? $product->unit_of_measure->name : ''}}</span>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').hide();
    });
</script>
@endif