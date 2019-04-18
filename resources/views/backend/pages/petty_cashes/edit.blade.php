@extends('backend.layouts.master')
@section('content')

    <div class="vender_box">
        <h2>Request Petty Cash</h2>

        @if($pettyCash->status == 1 )

        <button class="btn btn-danger pull-right" style="margin-bottom: 10px; box-shadow: none;"><a href="{{ route('petty_cashes.reject', $pettyCash)}}" style="color: white;">Reject</a></button>
        <button class="btn btn-success pull-right" style="margin-bottom: 10px; box-shadow: none; margin-right: 10px;"><a href="{{ route('petty_cashes.approve', $pettyCash)}}" style="color: white;">Approve</a></button>

        @endif
        <!-- @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif -->
        <form action="{{ route('petty_cashes.update', $pettyCash) }}" method="POST">
            <input name="_method" type="hidden" value="PATCH">
            @csrf

            <div class="col-xs-12 col-sm-12 padding_left">
                <div class="form">
                    <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                            <label>Date</label>
                            <input type="text" name="date" placeholder="" class="datepicker" value="{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format,$pettyCash->date) }}" required>
                            @if ($errors->has('date'))
                                <div class="error">{{ $errors->first('date') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                            <label>Department</label>
                            <select name="department" class="select-search" required>
                                @foreach(\App\Department::where('account_id', Auth::user()->account_id)->get() as $department)
                                    <option value="{{ $department->name }}" <?php 
                                        if($pettyCash->department == $department->name) echo "selected";
                                    ?> >{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                            <label>Requested By</label>
                            <select name="requested_by" class="select-search" required>
                                @foreach(\App\Employee::where('account_id', Auth::user()->account_id)->get() as $key => $employee)
                                    <option value="{{ $employee->user->name }}" <?php if($pettyCash->requested_by == $employee->user->name) echo "selected"; ?> >{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                            <label>Amount</label>
                            <input type="number" step="0.01" name="amount" value="{{ $pettyCash->amount }}" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                            <label>Petty Cash Voucher</label>
                            <input type="text" name="voucher_no" placeholder="" value="{{ $pettyCash->voucher_no }}" required>
                        </div>
                    </div>
                    <div class="col-xs-12 padding_0">
                        <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                            <label>Description</label>
                            <textarea name="description">{{ $pettyCash->description }}</textarea>
                        </div>
                    </div>
                </div>      
            </div>

            
            <div class="col-xs-12 padding_0">
                <div class="text-center" style="background-color: transparent;box-shadow: none;">
                    <button value="submit" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        $('.datepicker').datepicker({
            todayHighlight: true,
            startDate: "today",
            format: '<?php $st = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format; 
                        if($st == "d-m-Y") echo "dd-mm-yyyy";
                        else if($st == "m-d-Y") echo "mm-dd-yyyy";
                        else if($st == "d/m/Y") echo "dd/mm/yyyy";
                        else if($st == "m/d/Y") echo "mm/dd/yyyy"; ?>'
        });
    </script>
@endsection