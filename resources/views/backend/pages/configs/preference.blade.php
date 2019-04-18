@extends('backend.layouts.master')
@section('content')

    <div class="vender_box">
        <h2>System Preference</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('configs.update', $config->id) }}" method="POST" id="validate-form">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="col-xs-12 col-sm-12 padding_left">
                <div class="form">
                    <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-6 padding_left" style="position: relative;">
                            <label>Company Name</label>
                            <input type="text" name="company_name" value="{{ $config->company_name }}">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Date Format</label>
                            <select name="date_format" class="select-search" required>
                                <option value="d/m/Y">d/m/Y</option>
                                <option value="m/d/Y">m/d/Y</option>
                                <option value="d-m-Y">d-m-Y</option>
                                <option value="m-d-Y">m-d-Y</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Currency</label>
                            <select id="currency" name="currency" class="select-search" required>
                                @foreach(\App\Currency::all() as $currency)
                                    <option value="{{$currency->code}}">{{$currency->country}} ({{$currency->code}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-6 padding_left" style="position: relative;">
                            <label>Select Template</label>
                            <select name="template_version" class="select-search" required>
                                <option value="1">Template 1</option>
                                <option value="2">Template 2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-6 padding_left" style="position: relative;">
                            <label>PDF Color Code (Hexa code without #)</label>
                            <input type="text" name="template_color" value="{{ $config->template_color }}">
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-6 padding_left" style="position: relative;">
                            <label>PDF Text Color Code (Hexa code without #)</label>
                            <input type="text" name="text_color" value="{{ $config->text_color }}">
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Invoice Prefix</label>
                            <input type="text" name="invoice_prefix" placeholder="" value="{{ $config->invoice_prefix }}">
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Quotation Prefix</label>
                            <input type="text" name="quotation_prefix" placeholder="" value="{{ $config->quotation_prefix }}">
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Purchase Order Prefix</label>
                            <input type="text" name="po_prefix" placeholder="" value="{{ $config->po_prefix }}">
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Voucher No Prefix</label>
                            <input type="text" name="voucher_prefix" placeholder="" value="{{ $config->voucher_prefix }}">
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Terms & Conditions (Invoice)</label>
                            <textarea name="tc_invoice">{{ $config->tc_invoice }}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Terms & Conditions (Quotation)</label>
                            <textarea name="tc_quotation">{{ $config->tc_quotation }}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Terms & Conditions (Purchase Order)</label>
                            <textarea name="tc_po">{{ $config->tc_po }}</textarea>
                        </div>
                    </div>
                    
                </div>
                                
            </div>

            <div class="col-xs-12 padding_0">
                <div class="text-center" style="background-color: transparent;box-shadow: none;">
                    
                    <button type="submit">Save</button>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('script')

<script type="text/javascript">
    
    $(function() {
            $("#validate-form").validate();
            $("#currency > option").each(function() {
                if(this.value == '{{$config->currency}}'){
                    $("#currency").val(this.value).change();
                }
            });
    });

</script>

@endsection