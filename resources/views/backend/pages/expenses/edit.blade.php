@if (is_permitted('expense_edit'))
<form method="post" id="modal-form" action="{{ route('expenses.update', $expense) }}" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="date-group">
                <label for="date">
                    * {{__('web.date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="date" 
                    id="date" value="{{get_formatted_date_from_timestamp($expense->date)}}" readonly>
            </div>
            <div class="form-group m-form__group" id="expense_type_id-group">
                <label for="expense-type">
                    * {{__('web.expense_type')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="expense_type_id" id="expense-type"
                        onchange="handleDynamicAdd('expense_type_id')">
                    @foreach (\App\ExpenseType::where('account_id', Auth::user()->account_id)->get() as $type)
                    <option value="{{$type->id}}" <?php if ($type->id == $expense->expense_type_id) echo 'selected'; ?>>
                        {{$type->name}}
                    </option>
                    @endforeach
                    <option value="-1" data-icon="la la-plus"> {{__('web.new_expense_type')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="amount-group">
                <label for="amount">
                    * {{__('web.amount')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="amount" name="amount"
                    value="{{$expense->amount}}">
            </div>
            <div class="form-group m-form__group" id="tax_amount-group">
                <label for="tax">
                    {{__('web.tax_amount')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="tax" name="tax_amount" value="{{$expense->tax_amount}}">
            </div>
            <div class="form-group m-form__group" id="tip-group">
                <label for="tip">
                    {{__('web.tip')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="tip" name="tip" value="{{$expense->tip}}">
            </div>
            <div class="form-group m-form__group" id="paid_through-group">
                <label for="paid-through">
                    * {{__('web.paid_through')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    title="{{__('web.select_one')}}" name="paid_through" id="paid-through">
                    <option value="petty_cash" <?php if ($expense->paid_through == 'petty_cash') echo 'selected'; ?>>{{__('web.petty_cash')}}</option>
                    <option value="cheque" <?php if ($expense->paid_through == 'cheque') echo 'selected'; ?>>{{__('web.cheque')}}</option>
                    <option value="card" <?php if ($expense->paid_through == 'card') echo 'selected'; ?>>{{__('web.card')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="reference-group">
                <label for="reference">
                    * {{__('web.reference')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="reference" name="reference"
                    value="{{$expense->reference}}">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="vendor">
                    {{__('web.vendor')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="vendor_id" id="vendor">
                    @foreach (\App\Vendor::where('account_id', Auth::user()->account_id)->get() as $vendor)
                    <option value="">{{__('web.none')}}</option>
                    <option value="{{$vendor->id}}" <?php if ($expense->vendor_id == $vendor->id) echo 'selected';?>>
                        {{$vendor->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-form__group" id="">
                <label for="customer">
                    {{__('web.customer')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    data-live-search="true" title="{{__('web.select_one')}}" name="customer_id" id="customer">
                    @foreach (\App\Customer::where('account_id', Auth::user()->account_id)->get() as $customer)
                    <option value="">{{__('web.none')}}</option>
                    <option value="{{$customer->id}}" <?php if ($expense->customer_id == $customer->id) echo 'selected';?>>
                        {{$customer->customer_type == 'company' ? $customer->company_name : $customer->customer_name}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="">
                <label for="notes">
                    {{__('web.notes')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="notes" name="notes" rows="5">{{$expense->notes}}</textarea>
            </div>
            <div class="form-group m-form__group">
                <label>{{__('web.receipt')}}</label>
                <div></div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="attachment" accept="application/pdf, .jpg" name="attachment">
                    <label class="custom-file-label" for="attachment">{{__('web.choose')}}</label>
                </div>
                <p class="filename mt-3"></p>
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

@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('#dynamic-add').hide();
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}',
            clearBtn: !0
        });
        $('input[type=file]').on('change', function() {
            $('.filename').html($(this).val());
        });
    });
    function handleDynamicAdd(type) {
        if ($('#expense-type').val() == -1) {
            $('.modal-footer').hide();
            $('#modal-form').hide();
            $('#dynamic-add').fadeIn();
            $('input[name=dynamic_add_type]').val(type);
            $('input[name=dynamic_add_name]').val('');
            if (type == 'expense_type_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.expense_type')}}');
        }
    }

    function saveDynamicAdd() {
        var url = '{{route('expenses.dynamic_add')}}';
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
            case 'expense_type':
                $('#expense-type').prepend('<option value="'+ response.expense_type_id+'" selected>'+ response.name +'</option>');
                $('#expense-type').selectpicker('refresh');
                break;
        }
    }

    function removeDynamicAdd() {
        $('#dynamic-add').hide();
        $('#modal-form').fadeIn();
        $('.modal-footer').fadeIn();
        if ($('#expense-type').val() == -1) {
            $('#expense-type').val('');
            $('#expense-type').selectpicker('refresh');
        }
    }

    function fileInfo() {
        $('#file-name').html($('#attachment').val());
    }
</script>
@endif