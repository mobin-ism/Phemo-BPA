@extends('backend.layouts.master')
@section('content')

    <!-- <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4 class="orange-color"><i class="icon-arrow-left52 position-left"></i> {{ __('web.invoice') }}</h4>
    
            </div>
    
    
        </div>
    </div> -->

    <div class="vender_box">
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
            {!! Form::open(array('route' => ['purchase_orders.update', $purchase_order->id], 'method'=>'PATCH', 'id' => 'validate-form', 'class'=> 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
            <div class="form">

            <div class="row">
            <div class="col-xs-12">

                <!-- Basic layout
                <div class="text-right">
                    <button type="submit" class="btn btn-danger">
                
                        {{ __('web.save') }}
                        <i class="icon-arrow-right14 position-right"></i></button>
                </div> -->
                <div class="clearfix"></div>
                <br/>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h5 class="panel-title">Purchase Info</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>

                            </ul>
                        </div>


                    </div>

                    <div class="panel-body">

                        <div class="col-xs-6">

                            <div class="col-xs-12 padding_0" id="vendor_select">
                                <div class="col-xs-12 padding_left" style="position: relative;">
                                    <label>Select Vendor</label>
                                    <select name="vendor_id" id="vendor_id" required="true" class="select-search">
                                        <option value="">Select Vendor</option>
                                        @foreach(\App\Vendor::where('account_id', Auth::user()->account_id)->get() as $key => $vendor)
                                            <option value="{{ $vendor->id }}" <?php 
                                                if($vendor->id == $purchase_order->vendor_id) echo "selected";
                                            ?> >
                                                {{ $vendor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- <div id="vendor-add">
                                <button id="add-vendor" onclick="showAjaxModal('{{route('vendors.create')}}')" type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-plus"></span> Add vendor</button>
                            </div> -->

                            <div id="vendor-info">
                                <!-- <h4>Bill To</h4> -->
                                <h3 id="vendor-name"></h3>
                                <p><span id="vendor-email"></span><br/> <span id="vendor-address"></span></p>
                                <br>
                                <button type="button" class="btn btn-default" id="vendor_edit"><span class="glyphicon glyphicon-pencil"></span></button>
                            </div>
                        
                        </div>

                        <div class="col-xs-6">
                            <div class="col-xs-12 padding_0">
                                <div class="col-xs-12 padding_left">
                                    <label>PO #</label>
                                    <input type="text" name="po" required="true" placeholder="" value="{{ $purchase_order->po }}" disabled="true">
                                </div> 
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>PR #</label>
                                    <input type="text" name="pr" required="true" placeholder="" value="{{ $purchase_order->pr }}" disabled="true">
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>Request Type</label>
                                    <select name="request_type" disabled="true">
                                        <option value="Normal">Normal</option>
                                        <option value="Urgent">Urgent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>Purpose</label>
                                    <input type="text" name="purpose" required="true" value="{{ $purchase_order->purpose }}" disabled="true">
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>Date</label>
                                    <input type="text" name="date" required="true" class="datepicker" value="{{ date(\App\Config::first()->date_format, $purchase_order->date) }}" disabled="true">
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>Change Status</label>
                                    <select name="status" id="status" class="select-search">
                                        <option value="1" <?php if($purchase_order->status == 1) echo "selected";?> >Due</option>
                                        <option value="2" <?php if($purchase_order->status == 2) echo "selected";?> >Partially Paid</option>
                                        <option value="3" <?php if($purchase_order->status == 3) echo "selected";?> >Paid</option>
                                    </select>
                                </div>

                                <div class="text-center" style="background-color: transparent;box-shadow: none;">
                                    
                                    <button type="submit">Save</button>

                                </div>                            
                            
                            </div>

                        </div>

                    </div>

                </div>

                <!-- /basic layout -->

            </div>
        </div>

        <div class="row" id="payments">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h5 class="panel-title">Payments</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="table_box" id="products-table">
                            <div class="table-responsive">
                                @php
                                    $payments =  json_decode($purchase_order->payments);
                                @endphp
                                @foreach($payments as $payment)
                                    <div class="col-xs-12 padding_0">
                                        <div>
                                            <div class="col-xs-12 col-sm-3 padding_left">
                                                <label>Amount</label>
                                                <input type="text" value="{{number_format($payment->amount, 2)}}" disabled>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 padding_right">
                                                <label>Date</label>
                                                <input type="text" value="{{date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, $payment->date)}}" disabled>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 padding_right">
                                                <label>Method</label>
                                                <input type="text" value="{{$payment->method}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <div class="col-xs-12 padding_0">
                                    <div class="control-group-2 increment-2" >
                                        <div class="col-xs-12 col-sm-3 padding_left">
                                            <label>Amount</label>
                                            <input type="number" min="0" name="amount[]" step="0.01">
                                        </div>
                                        <div class="col-xs-12 col-sm-3 padding_0">
                                            <label>Date</label>
                                            <input type="text" class="datepicker" name="date[]">
                                        </div>
                                        <div class="col-xs-12 col-sm-3 padding_right">
                                            <label>Method</label>
                                            <select name="method[]">
                                                <option value="Cash">Cash</option>
                                                <option value="Cash Memo">Cash Memo</option>
                                                <option value="Credit Card">Credit Card</option>
                                                <option value="Check">Check</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                                <option value="Pay Slip">Pay Slip</option>
                                                <option value="Credit Note">Credit Note</option>
                                            </select>
                                        </div>
                                        <div class="input-group-btn text-right">
                                            <button class="btn btn-success add-files-2" type="button" style="margin-left:10px"><i class="glyphicon glyphicon-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="clone-file-2 hide">
                                        <br>
                                        <div class="control-group-2" style="margin-top:10px">
                                            <div class="col-xs-12 col-sm-3 padding_left">
                                                <label>Amount</label>
                                                <input type="number" min="0" name="amount[]" step="0.01">
                                            </div>
                                            <div class="col-xs-12 col-sm-3 padding_right">
                                                <label>Date</label>
                                                <input type="text" class="datepicker" name="date[]">
                                            </div>
                                            <div class="col-xs-12 col-sm-3 padding_right">
                                                <label>Method</label>
                                                <select name="method[]">
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cash Memo">Cash Memo</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Check">Check</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                    <option value="Pay Slip">Pay Slip</option>
                                                    <option value="Credit Note">Credit Note</option>
                                                </select>
                                            </div>
                                            <div class="input-group-btn text-right">
                                                <button class="btn btn-danger remove-files-2" type="button" style="margin-left:10px"><i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ __('web.products') }}</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>

                            </ul>
                        </div>


                    </div>

                    <div class="panel-body">
                        <!-- <button style="margin-left: 10px" type="button" class="btn btn-default" onclick="showAjaxModal('{{route('quotations.product_add')}}')"><i class="icon-plus3 position-left"></i> {{ __('web.add_product') }}</button>
                        <br/> -->
                        <br/>
                        <div class="table_box" id="products-table">
                            <div class="table-responsive">
                                <table id="product_table" class="table table-striped">
                                    <thead>
                                    <tr class="bg-blue">
                                        <th style="width: 25%">{{ __('web.product_name') }}</th>
                                        <th style="width: 25%">{{ __('web.qty') }}</th>
                                        <th style="width: 25%">{{ __('web.unit_price') }}</th>
                                        <th style="width: 25%">{{ __('web.total_amount') }}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $products =  json_decode($purchase_order->products);
                                        @endphp
                                        @foreach($products as  $prod)

                                            @php $product = \App\Product::find($prod->id) @endphp

                                            @if($product!=null)

                                            <tr class="product-row">
                                                {{ Form::hidden('product_id[]',  $product->id) }}
                                                <td>
                                                    {{$product->name}}
                                                </td>
                                                <td>
                                                    {!! Form::number('product_qty[]', $prod->qty, array('class' => 'form-control qty-product', 'disabled' => 'disabled')) !!}
                                                </td>
                                                <td>{!! Form::text('unit_price', format_price($product->unit_price), array('class' => 'form-control unit-price', 'disabled' => 'disabled')) !!}</td>
                                                
                                                <td>{!! Form::text('product_total_amount', format_price($product->unit_price), array('class' => 'form-control total-amount-product', 'disabled' => 'disabled')) !!}
                                                    {{ Form::hidden('sub_total',  format_price($product->unit_price), array('class' => 'sub-product')) }}
                                                </td>
                                                <td>
                                                    <a class="delete-row" href="javascript:void(0)"><img src="{{asset('backend/assets/images/delete_icon.png')}}" alt="#"></a>
                                                </td>
                                            </tr>

                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h5 class="panel-title">{{ __('web.services') }}</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>

                                </ul>
                            </div>


                        </div>

                        <div class="panel-body">
                            <!-- <button style="margin-left: 10px" type="button" class="btn btn-default" onclick="showAjaxModal('{{route('quotations.service_add')}}')"><i class="icon-plus3 position-left"></i> {{ __('web.add_service') }}</button>
                            <br/> -->
                            <br/>
                            <div class="table_box" id="services-table">
                                <div class="table-responsive">
                                    <table id="service_table" class="table table-striped">
                                        <thead>
                                        <tr class="bg-blue">
                                            <th style="width: 25%">{{ __('web.service_name') }}</th>
                                            <th style="width: 25%">{{ __('web.duration') }}</th>
                                            <th style="width: 25%">{{ __('web.price') }}</th>
                                            <th style="width: 25%">{{ __('web.total_amount') }}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $services =  json_decode($purchase_order->services);
                                            @endphp

                                            @foreach($services as  $serv)
                                                @php $service = \App\Service::find($serv->id) @endphp

                                                @if($service!=null)

                                                <tr class="service-row">
                                                    {{ Form::hidden('service_id[]',  $service->id) }}
                                                    <td>
                                                        {{$service->name}}
                                                    </td>
                                                    <td>
                                                        {!! Form::number('service_duration[]', $serv->duration, array('class' => 'form-control duration', 'disabled' => 'disabled')) !!}
                                                    </td>
                                                    <td>{!! Form::text('price', format_price($service->rate_charge), array('class' => 'form-control service-price', 'disabled' => 'disabled')) !!}</td>
                                                    
                                                    <td>{!! Form::text('total_amount', format_price($service->rate_charge), array('class' => 'form-control total-amount-service', 'disabled' => 'disabled')) !!}
                                                        {{ Form::hidden('sub_total',  format_price($service->rate_charge), array('class' => 'sub-service')) }}
                                                    </td>
                                                    <td>
                                                        <a class="delete-row" href="javascript:void(0)"><img src="{{asset('backend/assets/images/delete_icon.png')}}" alt="#"></a>
                                                    </td>
                                                </tr>
                                                
                                                @endif

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-flat">

                        <div class="panel-body">

                            <div class="table_box">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                        <tr>
                                            <td colspan="6" class="text-right"><b>Grand Total</b></td>
                                            <td class="text-right" id="grand-total">{{ $purchase_order->grand_total }}</td>
                                            {{ Form::hidden('grand_total',  null, array('id' => 'grand_total')) }}
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{ Form::hidden('account_id',  Auth::user()->account_id) }}
                            {{ Form::hidden('user_id',  Auth::user()->id) }}

                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
        
        </div>

        {!! Form::close() !!}
    </div>

    <script type="text/javascript">

        $(".add-files-2").click(function(){
            console.log('test');
            var html = $(".clone-file-2").html();
            $(".increment-2").after(html);
        });

        $("body").on("click",".remove-files-2",function(){
            $(this).parents(".control-group-2").remove();
        });

        var tbody = $("#product_table tbody");

        if (tbody.children().length == 0) {
            $('#products-table').hide();
        }
        else{
            $('#products-table').show();
        }

        var tbody = $("#service_table tbody");

        if (tbody.children().length == 0) {
            $('#services-table').hide();
        }
        else{
            $('#services-table').show();
        }
        
        $('#discount-total').parent().hide();
        $('#tax-total').parent().hide();

        function showProductsTable(){
            $('#products-table').show();            
        }

        function showServicesTable(){
            $('#services-table').show();          
        }

        $('#payments').hide();

        $('#status').on('change', function(){
            if($('#status').val() == 2 || $('#status').val() == 3){
                $('#payments').show();
            }
            else{
                $('#payments').hide();
            }
        });

        $('#vendor_id').on('change', function() {
            var vendor_id = $('#vendor_id').val();
            if(vendor_id > 0){
                $('#vendor_select').hide();
                var vendor_id = $('#vendor_id').val();
                $.post('{{ route('vendors.info') }}',{_token:'{{ csrf_token() }}', vendor_id:vendor_id}, function(data){
                    
                    $('#vendor-info').show();
                    $('#vendor-name').html(data.name);
                    $('#vendor-email').html(data.email);
                    $('#vendor-address').html(data.address);

                });
            }
        });

        $('#vendor_edit').on('click', function(){
            $('#vendor_select').show();
            $('#vendor-info').hide();
        });


        $(function() {
            //$('#vendor-info').hide();
            $('#summernote').summernote({height: 200});
            $("#validate-form").validate();
            $('.datepicker').datepicker({
                todayHighlight: true,
                startDate: "today",
                format: '<?php $st = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format; 
                            if($st == "d-m-Y") echo "dd-mm-yyyy";
                            else if($st == "m-d-Y") echo "mm-dd-yyyy";
                            else if($st == "d/m/Y") echo "dd/mm/yyyy";
                            else if($st == "m/d/Y") echo "mm/dd/yyyy"; ?>'
            });

            if($('#status').val() == 2 || $('#status').val() == 3){
                $('#payments').show();
            }

            @if($purchase_order->vendor_id != '')

            var vendor_id = parseInt('{{$purchase_order->vendor_id}}');
            
            $('#vendor_select').hide();

            $.post('{{ route('vendors.info') }}',{_token:'{{ csrf_token() }}', vendor_id:vendor_id}, function(data){
                    
                    $('#vendor-info').show();
                    $('#vendor-name').html(data.name);
                    $('#vendor-email').html(data.email);
                    $('#vendor-address').html(data.address);

                });

            @endif

        });

        function init_scripts()
        {
            $('.select-search').select2();

            $(".delete-row").click(function(){
                //console.log('here');
                $(this).closest('tr').remove();

                var tbody = $("#product_table tbody");

                if (tbody.children().length == 0) {
                    $('#products-table').hide();
                }
                else{
                    $('#products-table').show();
                }

                var tbody = $("#service_table tbody");

                if (tbody.children().length == 0) {
                    $('#services-table').hide();
                }
                else{
                    $('#services-table').show();
                }

                calculate_subtotal();
            });

            $("#discount").prop('disabled', true);
            $("#tax").prop('disabled', true);

            $("#service-discount").prop('disabled', true);
            $("#service-tax").prop('disabled', true);


            $('.qty-product').bind('keyup mouseup', function () {
                var qty= $(this).val();
                var table_tr = $(this).closest('tr');
                var unit_price = $(table_tr).find('.unit-price').val();
                var discount_per = $(table_tr).find('.discount-product').val();
                var tax = $(table_tr).find('.tax-product').val();

                calculate_sub_total_product_row(unit_price, qty, discount_per, tax, table_tr);

            });


            $('.discount-product').bind('keyup mouseup', function () {
                //alert("changed");
                var discount_per= $(this).val();
                var table_tr = $(this).closest('tr');
                var unit_price = $(table_tr).find('.unit-price').val();
                var qty = $(table_tr).find('.qty-product').val();
                var tax = $(table_tr).find('.tax-product').val();

                calculate_sub_total_product_row(unit_price, qty, discount_per, tax, table_tr);

            });

            $('.tax-product').bind('change', function () {

                var tax= $(this).val();
                var table_tr = $(this).closest('tr');
                var unit_price = $(table_tr).find('.unit-price').val();
                var qty = $(table_tr).find('.qty-product').val();
                var discount_per = $(table_tr).find('.discount-product').val();

                calculate_sub_total_product_row(unit_price, qty, discount_per, tax, table_tr);

            });



            $('.duration').bind('keyup mouseup', function () {

                var duration= $(this).val();
                var table_tr = $(this).closest('tr');
                var price = $(table_tr).find('.service-price').val();
                var discount_per = $(table_tr).find('.discount-service').val();
                var tax = $(table_tr).find('.tax-service').val();
                //alert("changed");
                calculate_sub_total_service_row(price, duration, discount_per, tax, table_tr);

            });

            $('.discount-service').bind('keyup mouseup', function () {
                var discount_per= $(this).val();
                var table_tr = $(this).closest('tr');
                var price = $(table_tr).find('.service-price').val();
                var duration = $(table_tr).find('.duration').val();
                var tax = $(table_tr).find('.tax-service').val();

                calculate_sub_total_service_row(price, duration, discount_per, tax, table_tr);

            });

            $('.tax-service').bind('change', function () {

                var tax= $(this).val();
                var table_tr = $(this).closest('tr');
                var price = $(table_tr).find('.service-price').val();
                var duration = $(table_tr).find('.duration').val();
                var discount_per = $(table_tr).find('.discount-service').val();

                calculate_sub_total_service_row(price, duration, discount_per, tax, table_tr);

            });



        }

        function calculate_sub_total_product_row(unit_price, qty, discount_per, tax, table_row) {

            var total_amount = parseInt(qty) * parseFloat(unit_price);
            $(table_row).find('.sub-product').val(total_amount);
            var discount =  total_amount * (parseFloat(discount_per)/100);
            $(table_row).find('.dt-product').val(discount);
            var tax_amount = total_amount * (parseFloat(tax)/100);
            $(table_row).find('.tt-product').val(tax_amount);
            var sub_total = total_amount - discount + tax_amount;
            $(table_row).find('.total-amount-product').val(sub_total.toFixed(2));
            calculate_subtotal();

        }

        function calculate_sub_total_service_row(price, duration, discount_per, tax, table_row) {

            var total_amount = parseInt(duration) * parseFloat(price);
            $(table_row).find('.sub-service').val(total_amount);
            var discount =  total_amount * (parseFloat(discount_per)/100);
            $(table_row).find('.dt-service').val(discount);
            var tax_amount = total_amount * (parseFloat(tax)/100);
            $(table_row).find('.tt-service').val(tax_amount);
            var sub_total = total_amount - discount + tax_amount
            $(table_row).find('.total-amount-service').val(sub_total.toFixed(2));
            calculate_subtotal();

        }

        function calculate_subtotal() {
            console.log('here');
            var subtotal = 0;

            $('.sub-product').each(function(){
                subtotal = subtotal + parseFloat(this.value);
            });

            $('.sub-service').each(function(){
                subtotal = subtotal + parseFloat(this.value);
            });

            var total_discount = 0;

            $('.dt-product').each(function(){
                total_discount = total_discount + parseFloat(this.value);
            });

            $('.dt-service').each(function(){
                total_discount = total_discount + parseFloat(this.value);
            });

            var total_tax = 0;

            $('.tt-product').each(function(){
                total_tax = total_tax + parseFloat(this.value);
            });

            $('.tt-service').each(function(){
                total_tax = total_tax + parseFloat(this.value);
            });

            $('#subtotal').html(subtotal.toFixed(2));
            $('#sub_total').val(subtotal.toFixed(2));
            $('#discount-total').html(total_discount.toFixed(2));
            $('#discount_total').val(total_discount.toFixed(2));
            $('#tax-total').html(total_tax.toFixed(2));
            $('#tax_total').val(total_tax.toFixed(2));

             if(total_discount>0){
                $('#discount-total').parent().show();
            }
            else{
                $('#discount-total').parent().hide();
            }

            if(total_tax>0){
                $('#tax-total').parent().show();
            }
            else{
                $('#tax-total').parent().hide();
            }

            var grand_total = subtotal - total_discount + total_tax;

            $('#grand-total').html(grand_total.toFixed(2));
            $('#grand_total').val(grand_total.toFixed(2));
        }



    </script>

@endsection