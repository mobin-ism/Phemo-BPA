@if(is_permitted('quote_edit'))
<form method="post" id="modal-form" action="{{ route('quotes.save_invoice') }}">
    @csrf
    {{ Form::hidden('account_id', Auth::user()->account_id) }}
    {{ Form::hidden('quote_id', $quote->id) }}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="customer_id-group">
                <label for="customer">
                    * {{__('web.customer')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="customer_id" id="customer" title="{{__('web.select_one')}}" data-live-search="true">
                    @foreach(\App\Customer::where('account_id', Auth::user()->account_id)->get() as $customer)
                        <option value="{{$customer->id}}" <?php if ($quote->customer_id == $customer->id) echo 'selected'; ?>>
                            {{$customer->customer_type == 'company' ? $customer->company_name : $customer->customer_name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="invoice_no-group">
                <label for="invoice-no">
                    * {{__('web.invoice_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="invoice-no"
                    name="invoice_no" value="{{serialized_code('invoice')}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="">
                <label for="po-no">
                    {{__('web.po_no')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="po-no"
                    name="po_no" value="{{$quote->po_no}}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="issue_date-group">
                <label for="issue-date">
                    * {{__('web.issue_date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="issue_date" 
                    id="issue-date" value="{{get_formatted_date_from_timestamp(strtotime(date('d-m-Y')))}}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="due_date-group">
                <label for="due-date">
                    * {{__('web.due_date')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill m_datepicker_1" name="due_date" 
                    id="due-date" readonly>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="">
                <label for="status">
                    {{__('web.status')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="status" id="status">
                    <option value="unpaid">{{__('web.unpaid')}}</option>
                    <option value="paid">{{__('web.paid')}}</option>
                    <option value="partially_paid">{{__('web.partially_paid')}}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="">
                <label for="recurring">
                    {{__('web.recurring')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="recurring" id="recurring">
                    <option value="0">{{__('web.no')}}</option>
                    <option value="1">{{__('web.yes')}}</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="">
                <label for="shipping">
                    {{__('web.shipping_charge')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" name="shipping_charge" id="shipping" value="{{$quote->shipping_charge}}"
                    onkeyup="calculateGrandTotal()">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group m-form__group" id="">
                <label for="employee-id">
                    {{__('web.employee')}}
                </label>
                <select class="form-control m-bootstrap-select m-bootstrap-select--pill m_selectpicker"
                    name="employee_id" id="employee-id" title="{{__('web.select_one')}}" data-live-search="true">
                    @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $employee)
                        <option value="{{$employee->id}}" <?php if ($quote->employee_id == $employee->id) echo 'selected'; ?>>
                            {{$employee->user->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="form-group m-form__group" id="">
                <label for="notes">
                    {{__('web.notes')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="notes" name="notes" rows="7">{{$quote->notes}}</textarea>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="m-form__group form-group">
                {{-- <label>{{__('web.tax_invoice')}}</label> --}}
                <div class="m-checkbox-list">
                    <label class="m-checkbox m-checkbox--state-accent">
                        <input type="checkbox" name="tax_invoice" value="1"> <strong>{{__('web.this_is_a_tax_invoice')}}</strong>
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{__('web.items')}}</th>
                            <th>{{__('web.qty')}}</th>
                            <th>{{__('web.uom')}}</th>
                            <th>{{__('web.price')}}</th>
                            <th>{{__('web.tax')}} %</th>
                            <th>{{__('web.discount')}} %</th>
                            <th>{{__('web.amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subTotal = 0.0;
                            $totalTax = 0.0;
                            $totalDiscount = 0.0;
                            foreach (json_decode($quote->items) as $item):
                                $subTotal += ($item->price * $item->qty);
                                $totalTax += ($item->price * $item->qty * ($item->tax / 100));
                                $totalDiscount += ($item->price * $item->qty * ($item->discount / 100));
                        @endphp
                        <tr>
                            <td>
                                @if ($item->type == 'product')
                                    {{\App\Product::where('id', $item->id)->first()->name}}
                                @endif
                                @if ($item->type == 'service')
                                    {{\App\Service::where('id', $item->id)->first()->name}}
                                @endif
                            </td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->uom}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->tax == null ? '0' : $item->tax}}</td>
                            <td>{{$item->discount == null ? '0' : $item->discount}}</td>
                            <td>{{$item->total}}</td>
                        </tr>
                        @php
                            endforeach;
                        @endphp
                        <tr>
                            <td></td><td></td><td></td><td></td><td></td>
                            <td><strong>{{__('web.total')}}</strong></td>
                            <td><strong>{{$quote->grand_total}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="items" value="{{$quote->items}}">
            <input type="hidden" name="grand_total" id="grand_total" value="{{$quote->grand_total}}">
        </div>
    </div>
</form>

@php
    $format = to_javascript_date_format(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format);
@endphp

<script>
    var shippingCharge = 0.0;
    var grandTotal = 0.0;
    $(document).ready(function() {
        $('.modal-footer').show();
        $('.m_selectpicker').selectpicker();
        $('.m_datepicker_1').datepicker({
            todayHighlight: !0,
            format: '{{$format}}'
        });
        shippingCharge = parseFloat($('#shipping').val());
        grandTotal = parseFloat($('#grand_total').val());
    });
    function calculateGrandTotal() {
        var newShippingCharge = parseFloat($('#shipping').val());
        grandTotal = grandTotal - shippingCharge;
        var newGrandTotal = grandTotal + newShippingCharge;
        $('#grand_total').val(newGrandTotal);
    }
</script>
@endif