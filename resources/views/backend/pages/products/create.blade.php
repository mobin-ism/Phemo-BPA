@if (is_permitted('product_create'))
<form method="post" id="modal-form" action="{{ route('products.store') }}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="code-group">
                <label for="code">
                    * {{__('web.code')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="code" name="code"
                    value="{{random_code(8)}}">
            </div>
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="purchase-price">
                    {{__('web.purchase_price')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="purchase-price" name="purchase_price">
            </div>
            <div class="form-group m-form__group" id="sales_price-group">
                <label for="sales-price">
                    * {{__('web.sales_price')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="sales-price" name="sales_price">
            </div>
            
            <div class="form-group m-form__group" id="quantity-group">
                <label for="quantity">
                    {{__('web.quantity')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="quantity"
                        name="quantity">
            </div>
            <div class="form-group m-form__group">
                <label for="unit-of-measure">
                    {{__('web.unit_of_measure')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="unit_of_measure_id" id="uom"
                        onchange="handleDynamicAdd('unit_of_measure_id')">
                    @foreach (\App\UnitOfMeasure::where('account_id', Auth::user()->account_id)->get() as $uom)
                    <option value="{{$uom->id}}">{{$uom->name}}</option>
                    @endforeach
                    <option value="-1" data-icon="la la-plus"> {{__('web.new_unit_of_measure')}}</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="">
                <label for="description">
                    {{__('web.description')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="description" name="description" rows="5"></textarea>
            </div>
        </div>
    </div>
</form>

<div class="form-group m-form__group row" id="dynamic-add">
    <label class="col-lg-2 col-form-label">{{__('web.name')}}</label>
    <div class="col-lg-5">
        <input type="text" class="form-control m-input" name="dynamic_add_name" placeholder="">
        <input type="hidden" name="dynamic_add_type" value="">
    </div>
    <div class="col-lg-4">
        <a href="#" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill"
            onclick="saveDynamicAdd()">
            <i class="la la-check"></i>
        </a>
        <a href="#" class="btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill"
            onclick="removeDynamicAdd()">
            <i class="la la-close"></i>
        </a>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('#dynamic-add').hide();
        $('.m_selectpicker').selectpicker();
    });
    function handleDynamicAdd(type) {
        if ($('select[name='+type+']').val() == -1) {
            $('.modal-footer').hide();
            $('#modal-form').hide();
            $('#dynamic-add').fadeIn();
            $('input[name=dynamic_add_type]').val(type);
            $('input[name=dynamic_add_name]').val('');
            if (type == 'unit_of_measure_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.unit_of_measure')}}');
        }
    }

    function saveDynamicAdd() {
        var url = '{{route('products.dynamic_add')}}';
        var data = {
            "_token": "{{ csrf_token() }}",
            "add_type": $('input[name=dynamic_add_type]').val(),
            "add_name": $('input[name=dynamic_add_name]').val()
        };
        $.post(url, data, function(response) {
            if (response.errors) {
                console.log(response.errors);
                $('#dynamic-add').addClass('has-danger');
            } else {
                $('#dynamic-add').removeClass('has-danger');
                handleSuccess(response);
            }
        }).fail(function(response) {
            console.log(response);
        });
    }

    function handleSuccess(response) {
        removeDynamicAdd();
        $('.modal-footer').fadeIn();
        switch (response.type) {
            case 'uom':
                $('#uom').prepend('<option value="'+ response.unit_of_measure_id+'" selected>'+ response.name +'</option>');
                $('#uom').selectpicker('refresh');
                break;
        }
    }

    function removeDynamicAdd() {
        $('#dynamic-add').hide();
        $('#modal-form').fadeIn();
        $('.modal-footer').fadeIn();
        if ($('#uom').val() == -1) {
            $('#uom').val('');
            $('#uom').selectpicker('refresh');
        }
    }
</script>
@endif
