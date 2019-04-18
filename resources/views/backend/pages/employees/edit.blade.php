{{-- @extends('backend.layouts.master')
@section('content')

    <div class="vender_box">
        <h2>Employee</h2>
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
        <form action="{{ route('employees.update', $employee) }}" method="POST" id="validate-form" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
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
                            <br>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Personal Info</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Name</label>
                                            <input type="text" name="name" placeholder="" required="true" value="{{ $employee->user->name }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left" style="position: relative;">
                                            <label>Gender</label>
                                            <select name="gender" id="gender" class="select-search">
                                                <option value="Male" <?php if($employee->gender == 'Male') echo "selected";?> >Male</option>
                                                <option value="Female" <?php if($employee->gender == 'Female') echo "selected";?> >Female</option>
                                                <option value="Others" <?php if($employee->gender == 'Others') echo "selected";?>>Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Birth Date</label>
                                            <input type="text" name="bday" placeholder="" class="datepicker" required="true" value="{{ date(\App\Config::first()->date_format, $employee->bday) }}">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Nationality Details</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Nationality</label>
                                            <input type="text" name="nationality" placeholder="" value="{{ $employee->nationality }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>National ID</label>
                                            <input type="text" name="nid" placeholder="" value="{{ $employee->nid }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Passport No</label>
                                            <input type="text" name="passport" placeholder="" value="{{ $employee->passport }}">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Additional Details</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Ethnicity</label>
                                            <input type="text" name="ethnicity" placeholder="" value="{{ $employee->ethnicity }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Religion</label>
                                            <input type="text" name="religion" placeholder="" value="{{ $employee->religion }}">
                                        </div>
                                    </div>

                                </div>

                            </div>
                      </div>

                      <div id="menu2" class="tab-pane fade">
                            <br>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Employment Information</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Joined Date</label>
                                            <input type="text" name="joined_date" placeholder="" class="datepicker" required="true" value="{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, $employee->joined_date) }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>End of Probation</label>
                                            <input type="text" name="probation_date" placeholder="" class="datepicker" required="true" value="{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, $employee->probation_date) }}">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Job Status</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Position</label>
                                            <input type="text" name="position" placeholder="" required="true" value="{{ $employee->position }}">
                                        </div>

                                        <div class="col-xs-12 col-sm-6 padding_right">
                                            <label>Effective Date</label>
                                            <input type="text" name="effective_date" placeholder="" required="true" class="datepicker" value="{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, $employee->effective_date) }}">
                                        </div>

                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Line Manager</label>
                                            <input type="text" name="line_manager" placeholder="" value="{{ $employee->line_manager }}">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 padding_right">
                                            <label>Department</label>
                                            <select name="department" class="select-search" required>
                                                @foreach(\App\Department::where('account_id', Auth::user()->account_id)->get() as $department)
                                                    <option value="{{ $department->name }}" <?php 
                                                        if($employee->department == $department->name) echo "selected";
                                                    ?> >{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Branch</label>
                                            <input type="text" name="branch" placeholder="" value="{{ $employee->branch }}">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Employment Status</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 col-sm-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Job Type</label>
                                            <select name="job_type" id="job_type" class="select-search" required="true">
                                                <option value="Permanent" <?php if($employee->job_type == 'Permanent') echo "selected";?> >Permanent</option>
                                                <option value="Probation" <?php if($employee->job_type == 'Probation') echo "selected";?> >Probation</option>
                                                <option value="Contractual" <?php if($employee->job_type == 'Contractual') echo "selected";?> >Contractual</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Job Status</label>
                                            <input type="text" name="job_status" placeholder="" value="{{ $employee->job_status }}">
                                        </div>
                                    </div>

                                </div>

                            </div>
                      </div>
                      <div id="menu3" class="tab-pane fade">
                            <br>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Salary Details</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Salary</label>
                                            <input type="number" min="0" name="salary" placeholder="" required="true" value="{{ $employee->salary }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Effective Date</label>
                                            <input type="text" name="salary_effective_date" placeholder="" class="datepicker" value="{{ date(\App\Config::where('account_id', Auth::user()->account_id)->first()->date_format, $employee->salary_effective_date) }}">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Payment Details</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Bank</label>
                                            <input type="text" name="bank" placeholder="" value="{{ $employee->bank }}">
                                        </div>

                                        <div class="col-xs-12 col-sm-6 padding_right">
                                            <label>Bank Account</label>
                                            <input type="text" name="bank_account" placeholder="" value="{{ $employee->bank_account }}">
                                        </div>

                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Payment</label>
                                            <input type="text" name="payment" placeholder="" value="{{ $employee->payment }}">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 padding_right">
                                            <label>Method</label>
                                            <input type="text" name="method" placeholder="" value="{{ $employee->method }}">
                                        </div>
                                    </div>

                                </div>

                            </div>

                      </div>

                      <div id="menu4" class="tab-pane fade">
                            <br>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Web</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Email</label>
                                            <input type="text" name="email" placeholder="" required="true" value="{{ $employee->user->email }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Blog/Website</label>
                                            <input type="text" name="blog" placeholder="" value="{{ $employee->blog }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Facebook</label>
                                            <input type="text" name="facebook" placeholder="" value="{{ $employee->facebook }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Linkedin</label>
                                            <input type="text" name="linkedin" placeholder="" value="{{ $employee->linkedin }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>WhatsApp</label>
                                            <input type="text" name="whatsapp" placeholder="" value="{{ $employee->whatsapp }}">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Phone</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Personal</label>
                                            <input type="text" name="personal_phone" placeholder="" value="{{ $employee->personal_phone }}">
                                        </div>

                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Office</label>
                                            <input type="text" name="office_phone" placeholder="" value="{{ $employee->office_phone }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>House</label>
                                            <input type="text" name="house_phone" placeholder="" value="{{ $employee->house_phone }}">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Address</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>

                                        </ul>
                                    </div>


                                </div>

                                <div class="panel-body">

                                    <div class="col-xs-12 padding_0">
                                        <div class="col-xs-12 col-sm-6 padding_left">
                                            <label>Address</label>
                                            <br>
                                            <textarea name="address">{{ $employee->address }}</textarea>
                                        </div>

                                    </div>

                                </div>

                            </div>

                      </div>

                    </div>

                </div>
                                
            </div>

            <div class="col-xs-12 padding_0">
                <div class="text-center" style="background-color: transparent;box-shadow: none;">
                    <button value="submit" type="submit">Update</button>
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
    </script>
@endsection --}}