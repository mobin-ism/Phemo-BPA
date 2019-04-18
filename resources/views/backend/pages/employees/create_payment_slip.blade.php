@extends('backend.layouts.master')
@section('content')

    <div class="vender_box">
        <h2>Create Payslip</h2>
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
        <form action="{{ route('employees.download_payment_slip') }}" method="POST" id="validate-form">
            @csrf
            <div class="col-xs-12 col-sm-12 padding_left">
                <div class="form">
                    <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">
                    
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Emmployee</label>
                            <select name="employee_id" id="employee-select" class="select-search" required>
                                @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $key => $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 padding_right">
                            <label>Date of Payment</label>
                            <input type="text"  name="date_of_payment" class="datepicker" required>
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left">
                            <label>Payment From</label>
                            <input type="text"  name="date_from" class="datepicker" required>
                        </div>
                        <div class="col-xs-12 col-sm-6 padding_right">
                            <label>Payment To</label>
                            <input type="text"  name="date_to" class="datepicker" required>
                        </div>
                    </div>

                    <h5 style="margin-top: 20px; margin-bottom: 10px;">Earnings</h5>
                    
                    <div class="input-group col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-5 padding_left">
                            <label>Type</label>
                            <input type="text" value="Basic Salary" required disabled>
                        </div>
                        <div class="col-xs-12 col-sm-5 padding_right">
                            <label>Amount</label>
                            <input type="number" id="salary" name="salary" min="0" step="0.01" required disabled>
                        </div>
                    </div>

                    <div class="col-xs-12 padding_0">
                        <div class="control-group increment" >
                            <div class="col-xs-12 col-sm-5 padding_left">
                                <label>Type</label>
                                <input type="text"  name="earning_types[]">
                            </div>
                            <div class="col-xs-12 col-sm-5 padding_right">
                                <label>Amount</label>
                                <input type="number" min="0" step="0.01" name="earning_amounts[]">
                            </div>
                            <div class="input-group-btn text-right">
                                <button class="btn btn-success add-files" type="button" style="margin-left:10px"><i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                        </div>
                        <div class="clone-file hide">
                            <div class="control-group" style="margin-top:10px">
                                <div class="col-xs-12 col-sm-5 padding_left">
                                    <label>Type</label>
                                    <input type="text"  name="earning_types[]">
                                </div>
                                <div class="col-xs-12 col-sm-5 padding_right">
                                    <label>Amount</label>
                                    <input type="number" min="0" step="0.01" name="earning_amounts[]">
                                </div>
                                <div class="input-group-btn text-right">
                                    <button class="btn btn-danger remove-files" type="button" style="margin-left:10px"><i class="glyphicon glyphicon-remove"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h5 style="margin-top: 20px; margin-bottom: 10px;">Deductions</h5>

                    <div class="col-xs-12 padding_0">
                        <div class="control-group-2 increment-2" >
                            <div class="col-xs-12 col-sm-5 padding_left">
                                <label>Type</label>
                                <input type="text"  name="deduction_types[]">
                            </div>
                            <div class="col-xs-12 col-sm-5 padding_right">
                                <label>Amount</label>
                                <input type="number" min="0" step="0.01" name="deduction_amounts[]">
                            </div>
                            <div class="input-group-btn text-right">
                                <button class="btn btn-success add-files-2" type="button" style="margin-left:10px"><i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                        </div>
                        <div class="clone-file-2 hide">
                            <div class="control-group-2" style="margin-top:10px">
                                <div class="col-xs-12 col-sm-5 padding_left">
                                    <label>Type</label>
                                    <input type="text"  name="deduction_types[]">
                                </div>
                                <div class="col-xs-12 col-sm-5 padding_right">
                                    <label>Amount</label>
                                    <input type="number" min="0" step="0.01" name="deduction_amounts[]">
                                </div>
                                <div class="input-group-btn text-right">
                                    <button class="btn btn-danger remove-files-2" type="button" style="margin-left:10px"><i class="glyphicon glyphicon-remove"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                                
            </div>

            <div class="col-xs-12 padding_0">
                <div class="text-center" style="background-color: transparent;box-shadow: none;">
                    
                    <button type="submit">Create</button>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('script')

<script type="text/javascript">
    
    $(function() {
        getSalary($('#employee-select').val());
        $("#validate-form").validate();
        $('.datepicker').datepicker({
            todayHighlight: true,
            format: '<?php $st = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format; 
                        if($st == "d-m-Y") echo "dd-mm-yyyy";
                        else if($st == "m-d-Y") echo "mm-dd-yyyy";
                        else if($st == "d/m/Y") echo "dd/mm/yyyy";
                        else if($st == "m/d/Y") echo "mm/dd/yyyy"; ?>'
        });
    });


    $(".add-files").click(function(){
        console.log('test');
        var html = $(".clone-file").html();
        $(".increment").after(html);
    });

    $("body").on("click",".remove-files",function(){
        $(this).parents(".control-group").remove();
    });

    $(".add-files-2").click(function(){
        console.log('test');
        var html = $(".clone-file-2").html();
        $(".increment-2").after(html);
    });

    $("body").on("click",".remove-files-2",function(){
        $(this).parents(".control-group-2").remove();
    });

    $('#employee-select').bind('change', function(){
        getSalary($('#employee-select').val());
    });

    function getSalary(id){

        $.post('{{ route('employees.get_salary') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
            $('#salary').val(data);
        });
    }

</script>

@endsection