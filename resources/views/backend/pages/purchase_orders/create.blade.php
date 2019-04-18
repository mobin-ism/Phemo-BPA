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
            {!! Form::open(array('route' => 'purchase_orders.store','method'=>'POST', 'id' => 'validate-form', 'class'=> 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
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
                                            <option value="{{ $vendor->id }}">
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
                                <p><span id="vendor-email"></span><br/>
                                <span id="vendor-address"></span></p>
                                <br>
                                <button type="button" class="btn btn-default" id="vendor_edit"><span class="glyphicon glyphicon-pencil"></span></button>
                            </div>
                        
                        </div>

                        <div class="col-xs-6">
                            <div class="col-xs-12 padding_0">
                                <div class="col-xs-12 padding_left">
                                    <label>PO #</label>
                                    <input type="text" name="po" required="true" placeholder="" value="{{ \App\Config::where('account_id', Auth::user()->account_id)->first()->po_prefix}}">
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>PR #</label>
                                    <input type="text" name="pr" required="true" placeholder="">
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>Request Type</label>
                                    <select name="request_type" class="select-search">
                                        <option value="Normal">Normal</option>
                                        <option value="Urgent">Urgent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>Purpose</label>
                                    <input type="text" name="purpose" required="true">
                                </div>
                            </div>

                            <div class="col-xs-12 padding_0">
                                
                                <div class="col-xs-12 padding_left">
                                    <label>Date</label>
                                    <input type="text" name="date" required="true" class="datepicker">
                                </div>
                            </div>
                        </div>



                    </div>

                </div>

                <!-- /basic layout -->

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
                        <button style="margin-left: 10px" type="button" class="btn btn-default" onclick="showAjaxModal('{{route('quotations.product_add')}}')"><i class="icon-plus3 position-left"></i> {{ __('web.add_product') }}</button>
                        <br/>
                        <br/>
                        <div class="table_box" id="products-table">
                            <div class="table-responsive">
                                <table id="product_table" class="table table-striped">
                                    <thead>
                                    <tr class="bg-blue">
                                        <th style="width: 14%">{{ __('web.product_name') }}</th>
                                        <th style="width: 13%">{{ __('web.qty') }}</th>
                                        <th style="width: 14%">{{ __('web.unit_price') }}</th>
                                        <th style="width: 10%">{{ __('web.discount') }}(%)</th>
                                        <th style="width: 15%">{{ __('web.tax') }}</th>
                                        <th style="width: 15%">{{ __('web.total_amount') }}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

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
                            <button style="margin-left: 10px" type="button" class="btn btn-default" onclick="showAjaxModal('{{route('quotations.service_add')}}')"><i class="icon-plus3 position-left"></i> {{ __('web.add_service') }}</button>
                            <br/>
                            <br/>
                            <div class="table_box" id="services-table">
                                <div class="table-responsive">
                                    <table id="service_table" class="table table-striped">
                                        <thead>
                                        <tr class="bg-blue">
                                            <th style="width: 14%">{{ __('web.service_name') }}</th>
                                            <th style="width: 13%">{{ __('web.duration') }}</th>
                                            <th style="width: 14%">{{ __('web.price') }}</th>
                                            <th style="width: 10%">{{ __('web.discount') }}(%)</th>
                                            <th style="width: 15%">{{ __('web.tax') }}</th>
                                            <th style="width: 15%">{{ __('web.total_amount') }}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>

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
                                            <td class="text-right" id="grand-total">0.00</td>
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

            <div class="text-center" style="background-color: transparent;box-shadow: none;">
                
                <button type="submit">Save</button>
            </div>
        
        </div>

        {!! Form::close() !!}
    </div>

    <script type="text/javascript">

        $('#vendor-info').hide();
        $('#products-table').hide();
        $('#services-table').hide();
        $('#discount-total').parent().hide();
        $('#tax-total').parent().hide();


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

        function showProductsTable(){
            $('#products-table').show();            
        }

        function showServicesTable(){
            $('#services-table').show();          
        }

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
        });

        function init_scripts()
        {
            $('.select-search').select2();

            $(".delete-row").click(function(){
                //console.log('here');
                $(this).closest('tr').remove();

                $(this).closest('tr').remove();
                var tbody = $("#product_table tbody");

                if (tbody.children().length == 0) {
                    $('#products-table').hide();
                }

                var tbody = $("#service_table tbody");

                if (tbody.children().length == 0) {
                    $('#services-table').hide();
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