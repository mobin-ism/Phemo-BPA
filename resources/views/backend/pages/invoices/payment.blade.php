@if (is_permitted('invoice_edit'))
@php
    $grand_total = $invoice->grand_total;
    $payment = 0;
    foreach (\App\Payment::where('invoice_id', $invoice->id)->get() as $pay)
        $payment += $pay->amount;
    $due = $grand_total - $payment;
@endphp
<form method="post" id="modal-form" action="{{ route('invoices.record_payment') }}">
    @csrf
    {{ Form::hidden('invoice_id',  $invoice->id) }}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="amount-group">
                <label for="amount">
                    * {{__('web.amount')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="amount" name="amount"
                    value="{{$due}}">
            </div>
            <div class="form-group m-form__group" id="date-group">
                <label for="date">
                    * {{__('web.date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="date" 
                    id="date" readonly>
            </div>
            <div class="form-group m-form__group" id="payment_method_id-group">
                <label for="method">
                    * {{__('web.payment_method')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"  
                    title="{{__('web.select_one')}}" name="payment_method_id" id="method"
                    onchange="handleDynamicAdd('payment_method_id')">
                    @foreach (\App\PaymentMethod::where('account_id', Auth::user()->account_id)->get() as $method)
                    <option value="{{$method->id}}">{{$method->name}}</option>
                    @endforeach
                    <option value="-1" data-icon="la la-plus"> {{__('web.new_payment_method')}}</option>
                </select>
            </div>
            <div class="form-group m-form__group" id="reference-group">
                <label for="reference">
                    * {{__('web.reference')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="reference"
                        name="reference">
            </div>
            
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="">
                <label for="notes">
                    {{__('web.notes')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="notes" name="notes" rows="5"></textarea>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td class="m--font-bolder">{{__('web.invoice_no')}}</td>
                    <td>{{$invoice->invoice_no}}</td>
                </tr>
                <tr>
                    <td class="m--font-bolder">{{__('web.total')}}</td>
                    <td>{{get_config('currency')}} {{number_format($invoice->grand_total, 2, '.', ',')}}</td>
                </tr>
                <tr>
                    <td class="m--font-bolder">{{__('web.paid')}}</td>
                    <td>{{get_config('currency')}} {{number_format($payment, 2, '.', ',')}}</td>
                </tr>
                <tr>
                    <td class="m--font-bolder">{{__('web.total_due')}}</td>
                    <td>{{get_config('currency')}} {{number_format($due, 2, '.', ',')}}</td>
                </tr>
            </table>
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
            startDate: new Date(),
            clearBtn: !0
        });
    });
    function handleDynamicAdd(type) {
        if ($('select[name='+type+']').val() == -1) {
            $('.modal-footer').hide();
            $('#modal-form').hide();
            $('#dynamic-add').fadeIn();
            $('input[name=dynamic_add_type]').val(type);
            $('input[name=dynamic_add_name]').val('');
            if (type == 'payment_method_id')
                $('input[name=dynamic_add_name]').attr('placeholder', '{{__('web.payment_method')}}');
        }
    }

    function saveDynamicAdd() {
        var url = '{{route('invoices.dynamic_add')}}';
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
            case 'method':
                $('#method').prepend('<option value="'+ response.payment_method_id+'" selected>'+ response.name +'</option>');
                $('#method').selectpicker('refresh');
                break;
        }
    }

    function removeDynamicAdd() {
        $('#dynamic-add').hide();
        $('#modal-form').fadeIn();
        $('.modal-footer').fadeIn();
        if ($('#method').val() == -1) {
            $('#method').val('');
            $('#method').selectpicker('refresh');
        }
    }
</script>
@endif
    