@if(is_permitted('damaged_product_create'))
<form method="post" id="modal-form" action="{{ route('damaged_products.store') }}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="product_id-group">
                <label for="product-id">
                    * {{__('web.product')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="product_id" id="product-id">
                    @foreach (\App\Product::where('account_id', Auth::user()->account_id)->get() as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group" id="quantity-group">
                <label for="quantity">
                    * {{__('web.quantity')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="quantity" name="quantity">
            </div>
            <div class="form-group m-form__group" id="date-group">
                <label for="date">
                    * {{__('web.date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="date" 
                    id="date" readonly>
            </div>
            <div class="m-form__group form-group">
                <div class="m-checkbox-list">
                    <label class="m-checkbox m-checkbox--state-brand">
                        <input type="checkbox" name="reduce"> {{__('web.reduce_stock_quantity')}}
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="notes-group">
                <label for="notes">
                    * {{__('web.notes')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="notes" name="notes" rows="5"></textarea>
            </div>
        </div>
    </div>
</form>

@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
    });
</script>
@endif
    