@extends('backend.layouts.master')
@section('content')

    <div class="vender_box">
        <h2>Create Employee</h2>
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
        <form action="{{ route('employees.store') }}" method="POST">
            
            @csrf

            {{ Form::hidden('account_id',  Auth::user()->account_id) }}

            <div class="col-xs-12 col-sm-12 padding_0">
                <div class="form">
                    
                    <img src="{{ asset('backend/assets/images/purple_box.png') }}" alt="shape" class="shape">
                    <h4>Employee Basic Info</h4>
                    
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#menu1">Personal</a></li>
                      <li><a data-toggle="tab" href="#menu2">Job</a></li>
                      <li><a data-toggle="tab" href="#menu3">Salary</a></li>
                      <li><a data-toggle="tab" href="#menu4">Contact</a></li>
                    </ul>

                    <div class="tab-content">
                      
                      <div id="menu1" class="tab-pane fade in active">
                            @include('backend.pages.employees.personal')
                      </div>

                      <div id="menu2" class="tab-pane fade">
                            @include('backend.pages.employees.job')
                      </div>
                      <div id="menu3" class="tab-pane fade">
                            @include('backend.pages.employees.salary')
                      </div>

                      <div id="menu4" class="tab-pane fade">
                            @include('backend.pages.employees.contact')
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
            format: '<?php $st = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format; 
                        if($st == "d-m-Y") echo "dd-mm-yyyy";
                        else if($st == "m-d-Y") echo "mm-dd-yyyy";
                        else if($st == "d/m/Y") echo "dd/mm/yyyy";
                        else if($st == "m/d/Y") echo "mm/dd/yyyy"; ?>'
        });

        $('#birth-date').datepicker({
            todayHighlight: true,
            endDate: '-16y',
            format: '<?php $st = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format; 
                        if($st == "d-m-Y") echo "dd-mm-yyyy";
                        else if($st == "m-d-Y") echo "mm-dd-yyyy";
                        else if($st == "d/m/Y") echo "dd/mm/yyyy";
                        else if($st == "m/d/Y") echo "mm/dd/yyyy"; ?>'
        });
    </script>
@endsection